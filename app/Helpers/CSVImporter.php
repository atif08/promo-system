<?php

namespace App\Helpers;

use Ramsey\Uuid\Uuid;

class CSVImporter {

    protected $path;
    protected $file;
    protected $headers;
    protected $no_of_rows = 0;
    protected $separator  = ",";
    protected $enclosure  = '"';
    protected $escape     = "\\";

    public function __construct($path, $headers, $dir = 'downloads') {
        $this->setPath($path, $dir);
        $this->file = fopen($this->path, 'w');
        $this->setHeaders($headers);
    }

    public function setSeparator($separator): self {
        $this->separator = $separator;
        return $this;
    }

    public function setEnclosure($enclosure): self {
        $this->enclosure = $enclosure;
        return $this;
    }

    public function setEscape($escape): self {
        $this->escape = $escape;
        return $this;
    }

    public function setHeaders($headers): self {
        $this->headers = $headers;
        fputcsv($this->file, $this->headers);
        return $this;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function setPath($path, $dir) {
        $path   = str_replace('/', '-', $path) . '-' . $this->_getRandomSuffix();
        $folder = storage_path(implode('/', ['app', $dir, config('app.env')]));
        @mkdir($folder, 0777, true);
        $this->path = $folder . '/' . $path . '.csv';
    }

    public function getTotalRows(): int {
        return $this->no_of_rows;
    }

    public function closeFile() {
        fclose($this->file);
        //console_log('Total Count In File: ', $this->no_of_rows);
    }

    public function deleteFile() {
        @unlink($this->path);
    }

    public function insertRow($row) {
        fputcsv($this->file, $row, $this->separator, $this->enclosure, $this->escape);
        $this->no_of_rows++;
    }

    public function insertInto($dest_table) {
        $this->closeFile();
        $query = $this->_getInfileQuery($this->path, $dest_table, $this->headers);
        console_log('Executing: ' . $query);
        \DB::connection()->getPdo()->exec($query);
        $this->deleteFile();
    }

    public function insertUpdate($table, $constraint) {
        $this->_insertInTempTable($table, function ($temp_table) use ($table) {
            $headers      = '`' . implode('`, `', $this->headers) . '`';
            $select_query = 'SELECT ' . $headers . ' FROM ' . $temp_table . ' AS tmp';
            return
                'INSERT INTO ' . $table . ' (' . $headers . ') (' . $select_query . ')' .
                ' ON DUPLICATE KEY' .
                ' UPDATE ' . $this->_getUpdatedHeaders();
        });
    }

    public function insertUpdateWithReference($table, $local_key, $reference, $foreign_key, $constraint) {
        $this->_insertInTempTable($table, function ($temp_table) use ($table, $local_key, $reference, $foreign_key) {
            $headers = '`' . implode('`, `', $this->headers) . '`';

            $select_query = 'SELECT ' . $this->_getSelectedHeaders() .
                ' FROM ' . $temp_table . ' AS tmp' .
                ' JOIN ' . $reference . ' AS ref' .
                ' ON ref.' . $foreign_key . ' = tmp.' . $local_key;

            return
                'INSERT INTO ' . $table . ' (' . $headers . ') (' . $select_query . ')' .
                ' ON DUPLICATE KEY' .
                ' UPDATE ' . $this->_getUpdatedHeaders();
        });
    }

    private function _insertInTempTable($dest_table, \Closure $get_query_callback, $remove_indexes = []) {
        $this->closeFile();

        $temp_table = $this->_createTempTable();

        $queries   = [];
        $queries[] = 'CREATE TEMPORARY TABLE `' . $temp_table . '` LIKE `' . $dest_table . '`;';
        $queries[] = $this->_getInfileQuery($this->path, $temp_table, $this->headers);
        $queries[] = $get_query_callback($temp_table);
        $queries[] = 'DROP table `' . $temp_table . '`';

        \DB::reconnect();
        foreach ($queries as $query) {
//             console_log('Executing: ' . $query);
            \DB::connection()->getPdo()->exec($query);
        }

        $this->deleteFile();
    }

    private function _getInfileQuery($file_path, $table, $headers, $replace = ''): string {
        $joined_headers = '`' . implode('`,`', $headers) . '`';
        return
            'LOAD DATA LOCAL INFILE \'' . $file_path . '\' ' . $replace .
            ' INTO TABLE ' . $table .
            ' FIELDS TERMINATED BY \',\'' .
            ' OPTIONALLY ENCLOSED BY \'"\'' .
            ' LINES TERMINATED BY \'\n\'' .
            ' IGNORE 1 LINES (' . $joined_headers . ');';
    }

    private function _createTempTable(): string {
        return str_replace('-', '_', 'temp-' . Uuid::uuid1()->toString());
    }

    private function _getSelectedHeaders(): string {
        return implode(', ',
            array_map(function ($column) {
                return 'tmp.`' . $column . '`';
            }, $this->headers)
        );
    }

    private function _getUpdatedHeaders(): string {
        return implode(', ',
            array_filter(array_map(function ($column) {
                if ($column == 'created_at') return null;
                return '`' . $column . '` = VALUES(`' . $column . '`)';
            }, $this->headers))
        );
    }

    private function _getRandomSuffix(): string {
        return implode('-', [
            str_replace('.', '-', microtime()),
            random_int(1, 2000),
            random_int(1, 2000),
        ]);
    }
}
