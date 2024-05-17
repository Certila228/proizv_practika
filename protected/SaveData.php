<?php

class SaveData
{
        public function saveMeasurement($timestamp, $value, $parameterId)
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
    
        public function saveMeasurementB($timestamp, $value)
        {
            $this->saveMeasurement($timestamp, $value, 1); 
        }
    
        public function saveMeasurementC($timestamp, $value)
        {
            $this->saveMeasurement($timestamp, $value, 1); 
        }
    
}

?>
