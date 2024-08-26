<?php

namespace Hollyit\Laratus;

use Hollyit\Laratus\Helpers\Filesize;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use TusPhp\Tus\Server;

class LaratusServer extends Server
{

    public function __construct()
    {
        parent::__construct();

        // Set upload path
        // Set cache driver.
    }

}
