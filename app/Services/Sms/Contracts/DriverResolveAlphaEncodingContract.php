<?php


namespace App\Services\Sms\Contracts;


interface DriverResolveAlphaEncodingContract
{
    /**
     * In case of alpha encoding problems
     *
     * @param string $alpha
     * @return string
     */
    public function resolveAlphaEncoding(string $alpha): string;
}
