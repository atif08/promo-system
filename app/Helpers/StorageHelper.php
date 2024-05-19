<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class StorageHelper {

	protected string $disk;
	protected Filesystem $storage;

	public function __construct() {
		$this->disk = config('filesystems.storage');
		$this->storage = Storage::disk($this->disk);
	}

	/**
	 * @param $file_path
	 * @return bool
	 */
	public function exists($file_path): bool {
		return $this->storage->exists($file_path);
	}

	/**
	 * @param $file_path
	 * @return bool
	 */
	public function delete($file_path): bool {
		return $this->storage->delete($file_path);
	}

	/**
	 * @param $file_path
	 * @return string
	 * @throws FileNotFoundException
	 */
	public function get($file_path): string {
		switch ($this->disk) {
			case 's3':
				$local_path = str_replace('/', '-', ltrim($file_path, 'app/'));
				$storage_path = storage_path('app/' . $local_path);
				@mkdir(dirname($storage_path), 0777, true);
				Storage::disk('local')->put($local_path, $this->storage->get($file_path));
				return $storage_path;
			default:
				return $this->storage->path($file_path);
		}
	}

	/**
	 * @param $file
	 * @param $file_path
	 * @return string
	 */
	public function put($file, $file_path): string {
		$file_name = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
		$file_name .= '-' . Carbon::now()->timestamp * rand(1, 9);
		$file_name .= '.' . $file->getClientOriginalExtension();

		switch ($this->disk) {
			case 's3':
				$file_path = 'app/' . $file_path;
				break;
			default:
				$file_path = 'public/' . $file_path;
				$storage_path = storage_path('app/' . $file_path);
				@mkdir($storage_path, 0777, true);
				break;
		}

		$this->storage->put($file_path . $file_name, file_get_contents($file));
		return $file_path . $file_name;
	}

	/**
	 * @param $file_path
	 * @param null $file_name
	 * @return mixed
	 */
	public function download($file_path, $file_name = null) {
		return $this->storage->download($file_path, $file_name);
	}
}
