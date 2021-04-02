<?php


namespace App\Services\Sms\Contracts;


interface DriverResolveMessageEncodingContract
{
    /**
     * In case of message encoding problems
     *
     * @param string $message
     * @return string
     */
    public function resolveMessageEncoding(string $message): string;
}
