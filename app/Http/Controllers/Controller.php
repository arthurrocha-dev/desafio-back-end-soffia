<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Soffia Back-end Challenge API Documentation",
 *     description="This API was developed to address the challenge proposed by the company Soffia. It includes endpoints for a station control application. The documentation provides details about each endpoint, including the expected parameters and possible responses.",
 *     @OA\Contact(
 *         email="arthurrocha2101@gmail.com",
 *         url="https://arthurrocha.dev.br"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

class SwaggerController
{
}