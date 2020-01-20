<?php


namespace Curl;

class Response
{
  protected $status;

  protected $content;

  public function setStatus(int $status): self
  {
    $this->status = $status;
    return $this;
  }

  /**
   * @param array|string $content
   * @return $this
   */
  public function setContent($content): self
  {
    $this->content = $content;
    return $this;
  }

  public function getStatus(): int
  {
    return $this->status;
  }

  /**
   * @return array|string
   */
  public function getContent()
  {
    return $this->content;
  }
}