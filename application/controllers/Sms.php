<?php

class MyController extends CI_Controller {

    public function send_message() {
        $this->load->library('infobip_lib');

        $from = 'MYAPP'; // Replace with your desired sender ID
        $to = '+639123456789'; // Replace with the recipient phone number
        $text = 'Hello, world!'; // Replace with your message text

        $message_id = $this->infobip_lib->send_sms($from, $to, $text);

        if ($message_id) {
            echo 'Message sent successfully with ID ' . $message_id;
        } else {
            echo 'Failed to send message';
        }
    }

}
