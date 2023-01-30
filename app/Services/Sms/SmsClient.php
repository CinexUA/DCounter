<?php


namespace App\Services\Sms;


use App\Exceptions\UnsupportedParameter;
use App\Services\Sms\Contracts\DriverContract;
use App\Services\Sms\Contracts\DriverResolveAlphaEncodingContract;
use App\Services\Sms\Contracts\DriverResolveMessageEncodingContract;
use App\Services\Sms\Events\SmsFailed;
use App\Services\Sms\Events\SmsSent;
use GuzzleHttp;
use Illuminate\Database\Eloquent\Collection;

final class SmsClient
{
    /**
     * Guzzle Http Client Object.
     *
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * Store response after make HTTP request.
     *
     * @var GuzzleHttp\Psr7\Response
     */
    private $response;

    /**
     * Success status code.
     *
     * @var array
     */
    private $successCodes = [200, 201];

    /**
     * @var DriverContract
     */
    private $driver;

    /**
     * @var Collection
     */
    private $data;

    private $type;

    public function __construct(DriverContract $driverContract)
    {
        $this->driver = $driverContract;
        $this->initHTTPClient();
    }

    private function initHTTPClient()
    {
        $this->client = new GuzzleHttp\Client();
    }

    public function send(SmsBuilder $smsBuilder): string
    {
        $to = $smsBuilder->getTo();
        $from = $this->driver->alpha();
        $message = $smsBuilder->getMessage();
        $this->type = $this->driver->type();

        if($this->driver instanceof DriverResolveAlphaEncodingContract){
            $from = $this->driver->resolveAlphaEncoding($from);
        }

        if($this->driver instanceof DriverResolveMessageEncodingContract){
            $message = $this->driver->resolveMessageEncoding($message);
        }

        $sms = collect($this->driver->parametersFormat($to, $from, $message));
        $credentials = collect($this->driver->credentials());
        $this->data = $credentials->merge($sms);

        $HTTPResponseBody = '';

        try {
            $this->response = $this->client->request(
                $this->driver->method(),
                $this->driver->baseUrl(),
                $this->formData()
            );
            if ($this->isRequestSuccess()) {
                $HTTPResponseBody = $this->response->getBody()->getContents();

                if (method_exists($this->driver, 'success')) {
                    call_user_func([$this->driver, 'success'], $this->response, $HTTPResponseBody);
                }

                event(new SmsSent($sms, $this->response, $HTTPResponseBody));
            }

        } catch (GuzzleHttp\Exception\ClientException $e) {
            $HTTPResponseBody = $e->getResponse()->getBody()->getContents();

            if (method_exists($this->driver, 'error')) {
                call_user_func([$this->driver, 'error'], $e, $HTTPResponseBody);
            }

            event(new SmsFailed($sms, $e, $HTTPResponseBody));
        }

        return $HTTPResponseBody;
    }

    /**
     * Check whether the HTTP request is success or failed.
     *
     * @return bool
     */
    private function isRequestSuccess(): bool
    {
        if (!in_array($this->response->getStatusCode(), $this->successCodes)) {
            return false;
        }

        return true;
    }

    private function formData(): array
    {
        $supportedTypes = [
            'query',
            'body',
            'json',
            'form_params',
        ];

        if(!in_array($this->type, $supportedTypes)){
            throw new UnsupportedParameter("Parametr [{$this->type}] is not supported.");
        }

        return [$this->type => $this->data->toArray()];
    }
}
