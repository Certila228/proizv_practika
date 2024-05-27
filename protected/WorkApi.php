<?php

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class WorkApi

{
    private $client;
    private $apiUrl; 
 

    public function __construct()
    {
        $this->client = new Client();

        $config=require(__DIR__ . '/config/config.php');
        $this->apiUrl = $config['apiUrl'];

        
    }

    public function GetData($meterId, Parameter $parameter, $periodType, $periodValue, $limit = 5)
    {
        // Формируем параметры запроса к API
        $requestData = [
            "jsonrpc" => "2.0",
            "method" => "currentValue.data",
            "params" => [
                "meter" => $meterId,
                "name" => $parameter->name,
                "period" => [
                    "type" => $periodType,
                    "value" => $periodValue
                ],
                "limit" => $limit
            ],
            "id" => 1
        ];

        // Отправляем запрос к API
        $response = $this->client->post('https://app.yaenergetik.ru/api?v2&sessionId=ubkro9k7dv7m6vkah5lop8782ar', [
            'json' => $requestData
        ]);

        // Получаем данные из ответа
        $data = $response->getBody()->getContents();
        $dataArray = json_decode($data, true);

        // Возвращаем данные
        return $dataArray['result']['data'];;
    }
}
?>
