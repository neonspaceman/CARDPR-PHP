<?php


use Tests\Tests;
use Tests\Assert;
use Curl\Curl;
use Curl\Request;

class ApiTests extends Tests
{
  const API_URL = 'https://core.codepr.ru/api/v2/crm/user_create_or_update';

  public function before()
  {
    sleep(1);
  }

  public function testAppKeyNotPass()
  {
    $payload = [
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
    ];

    $request = new Request();
    $request
      ->setUrl(self::API_URL)
      ->setPayload($payload);

    $response = Curl::send($request);

    Assert::isStrictEqual($response->getStatus(), 400);
    Assert::isEqualArray($response->getContent(), [
      "error" => "app_key not set",
    ]);
  }

  public function testAppKeyIsWrong()
  {
    $payload = [
      "app_key" => "76GUHT6HTU7TJ7UT67",
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
    ];

    $request = new Request();
    $request
      ->setUrl(self::API_URL)
      ->setPayload($payload)
    ;

    $response = Curl::send($request);

    Assert::isStrictEqual($response->getStatus(), 400);
    Assert::isEqualArray($response->getContent(), [
      "error" => "Invalid app_key",
      'errorCode' => 114,
    ]);
  }

  public function testPhoneNotPass()
  {
    $payload = [
      "app_key" => "5240f691-60b0-4360-ac1f-601117c5408f",
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
    ];

    $request = new Request();
    $request
      ->setUrl(self::API_URL)
      ->setPayload($payload)
    ;

    $response = Curl::send($request);

    Assert::isStrictEqual($response->getStatus(), 400);
    Assert::isEqualArray($response->getContent(), [
      'error' => 'Телефон не указан'
    ]);
  }

  public function testPhoneHasWrongFormat()
  {
    $payload = [
      "app_key" => "5240f691-60b0-4360-ac1f-601117c5408f",
      "phone" => "79111111111",
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
    ];

    $request = new Request();
    $request
      ->setUrl(self::API_URL)
      ->setPayload($payload)
    ;

    $response = Curl::send($request);

    Assert::isStrictEqual($response->getStatus(), 400);
    Assert::isEqualArray($response->getContent(), [
      'error' => 'Неверный формат телефона'
    ]);
  }

  public function testEmailNotPass()
  {
    $payload = [
      "app_key" => "5240f691-60b0-4360-ac1f-601117c5408f",
      "phone" => "+79111111111",
      "name" => "Иван",
      "surname" => "Петров",
      "middlename" => "Иванович",
      "birthday" => "11.12.1990",
      "discount" => "5",
      "bonus" => "0",
      "balance" => "0",
      "link" => "https://demo.codepr.ru/",
      "sms" => "Предлагаем установить карту: %link%"
    ];

    $request = new Request();
    $request
      ->setUrl(self::API_URL)
      ->setPayload($payload)
    ;

    $response = Curl::send($request);

    Assert::isStrictEqual($response->getStatus(), 400);
    Assert::isEqualArray($response->getContent(), [
      'error' => 'Email не указан'
    ]);
  }

  public function testEmailHasWrongFormat()
  {
    $payload = [
      "app_key" => "5240f691-60b0-4360-ac1f-601117c5408f",
      "phone" => "+79111111111",
      "email" => "ivan@@ivan.ru",
      "name" => "Иван",
      "surname" => "Петров",
      "middlename" => "Иванович",
      "birthday" => "11.12.1990",
      "discount" => "5",
      "bonus" => "0",
      "balance" => "0",
      "link" => "https://demo.codepr.ru/",
      "sms" => "Предлагаем установить карту: %link%"
    ];

    $request = new Request();
    $request
      ->setUrl(self::API_URL)
      ->setPayload($payload)
    ;

    $response = Curl::send($request);

    Assert::isStrictEqual($response->getStatus(), 400);
    Assert::isEqualArray($response->getContent(), [
      'error' => 'Неверный формат email'
    ]);
  }

  public function testNameNotPass()
  {
    $payload = [
      "app_key" => "5240f691-60b0-4360-ac1f-601117c5408f",
      "phone" => "+79111111111",
      "email" => "ivan@ivan.ru",
      "surname" => "Петров",
      "middlename" => "Иванович",
      "birthday" => "11.12.1990",
      "discount" => "5",
      "bonus" => "0",
      "balance" => "0",
      "link" => "https://demo.codepr.ru/",
      "sms" => "Предлагаем установить карту: %link%"
    ];

    $request = new Request();
    $request
      ->setUrl(self::API_URL)
      ->setPayload($payload)
    ;

    $response = Curl::send($request);

    Assert::isStrictEqual($response->getStatus(), 400);
    Assert::isEqualArray($response->getContent(), [
      'error' => 'Имя не указано'
    ]);
  }

  public function testBirthdayHasWrongFormat()
  {
    $payload = [
      "app_key" => "5240f691-60b0-4360-ac1f-601117c5408f",
      "phone" => "+79111111111",
      "email" => "ivan@ivan.ru",
      "name" => "Иван",
      "surname" => "Петров",
      "middlename" => "Иванович",
      "birthday" => "11/12/1990",
      "discount" => "5",
      "bonus" => "0",
      "balance" => "0",
      "link" => "https://demo.codepr.ru/",
      "sms" => "Предлагаем установить карту: %link%"
    ];

    $request = new Request();
    $request
      ->setUrl(self::API_URL)
      ->setPayload($payload)
    ;

    $response = Curl::send($request);

    Assert::isStrictEqual($response->getStatus(), 400);
    Assert::isEqualArray($response->getContent(), [
      'error' => 'Не верный формат даты'
    ]);
  }

  public function testBirthdayHasWrongDate()
  {
    $payload = [
      "app_key" => "5240f691-60b0-4360-ac1f-601117c5408f",
      "phone" => "+79111111111",
      "email" => "ivan@ivan.ru",
      "name" => "Иван",
      "surname" => "Петров",
      "middlename" => "Иванович",
      "birthday" => "30.02.1990",
      "discount" => "5",
      "bonus" => "0",
      "balance" => "0",
      "link" => "https://demo.codepr.ru/",
      "sms" => "Предлагаем установить карту: %link%"
    ];

    $request = new Request();
    $request
      ->setUrl(self::API_URL)
      ->setPayload($payload)
    ;

    $response = Curl::send($request);

    Assert::isStrictEqual($response->getStatus(), 400);
    Assert::isEqualArray($response->getContent(), [
      'error' => 'Не удалось изменить данные'
    ]);
  }

  public function testSuccessWithOnlyRequireParameters()
  {
    $payload = [
      "app_key" => "5240f691-60b0-4360-ac1f-601117c5408f",
      "phone" => "+79111111111",
      "email" => "ivan@ivan.ru",
      "name" => "Иван",
    ];

    $request = new Request();
    $request
      ->setUrl(self::API_URL)
      ->setPayload($payload)
    ;

    $response = Curl::send($request);

    Assert::isStrictEqual($response->getStatus(), 200);

    $field = 'success';
    Assert::isArrayHasKey($response->getContent(), $field);
    Assert::isBool($response->getContent()[ $field ]);

    $field = 'card';
    Assert::isArrayHasKey($response->getContent(), $field);
    Assert::isBool($response->getContent()[ $field ]);

    $field = 'card_number';
    Assert::isArrayHasKey($response->getContent(), $field);
    Assert::isString($response->getContent()[ $field ]);

    $field = 'card_track';
    Assert::isArrayHasKey($response->getContent(), $field);
    Assert::isString($response->getContent()[ $field ]);

    $field = 'card_url';
    Assert::isArrayHasKey($response->getContent(), $field);
    Assert::isUrl($response->getContent()[ $field ]);

    $field = 'form_url';
    Assert::isArrayHasKey($response->getContent(), $field);
    Assert::isEmpty($response->getContent()[ $field ]);
  }

  public function testSuccessWithAllParameters()
  {
    $payload = [
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
    ];

    $request = new Request();
    $request
      ->setUrl(self::API_URL)
      ->setPayload($payload)
    ;

    $response = Curl::send($request);

    Assert::isStrictEqual($response->getStatus(), 200);

    $field = 'success';
    Assert::isArrayHasKey($response->getContent(), $field);
    Assert::isBool($response->getContent()[ $field ]);

    $field = 'card';
    Assert::isArrayHasKey($response->getContent(), $field);
    Assert::isBool($response->getContent()[ $field ]);

    $field = 'card_number';
    Assert::isArrayHasKey($response->getContent(), $field);
    Assert::isString($response->getContent()[ $field ]);

    $field = 'card_track';
    Assert::isArrayHasKey($response->getContent(), $field);
    Assert::isString($response->getContent()[ $field ]);

    $field = 'card_url';
    Assert::isArrayHasKey($response->getContent(), $field);
    Assert::isUrl($response->getContent()[ $field ]);

    $field = 'form_url';
    Assert::isArrayHasKey($response->getContent(), $field);
    Assert::isUrl($response->getContent()[ $field ]);
    Assert::isStringStartWith($response->getContent()[ $field ], 'https://demo.codepr.ru/');
  }
}
