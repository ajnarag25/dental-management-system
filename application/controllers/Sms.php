<?php 

class Sms extends CI_Controller {
    public function index() {
        // Infobip API key
        $api_key = 'f1c4e88b60ffd3ab2209472711f8a556-8556bbaf-8ff4-4614-9915-ef11193d96ba';
        // Infobip API sender name
        $sender_name = 'iSmileDentalCare';
        // Registered Infobip API number
        $phone_number = '639455776246';
        // Infobip API message
        $message_text = 'Sample working text messsage through sms';
      
        // Set up the API URL
        $api_url = "https://api.infobip.com/sms/1/text/single";
      
        // Set up the request headers
        $headers = array(
          'Authorization: App ' . $api_key,
          'Content-Type: application/json'
        );
      
        // Set up the request body
        $data = array(
          'from' => $sender_name,
          'to' => $phone_number,
          'text' => $message_text
        );
      
        // Convert the data to JSON format
        $json_data = json_encode($data);
      
        // Send the request using cURL
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
      
        // Output the response
        echo $response;
      }
      
}

