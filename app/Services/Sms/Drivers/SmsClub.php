<?php


namespace App\Services\Sms\Drivers;


use App\Services\Sms\Contracts\DriverContract;
use App\Services\Sms\Contracts\DriverResolveAlphaEncodingContract;
use App\Services\Sms\Contracts\DriverResolveMessageEncodingContract;

class SmsClub implements
    DriverContract,
    DriverResolveMessageEncodingContract,
    DriverResolveAlphaEncodingContract
{
    private $username;
    private $password;
    private $alpha;

    public function __construct(string $username, string $password, string $from)
    {
        $this->username = $username;
        $this->password = $password;
        $this->alpha = $from;
    }

    public function resolveAlphaEncoding(string $alpha): string
    {
        return urldecode($alpha);
    }

    public function resolveMessageEncoding(string $message): string
    {
        $text = iconv('utf-8','windows-1251', $message);
        return urlencode($text);
    }

    public function baseUrl(): string
    {
        return 'https://gate.smsclub.mobi/http';
    }

    public function credentials(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password
        ];
    }

    public function parametersFormat(string $to, string $from, string $message): array
    {
        return [
            'to' => $to,
            'from' => $from,
            'text' => $message,
        ];
    }

    public function alpha(): string
    {
        return $this->alpha;
    }

    public function method(): string
    {
        return 'GET';
    }
    public function type(): string
    {
        return 'query';
    }
}
