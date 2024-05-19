<?php

use App\Helpers\StorageHelper;
use \Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\VarDumper\VarDumper as Dumper;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Helper\ProgressBar;

function nap($seconds) {
    if (!$seconds) return;
    $progress = progress_bar($seconds);
    $i        = 0;
    while ($i++ < $seconds) {
        $progress->advance();
        sleep(1);
    }
    print "\n";
}

function console_log() {
    if (app()->runningInConsole()) {
        print "\e[1;33m" . Carbon::now() . " : \e[0m";
        foreach (func_get_args() as $arg) {
            print_r($arg);
            print " ";
        }
        print "\n";
    } else {
        foreach (func_get_args() as $arg) {
            Log::info(print_r($arg, true));
        }
    }
}

function console_error() {
    print "\e[1;31m" . Carbon::now() . " : \e[41;97m ";
    foreach (func_get_args() as $arg) {
        print_r($arg);
        print " ";
    }
    print "\e[0m\n";
}

function log_info($message) {
    Log::info($message);
}

function log_error($message) {
    Log::error($message);
}

function to_array($value) {
    return is_array($value) ? $value : explode(',', $value);
}

function progress_bar($maximum): ProgressBar {
    $output       = new ConsoleOutput();
    $progress_bar = new ProgressBar($output, $maximum);
    $progress_bar->start();
    return $progress_bar;
}

function is_local(): bool {
    return (config('app.env') === 'local');
}

function is_development(): bool {
    return config('app.env') === 'development';
}

function is_production(): bool {
    return config('app.env') === 'production';
}

function dump_log() {
    array_map(function ($x) {
        (new Dumper)->dump($x);
    }, func_get_args());
}

function required_label($label): string {
    return __($label) . ' *';
}

function is_menu_parent($menu) {
    return (isset($menu['parent']) && $menu['parent'] === 'true');
}

function get_block_id($block_name): string {
    $block_name = explode('\\', $block_name);
    return Str::snake(end($block_name));
}

function calc_change($then, $now, $reverse = false) {
    $value = match (true) {
        !$now && !$then => 0,
        $now && !$then => 100,
        !$now && $then => -100,
        default => (($now - $then) / $then) * 100,
    };

    return $reverse ? ($value * -1) : $value;
}

function calc_pct_change($then, $now, $reverse = false) {
    $value = $now - $then;
    return $reverse ? ($value * -1) : $value;
}

function format_kpi($value, $type, $currency = 'EUR') {
    return match ($type) {
        'integer' => format_integer($value),
        'amount' => format_amount($value, $currency),
        'percent' => format_percent($value, 100),
        'number' => format_number($value),
        default => $value,
    };
}

function parse_date($date, $format = null): ?Carbon {
    if (!$date || $date == '0000-00-00') return NULL;

    try {
        $date = $format ? Carbon::createFromFormat($format, $date) : Carbon::parse($date);
    } catch (\Exception $ex) {
        return NULL;
    }

    if ($date->toDateString() == '1970-01-01') {
        return NULL;
    }

    return $date;
}

function get_class_name($object) {
    $class_name = is_object($object) ? get_class($object) : $object;

    if (preg_match("@\\\\([\w]+)$@", $class_name, $matches)) {
        $class_name = $matches[1];
    }

    return $class_name;
}

function raw_query($query) {
    $base_query = str_replace('%', '%%', $query->toSql());
    return vsprintf(str_replace(['?'], ['\'%s\''], $base_query), $query->getBindings());
}

function exec_insert_update($select_q, $columns, $to_table) {
    $updated_columns = array_filter(array_map(function ($column) {
        if (trim($column, '`') !== 'created_at') {
            return $column . ' = VALUES(' . $column . ')';
        }
    }, $columns));

    $query =
        'INSERT INTO ' . $to_table .
        ' (' . implode(', ', $columns) . ') ' .
        raw_query($select_q) .
        ' ON DUPLICATE KEY ' .
        ' UPDATE ' . implode(', ', $updated_columns);

    DB::transaction(function () use ($query) {
        DB::connection()->getPdo()->exec($query);
    }, 3);
}

function gzdecodedata($data) {
    ob_start();
    readgzfile('data://application/gzip;base64,' . base64_encode($data));
    return ob_get_clean();
}

function storage(): StorageHelper {
    return new StorageHelper();
}
