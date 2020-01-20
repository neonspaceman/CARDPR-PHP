<?php


namespace Tests;

class Tests
{
  public function run()
  {
    $methods = get_class_methods($this);

    $i = 0;
    $success = 0;
    $failed = 0;
    foreach ($methods as $method){
      if(strpos($method, "test") === 0){

        if (method_exists($this, 'before')){
          $this->before();
        }

        $i++;
        $status = true;

        $startTime = microtime(true);
        try {
          $this->{$method}();
          $success++;
        } catch (\Exception $err) {
          $failed++;
          $status = false;
          $message = $err->getMessage();
        }
        $endTime = microtime(true);

        $totalTime = ($endTime - $startTime);

        echo $i . ') Test `' . $method . '` is ' . ($status ? 'OK' : 'FAILED') . ' (' . round($totalTime, 3) . ' sec.)' . PHP_EOL;
        if (!$status){
          echo $message . PHP_EOL . PHP_EOL;
        }
      }
    }

    echo 'Total: ' . $i . ' Success: ' . $success . ' Failed: ' . $failed . PHP_EOL;
  }
}
