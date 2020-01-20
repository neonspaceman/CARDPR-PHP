<?php

require __DIR__ . '/vendor/autoload.php';

function unitTests()
{
  $test = new ApiTests();
  $test->run();
}

function loadTest($countRequests)
{
  $requests = array();
  for ($i = 0; $i < $countRequests; ++$i) {
    $request = new \Curl\Request();
    $request
      ->setUrl('https://core.codepr.ru/api/v2/crm/user_create_or_update')
      ->setPayload([
        "app_key" => "5240f691-60b0-4360-ac1f-601117c5408f",
        "phone" => "+79111111111",
        "email" => "ivan@ivan.ru",
        "name" => "Иван",
        "surname" => "Петров",
        "middlename" => "Иванович",
        "birthday" => "11.12.1990",
        "discount" => "5",
        "bonus" => "0",
        "balance" => "0",
        "link" => "https://demo.codepr.ru/",
        "sms" => "Предлагаем установить карту: %link%"
      ])
    ;
    $requests[] = $request;
  }

  $responses = \Curl\Curl::sendMulti($requests);

  $success = 0;
  $failed = 0;
  $statusCodes = [];
  foreach ($responses as $response) {
    $statusCode = $response->getStatus();
    if (!array_key_exists($statusCode, $statusCodes)) {
      $statusCodes[$statusCode] = 0;
    }
    if ($statusCode === 200){
      $success++;
    } else {
      $failed++;
    }
    $statusCodes[$statusCode]++;
  }

  foreach ($statusCodes as $statusCode => $counts){
    echo 'HTTP CODE ' . $statusCode . ' => ' . $counts . PHP_EOL;
  }
  echo 'Send ' . $countRequests . ' requests. Success: ' . $success . ', failed: ' . $failed . ' (' . round($failed / $countRequests * 100) . '%)' . PHP_EOL;
}

$testType = $argv[1] ?? 'unit';

switch ($testType){
  case 'unit':
    unitTests();
    return;
  case 'load':
    $countRequests = (int)($argv[2]) ?? 0;
    if ($countRequests <= 0){
      echo 'Enter count of request' . PHP_EOL;
      return;
    }
    loadTest($countRequests);
    return;
}