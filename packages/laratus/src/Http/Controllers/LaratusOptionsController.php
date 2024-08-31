<?php

namespace Hollyit\Laratus\Http\Controllers;

use Hollyit\Laratus\Server;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class LaratusOptionsController extends LaratusController
{

    public function __invoke(Request $request, Server $server) {
        return $server->handleOptions();

    }
}
