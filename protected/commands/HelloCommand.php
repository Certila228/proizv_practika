<?php 
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;


class HelloCommand extends CConsoleCommand {
    public function actionSaveData($argc = null) {
        $apiHandler = new WorkApi();
        $dataToSave = $apiHandler->fetchData(92607, 'voltage', 'month', '2024-05');
        
        $dataSaver = new SaveData();
        
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
            
            if (!$measurement->save()) {
                echo 'Ошибка вставки новой записи: ' . print_r($measurement->getErrors(), true);
            } else {
                echo 'Новая запись успешно добавлена.' . PHP_EOL;
            }
        }
        
        foreach ($dataToSave as $item) {
         

            $iso8601DateTime = $item[0];
            $dateTime = new DateTime($iso8601DateTime);
            $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
            
      
            $measurementA = new Measurement();
            $measurementA->timestamp = $formattedDateTime;
            $measurementA->parameter_id = 1;
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