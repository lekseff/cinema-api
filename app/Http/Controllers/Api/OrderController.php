<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Response;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderConfirmRequest;


class OrderController extends Controller
{
    public function confirm(OrderConfirmRequest $request, OrderService $service): Response
    {
        $validated = $request->validated();
        $qrCode = $service->createOrder($validated);
        return response($qrCode);
    }
}
