<?php


namespace Curl;

class Request
{
  protected $url = '';

  protected $payload = [];

  public function setUrl(string $url): self
  {
    $this->url = $url;
    return $this;
  }

  public function setPayload(array $payload): self
  {
    $this->payload = $payload;
    return $this;
  }

  public function getUrl()
  {
    return $this->url;
  }

  public function getPayload()
  {
    return $this->payload;
  }
}
