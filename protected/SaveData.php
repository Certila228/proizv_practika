<?php

class SaveData
{
    public function saveData()
    {
        $apiHandler = new WorkApi();
        $param = Parameter::model()->findAll();

        foreach ($param as $parameter) {
            $dataToSave = $apiHandler->GetData(92607, $parameter, 'month', '2024-05');

            if (!is_array($dataToSave)) {
                echo 'Данные, возвращенные методом fetchData(), не являются массивом.' . PHP_EOL;
                return;
            }

            foreach ($dataToSave as $data) {
                if (count($data) < 3) {
                    echo 'Некорректные данные: ' . print_r($data, true) . PHP_EOL;
                    continue;
                }

                $timestamp = date('Y-m-d H:i:s', strtotime($data[0]));
                $existingMeasurement = Measurement::model()->findByAttributes(['timestamp' =>$timestamp, 'parameter_id'=>$parameter->id]);
                
                if ($existingMeasurement !== null) {
                    echo 'Запись с временем ' . $data[0] . ' уже существует. Пропускаем.' . PHP_EOL;
                    continue;
                }

                $measurement = new Measurement();
                $measurement->timestamp = $timestamp;
                $measurement->value = $data[1];
                $measurement->parameter_id = $parameter->id;


                if (!$measurement->save()) {
                    echo 'Ошибка вставки новой записи: ' . print_r($measurement->getErrors(), true);
                } else {
                    echo 'Новая запись успешно добавлена.' . PHP_EOL;
                }
            }

            // foreach ($dataToSave as $item) {
            //     $iso8601DateTime = $item[0];
            //     $dateTime = new DateTime($iso8601DateTime);
            //     $formattedDateTime = $dateTime->format('Y-m-d H:i:s');

            //     $this->saveMeasurement($formattedDateTime, $item[1], 1);

            //     if (count($item) > 2) {
            //         $this->saveMeasurement($formattedDateTime, $item[2], 1);
            //     }

            //     if (count($item) > 3) {
            //         $this->saveMeasurement($formattedDateTime, $item[3], 1);
            //     }
            // }
        }
    }



    private function saveMeasurement($timestamp, $value, $parameterId)
    {
        $measurement = new Measurement();
        $measurement->timestamp = $timestamp;
        $measurement->value = $value;
        $measurement->parameter_id = $parameterId;

        if ($measurement->save()) {
            echo "Measurement saved successfully.\n";
        } else {
            echo "Error saving measurement.\n";
            print_r($measurement->errors);
        }
    }
}

?>
