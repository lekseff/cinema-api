<?php

namespace App\Http\Controllers\Api;

use App\Models\Session;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderConfirmRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    public function confirm(OrderConfirmRequest $request): Response
    {
        //  id выбранных мест, id сеанса,
        $validated = $request->validated();

        $session = Session::query()->find($validated['id']);    // Находим сеанс по id

        $places = json_decode($session['places'], true); // Получаем список мест

        // Добавляем выбранные места
        $newPlaces = array_map(function ($item) use ($validated) {
            if (in_array($item['id'], $validated['places'])) {
                $item['isFree'] = false;
            }
            return $item;
        }, $places);


        $session->update([
            'places' => $newPlaces
        ]);

        $movieName = $session->movie->name;
        $placesList = implode(', ', $validated['places']);

        $qrMessage = "Фильм: ${movieName}, Дата: ${session['date']}, Места: ${placesList}";

        $qr = QrCode::class::encoding('UTF-8')->format('svg')->size(150)->margin(2)->generate($qrMessage);
        return response($qr);
    }
}
