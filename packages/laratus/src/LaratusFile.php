<?php

namespace Hollyit\Laratus;

use Illuminate\Http\Request;

class LaratusFile
{
    public function __construct(
        string $path, string $filename, string $mimeType) {

    }

    public function append(Request $request): static
    {
        return $this;
    }

    public function saveToDisk(string $disk, string $path) {

    }

    public function saveToLocal(string $path) {

    }
}
