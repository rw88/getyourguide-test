<?php

namespace GetYourGuideTest;


require_once(__DIR__ . '/autoloader.php');

// App Constants
define('APP_TIMEZONE', 'Europe/Berlin');
define('APP_DATEFORMAT', 'Y-m-d\TH:i');


// Get Call DTO
$call = Helpers\CLICallHelper::generateApiCalDTOFromArgv($argv);

// Validate Call DTO
$validate = new Validations\CliCallValidation($call);

if(!$validate->check()) {
   echo $validate;
   die();
}

try {
    // Request API
    $requestHelper = new Helpers\CURLHelper();
    $response = $requestHelper->run($call->getApiUrl());
    
    
    $responseParser = new BLL\APIResponseParser($call, $response);
    echo $responseParser->parse();
    
} catch (Exception $ex) {
    echo $ex->getException() . "\n";
}

