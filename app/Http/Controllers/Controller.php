<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;


#[OA\Info (
    title:"MarioBakery API",
    version: "1.0.0",
    description: "Documentación interactiva de la API para MarioBakery"
)]
#[OA\Server (
    url:L5_SWAGGER_CONST_HOST,
    description: "Servidor Local"
)]


abstract class Controller
{
    //
}

