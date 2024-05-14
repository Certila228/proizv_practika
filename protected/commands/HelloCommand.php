<?php

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

require_once('protected/models/Parameter.php');
require_once('protected/models/Measurement.php');

class HelloCommand extends CConsoleCommand
{
        public function actionTest()
        {
            $parameter = new Parameter();
            $parameter->name = 'test';
            $parameter->symbol = 'test';
            $parameter->description = 'test';
            $parameter->unit = 'test';
        
            if (!$parameter->save()) {
                echo 'Parameter is not saved';
                exit(1);
            }
        
            $measurement = new Measurement();
            $measurement->timestamp = date('Y-m-d H:i:s'); // Форматируем время как строку
            $measurement->type_id = $parameter->id; // Используем правильное имя атрибута
            $measurement->value = random_int(100, 1000) * 0.1;
        
            if (!$measurement->save()) {
                echo 'Measurement is not saved';
                exit(1);
            }
        
            if (!($measurement->type instanceof Parameter)) {
                echo 'Measurement type is not a Parameter';
                exit(1);
            }
        
            echo 'success';
        }
        
        public function actionRun($argc = null)
        {
                $client = new Client();
                $response = $client->post(
                        'https://app.yaenergetik.ru/api?v2&sessionId=ubkro9k7dv7m6vkah5lop8782ar',
                        [
                                'headers' => ['content-Type' => 'application/json'],
                                RequestOptions::JSON => [
                                        "jsonrpc" => "2.0",
                                        "method" => "currentValue.data",
                                        "params" => [
                                                "meter" => 92607,
                                                "name" => "voltage",
                                                "period" => [
                                                        "type" => "month",
                                                        "value" => "2024-05"
                                                ],
                                                "limit" => 5
                                        ],
                                        "id" => 1
                                ]
                        ]
                );

                $data =$response->getBody()->getContents();

                $dataAsString =(string) $data;

                $dataArray =json_decode($data,true);
                $dataToSave=$dataArray['result']['data'];
                $dataAsString =json_encode($dataToSave);
                file_put_contents('/home/slavik/papochka2/thtoto/protected/commands/Dan.json', $dataAsString);
             
                $fileContent = file_get_contents('/home/slavik/papochka2/thtoto/protected/commands/Dan.json');
                echo $fileContent;


            
        }
}

?>



