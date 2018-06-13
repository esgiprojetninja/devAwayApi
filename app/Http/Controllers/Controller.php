<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{

    /**
     *
     * @SWG\SecurityScheme(
     *   securityDefinition="passport",
     *          type="apiKey",
     *          in="header",
     *          name="Authorization"
     * )
     *
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
