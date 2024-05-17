<?php

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;



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
            $measurement->parameter_id = $parameter->id; // Используем правильное имя атрибута
            $measurement->value = random_int(100, 1000) * 0.1;
        
            if (!$measurement->save()) {
                echo 'Measurement is not saved';
                exit(1);
            }
        
            if (!($measurement->parameter instanceof Parameter)) {
                echo 'Measurement type is not a Parameter';
                exit(1);
            }

            $counter = new Counter();
            $counter ->name ='test';
            $counter->created_at=date('Y-m-d H:i:s');
            $counter->updated_at=date('Y-m-d H:i:s');

            if (!$counter->save()){
                echo 'Counter don.t save';
                exit(1);
            }


            echo 'success';
        }
        
        public function actionSaveData($argc = null)
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


                $iso8601DateTime = "2024-05-01T00:08:08+03:00";
                $dateTime = new DateTime($iso8601DateTime);
                $formattedDateTime = $dateTime->format('Y-m-d H:i');
                
                $data = $response->getBody()->getContents();
                $dataArray = json_decode($data, true);
                
               
                $dataToSave = $dataArray['result']['data'];
                
                $serverName = 'localhost';
                $userName = 'slava';
                $password = 'password';
                $bsname = 'new_database';
                
                $connected = new mysqli($serverName, $userName, $password, $bsname);
                if ($connected->connect_error) {
                    die('Ошибка соединения: ' . $connected->connect_error);
                }
                
                foreach ($dataToSave as $data) {
                   
                    $existingMeasurement = Measurement::model()->findByAttributes(['timestamp' => $data[0]]);
                    
                   
                    if ($existingMeasurement !== null) {
                        echo 'Запись с временем ' . $data[0] . ' уже существует. Пропускаем.' . PHP_EOL;
                        continue;
                    }
                
                    $measurement = new Measurement();
                    $measurement->timestamp = date('Y-m-d H:i:s', strtotime($data[0]));
                    $measurement->value = $data[1];  
                    $measurement->parameter_id = $data[2]; 
                
                    // Сохраняем запись
                    if (!$measurement->save()) {
                        echo 'Ошибка вставки новой записи: ' . print_r($measurement->getErrors(), true);
                    } else {
                        echo 'Новая запись успешно добавлена.' . PHP_EOL;
                    }
                }
                
                $connected->close();

                foreach ($dataToSave as $item) {
                        $measurementA = new Measurement();
                        $parameter = Parameter::model()->findByPk(1);
                        $iso8601DateTime = $item[0];
                        $dateTime = new DateTime($iso8601DateTime);
                        $formattedDateTime = $dateTime->format('Y-m-d H:i:s');


                        $measurementA->timestamp = $formattedDateTime; 
                        $measurementA->parameter_id = $parameter->id;
                        $measurementA->value = $item[1]; 
                        
                        if (!empty($item[1]) && $measurementA->validate()) { 
                            if ($measurementA->save()) { 
                                echo "Measurement A saved successfully.\n";
                            } else {
                                echo "Error saving measurement A.\n";
                                print_r($measurementA->errors); 
                            }
                        } else {
                            echo "Measurement A validation failed or parameter A is empty.\n";
                            print_r($measurementA->errors); 
                        }
                    
                        $parameterA = Parameter::model()->findByPk(1);

                        if ($parameterA !== null) {
                           
                            $measurementA->parameter_id = $parameterA->id;
                            
                        } else {
                          
                            echo "Parameter with ID 1 not found.\n";
                        }

                

                        if (count($item) > 2) {
                            $measurementB = new Measurement();
                            $measurementB->timestamp = $formattedDateTime; 
                            $measurementB->parameter_id = 1; 
                            $measurementB->value = $item[2]; 
                            
                            if (!empty($item[2]) && $measurementB->validate()) { 
                                if ($measurementB->save()) { 
                                    echo "Measurement B saved successfully.\n";
                                } else {
                                    echo "Error saving measurement B.\n";
                                    print_r($measurementB->errors); 
                                }
                            } else {
                                echo "Measurement B validation failed or parameter B is empty.\n";
                                print_r($measurementB->errors); 
                            }
                        }
                    
                        
                        if (count($item) > 3) {
                            $measurementC = new Measurement();
                            $measurementC->timestamp = $formattedDateTime; 
                            $measurementC->parameter_id = 1; 
                            $measurementC->value = $item[3]; 
                            if (!empty($item[3]) && $measurementC->validate()) { 
                                if ($measurementC->save()) { 
                                    echo "Measurement C saved successfully.\n";
                                } else {
                                    echo "Error saving measurement C.\n";
                                    print_r($measurementC->errors); 
                                }
                            } else {
                                echo "Measurement C validation failed or parameter C is empty.\n";
                                print_r($measurementC->errors); 
                            }
                        }
                    }
                    
        }
           
}
?>



