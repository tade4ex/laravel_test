<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{

    public $collects = ProductResource::class;

    public function withResponse(Request $request, JsonResponse $response)
    {

        parent::withResponse($request, $response);
    }
}
