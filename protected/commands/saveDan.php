<?php
include 'HelloCommand.php'; 
use example\HelloCommand;
echo HelloCommand::$response;
class SaveDanCommand
{
    

    public function actionPamp($argc = null)
    {
            $saveDan =fopen (__DIR__.'/Dan.json', 'w');
            fwrite( $saveDan, $response . PHP_EOL);
            fclose($saveDan);
            require('HelloCommand.php');
    }
}

?>