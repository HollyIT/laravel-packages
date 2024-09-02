<?php

namespace Hollyit\Laratus\Http\Controllers;

use Hollyit\Laratus\Server;
use Illuminate\Http\Request;

class LaratusOptionsController extends LaratusController
{
    public function __invoke(Request $request, Server $server)
    {
        return $server->handleOptions();

    }
}
