<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class ServicePy
{
    /**
     * @return mixed
     */
    public function getPredictionKNN(array $data)
    {
        $cFile     = curl_file_create('files/data3.csv');
        $postData  = array('dataFile' => $cFile);
        $this->uri = 'service.auto-save.local:5000/api/v1/KNN/prediction';

        $this->uri .= "?"."age"."=".$data['age'].
            '&gender='.$data['gender'].
            '&exp='.$data['exp'].
            '&marka='.$data['marka'].
            '&year='.$data['year'].
            '&engine='.$data['engine'].
            '&kbm='.$data['kbm'];
        

        // Создаем запрос в сервис
        $curl = curl_init($this->uri);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($curl);

        // Ошибка биллинга
        if (!$response) {
            throw new ClientUnavailableException('Сервис временно недоступен. Попробуйте зарегистрироваться позднее.');
        }

        curl_close($curl);

        // Ответ от сервиса
        $result = json_decode($response, true);

        return $result;
    }
}