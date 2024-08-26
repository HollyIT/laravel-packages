<?php

namespace Hollyit\Laratus\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class LaratusOptionsController extends LaratusController
{

    public function __invoke(Request $request) {
        $headers = [
            'Allow' => implode(',', ['POST', 'HEAD', 'DELETE', 'OPTIONS', 'PATCH']),
            'Tus-Version' => self::TUS_PROTOCOL_VERSION,
            'Tus-Extension' => implode(',', self::TUS_EXTENSIONS),
            'Tus-Checksum-Algorithm' => 'sha256',
        ];

        $maxUploadSize = $this->getMaxUploadSize();

        if ($maxUploadSize > 0) {
            $headers['Tus-Max-Size'] = $maxUploadSize;
        }
    }
}
