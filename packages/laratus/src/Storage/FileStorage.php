<?php

namespace Hollyit\Laratus\Storage;

use Hollyit\Laratus\Contracts\TusStorageDriver;

class FileStorage implements TusStorageDriver
{

    protected string $disk;
    protected string $path;
    protected int $ttl;

    public function __construct(string $disk, string $path, int $ttl) {

        $this->disk = $disk;
        $this->path = $path;
        $this->ttl = $ttl;
    }

    public static function configure(string $disk, string $path, int $ttl): array
    {
        return [
            'driver' => static::class,
            'options' => [
                'disk' => $disk,
                'path' => $path,
                'ttl' => $ttl,
            ]
        ];
    }

    public function get(string $key) {

    }

    public function put(string $key, mixed $contents) {

    }

    public function destroy(string $key) {

    }
}
