<?php


namespace App\Services\Sms\Contracts;


interface DriverResponseContract
{
    /**
     * Returned HTTP response body along with exception.
     *
     * @param $exception
     * @param $HTTPResponseBody
     * @return mixed
     */
    public function error($exception, $HTTPResponseBody);

    /**
     * Returned HTTP response body along with response.
     *
     * @param $response
     * @param $HTTPResponseBody
     * @return mixed
     */
    public function success($response, $HTTPResponseBody);
}
