<?php

namespace App\Services;

use App\Models\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    /**
     * Создает заказ
     * @param $data - данные для заказа. После валидации
     * @return mixed
     */
    public function createOrder($data): mixed
    {
        $session = $this->saveOrder($data); // Сохраняем новые данные в сеансе
        $message = $this->createQrMessage($session, $data['places']); // Формируем сообщение для сеанса
        return $this->generateQrCode($message);
    }

    /**
     * Сохраняет и обновляет данные сеанса при заказе
     * @param $data - данные для заказа. После валидации
     * @return \Illuminate\Database\Eloquent\Model|Collection|\Illuminate\Database\Eloquent\Builder|array|null  - сеанс
     */
    public function saveOrder($data): \Illuminate\Database\Eloquent\Model|Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        $session = Session::query()->find($data['id']); // Находим сеанс по id

        $places = json_decode($session['places'], true); // Получаем список мест

        // Добавляем выбранные места
        $newPlaces = array_map(function ($item) use ($data) {
            if (in_array($item['id'], $data['places'])) {
                $item['isFree'] = false;
            }
            return $item;
        }, $places);

        $session->update([
            'places' => $newPlaces
        ]);

        return $session;
    }

    /**
     * Формирует сообщение для QR-кода
     * @param $session - сеанс
     * @param array $places - номера выбранных мест
     * @return string - текст сообщения
     */
    public function createQrMessage($session, array $places): string
    {
        $movieName = $session->movie->name;
        $placesList = implode(', ', $places);
        return "Фильм: ${movieName}, Дата: ${session['date']}, Места: ${placesList}";
    }

    /**
     * Создает QR-код
     * @param string $message - текст сообщения
     * @return mixed - QR-код в формате svg
     */
    public function generateQrCode(string $message): mixed
    {
        return QrCode::class::encoding('UTF-8')
            ->format('svg')
            ->size(150)
            ->margin(2)
            ->generate($message);
    }
}
