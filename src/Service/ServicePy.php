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
        $cFile    = curl_file_create('files/data2.csv');
        //$cFile    = curl_file_create('files/csv_file_dtp.csv');
        //var_dump($data['age']);
        $postData = array('dataFile' => $cFile,'age' => $data['age']);
        $this->uri = 'service.auto-save.local:5000/api/v1/KNN/prediction';

        if($data['age']){
            $this->uri.="?" . "age" . "=" . $data['age'];
        }


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