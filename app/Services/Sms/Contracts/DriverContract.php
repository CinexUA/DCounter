<?php

namespace App\Services\Sms\Contracts;

interface DriverContract
{
    /**
     * Set base url for each defined driver.
     *
     * @return mixed
     */
    public function baseUrl(): string;

    /**
     * Alpha name from which the shipment is sent
     *
     * @return mixed
     */
    public function alpha(): string;

    /**
     * form credentials to send: "login, password or token"
     *
     * @return mixed
     */
    public function credentials(): array;

    /**
     * Method for sending HTTP request
     *
     * @return string GET|POST
     */
    public function method(): string;

    /**
     * Example sending as: query (GET), json (PUT|POST...), form_params (POST), body (POST raw data)
     *
     * @return string
     */
    public function type(): string;

    /**
     * Transmitted data format
     *
     * @param string $to
     * @param string $from
     * @param string $message
     * @return array
     */
    public function parametersFormat(string $to, string $from, string $message): array;
}
