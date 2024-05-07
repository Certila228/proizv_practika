<?php

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class HelloCommand extends CConsoleCommand
{
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
                                                "meter" => 1234143,
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

                var_dump($response->getBody()->getContents());
        }
}





