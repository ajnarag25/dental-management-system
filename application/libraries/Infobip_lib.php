<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'vendor/autoload.php'); // Adjust the path to the Infobip PHP SDK

use Infobip\Api\Configuration;
use Infobip\Api\SendSmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsRequest;

class Infobip_lib {

    protected $config;
    protected $api_instance;

    public function __construct() {
        $this->config = Configuration::getDefaultConfiguration()->setApiKey('api-key', 'YOUR_API_KEY');
        $this->api_instance = new SendSmsApi(new GuzzleHttp\Client(), $this->config);
    }

    public function send_sms($from, $to, $text) {
        $destination = new SmsDestination();
        $destination->setTo($to);

        $request = new SmsRequest();
        $request->setFrom($from);
        $request->setDestinations([$destination]);
        $request->setText($text);

        try {
            $result = $this->api_instance->sendSmsMessage($request);
            return $result->getMessages()[0]->getMessageId();
        } catch (Exception $e) {
            return null;
        }
    }

}
