<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{

    /*
    'passport' => [ // Unique name of security
            'type' => 'oauth2', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
            'description' => 'Laravel passport oauth2 security.',
            'in' => 'header',
            'scheme' => 'https',
            'flows' => [
                "password" => [
                    "authorizationUrl" => config('app.url') . '/oauth/authorize',
                    "tokenUrl" => config('app.url') . '/oauth/token',
                    "refreshUrl" => config('app.url') . '/token/refresh',
                    "scopes" => []
                ],
            ],
        ],

    SWG\SecurityScheme(
     *   securityDefinition="apKey",
     *   type="apiKey",
     *   in="header",
     *   name="Authorization",
     *   scopes={}
     * )
     */
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
