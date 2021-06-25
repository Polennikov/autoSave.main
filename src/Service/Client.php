<?php

namespace App\Service;

use App\Exception\ClientUnavailableException;
use App\Entity\User;

class Client
{
    private $baseUri;

    public function __construct()
    {
        $this->baseUri = 'http://main.auto-save.local';
    }

    /**
     * @throws ClientUnavailableException
     */
    public function auth(string $request): array
    {
        // Формирование запроса в сервис Billing
        $curl = curl_init($this->baseUri.'/api/v1/auth');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: '.strlen($request),
        ]);
        $response = curl_exec($curl);

        // Ошибка биллинга
        if (!$response) {
            throw new ClientUnavailableException('Сервис временно недоступен. Попробуйте авторизоваться позднее.');
        }

        curl_close($curl);

        // Ответ от сервиса
        $result = json_decode($response, true);

        return $result;
    }





}