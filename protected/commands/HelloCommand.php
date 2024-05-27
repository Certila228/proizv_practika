<?php 
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;


class HelloCommand extends CConsoleCommand {
    public function actionSaveData($argc = null)
    {
        $dataSaver = new SaveData();
        $dataSaver->saveData();
    }
}
    ?>