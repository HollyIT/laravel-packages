<?php

namespace Hollyit\Laratus\Helpers;

class Filesize
{
    public static function convertToBytes($size): int
    {
        $suffix = strtoupper(substr($size, -1));
        $value = (int) $size;

        switch ($suffix) {
            case 'G':
                $value *= 1024;
            case 'M':
                $value *= 1024;
            case 'K':
                $value *= 1024;
        }

        return $value;
    }
}
