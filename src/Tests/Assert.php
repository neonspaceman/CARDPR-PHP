<?php


namespace Tests;

class Assert
{
  public static function isStrictEqual($value1, $value2)
  {
    if ($value1 !== $value2){
      throw new \Exception('Value ' . $value1 . ' is not equal ' . $value2);
    }
  }

  public static function isArrayHasKey(array $array, string $key)
  {
    if (!array_key_exists($key, $array)){
      throw new \Exception('Key ' . $key . ' is not exist in array ' . print_r($array, true));
    }
  }

  public static function isString($value)
  {
    if (!is_string($value)){
      throw new \Exception($value . ' is not a string');
    }
  }

  public static function isUrl($value)
  {
    if (!filter_var($value, FILTER_VALIDATE_URL)){
      throw new \Exception($value . ' is not a valid URL');
    }
  }

  public static function isBool($value)
  {
    if (!is_bool($value)){
      throw new \Exception($value . ' is not a bool');
    }
  }

  public static function isStringStartWith($string, $substring)
  {
    if (mb_strpos($string, $substring) !== 0){
      throw new \Exception($string . ' does not start with ' . $substring);
    }
  }

  public static function isEqualArray(array $array1, array $array2)
  {
    if (count(array_diff_assoc($array1, $array2))){
      throw new \Exception(print_r($array1, true) . ' is not equal to ' . print_r($array2, true));
    }
  }

  public static function isEmpty($value)
  {
    if (!empty($value)){
      throw new \Exception($value . ' is not empty');
    }
  }
}
