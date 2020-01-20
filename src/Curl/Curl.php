<?php


namespace Curl;

class Curl
{
  /**
   * @param Request $request
   * @return Response
   */
  public static function send(Request $request): Response
  {
    $jsonPayload = json_encode($request->getPayload());

    $options = [
      CURLOPT_TIMEOUT => 30,
      CURLOPT_POST => 1,
      CURLOPT_HEADER => 0,
      CURLOPT_URL => $request->getUrl(),
      CURLOPT_FRESH_CONNECT => 1,
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_FORBID_REUSE => 1,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_POSTFIELDS => $jsonPayload,
      CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Content-Length: '.strlen($jsonPayload)
      ]
    ];

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);

    $response = new Response();

    $response
      ->setStatus($status)
      ->setContent(json_decode($content, true))
    ;
    return $response;
  }

  /**
   * @param Request[] $requests
   * @return Response[]
   */
  public static function sendMulti(array $requests): array
  {
    $chs = array();
    $result = array();

    $mh = curl_multi_init();

    foreach ($requests as $id => $request) {

      $chs[$id] = curl_init();

      $jsonPayload = json_encode($request->getPayload());

      $options = [
        CURLOPT_TIMEOUT => 30,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_URL => $request->getUrl(),
        CURLOPT_FRESH_CONNECT => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FORBID_REUSE => 1,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POSTFIELDS => $jsonPayload,
        CURLOPT_HTTPHEADER => [
          'Content-Type: application/json',
          'Content-Length: '.strlen($jsonPayload)
        ]
      ];

      curl_setopt_array($chs[$id], $options);

      curl_multi_add_handle($mh, $chs[$id]);
    }

    $running = null;
    do {
      curl_multi_exec($mh, $running);
    } while($running > 0);

    foreach($chs as $id => $ch) {
      $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      $content = curl_multi_getcontent($ch);
      $response = new Response();
      $response
        ->setStatus($status)
        ->setContent($content)
      ;
      $result[ $id ] = $response;
      curl_multi_remove_handle($mh, $ch);
    }

    curl_multi_close($mh);

    return $result;
  }
}