<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CinemaService;


class CinemaController extends Controller
{
    public function index(CinemaService $service): \Illuminate\Http\Response
    {
        $response = $service->getData();
        return response($response, 200);
    }
}
