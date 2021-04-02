<?php


namespace App\Services\Sms;


class SmsBuilder
{
    private $to;
    private $message;

    /**
     * @return mixed
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo(string $to): SmsBuilder
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): SmsBuilder
    {
        $this->message = $message;
        return $this;
    }
}
