<?php

namespace Ky\FCM\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Exception;

class FCMService
{
    /**
     * @var array $iosDevices
     */
    protected $iosDevices;

    /**
     * @var array $androidDevices
     */
    protected $androidDevices;

    /**
     * @var array $data
     */
    protected $data;

    const URL = 'https://fcm.googleapis.com/fcm/send';

    /**
     * @param array $devices
     * @return self
     */
    public function setDevices(array $devices)
    {
        $this->iosDevices = $devices['ios'];
        $this->androidDevices = $devices['android'];

        return $this;
    }

    /**
     * @param array $data
     * @return self
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }


    public function handle()
    {
        $this->sendIos();
        $this->sendAndroid();
    }

    private function sendIos()
    {
        if (empty($this->iosDevices)) {
            return;
        }

        $arrayToSend = [
            'registration_ids' => $this->iosDevices,
            'notification' => [
                'title' => $this->data['title'] ?? '',
                'body' => $this->data['body'] ?? '',
                'sound' => 'default',
                'badge' => '1'
            ],
            'data' => [
                'code' => $this->data['code'] ?? '',
            ],
            'priority'=>'high'
        ];

        $this->execute($arrayToSend);
    }

    private function sendAndroid()
    {
        if (empty($this->androidDevices)) {
            return;
        }

        $arrayToSend = [
            'registration_ids' => $this->androidDevices,
            'notification' => [
                'title' => $this->data['title'] ?? '',
                'body' => $this->data['body'] ?? '',
            ],
            'data' => [
                'code' => $this->data['code'] ?? '',
            ]
        ];

        $this->execute($arrayToSend);
    }

    /**
     * @param $url
     * @param array $dataPost
     * @return bool
     * @throws GuzzleException
     */
    private function execute($dataPost = [])
    {
        Log::debug("------------------ SEND NOTIFICATION-----------------");
        $method = 'POST';
        $result = false;
        try {
            $client = new Client();
            $result = $client->request($method, self::URL, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'key=' . config('fcm.fcm_service_key'),
                ],
                'json' => $dataPost,
                'timeout' => 300,
            ]);

            $result = $result->getStatusCode() == Response::HTTP_OK;

        } catch (Exception $e) {
            Log::debug($e);
        }

        Log::debug("------------------ END EXEC NOTIFICATION AND SEND NOTIFICATION  -----------------");
    }
}
