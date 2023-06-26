<?php

namespace App\Services\Agora;

class ChannelManager
{


    public function fetchChannelData($channel)
    {
        // HTTP basic authentication example in PHP using the <Vg k="VSDK" /> Server RESTful API
        // Customer ID
        $customerKey = "fad3827d867c4848904cdf08d82f2b51";
        // Customer secret
        $customerSecret = "7677805c0a204ecb9282c79c76884183";
        // Concatenate customer key and customer secret
        $credentials = $customerKey . ":" . $customerSecret;

        // Encode with base64
        $base64Credentials = base64_encode($credentials);
        // Create authorization header
        $arr_header = "Authorization: Basic " . $base64Credentials;

        $curl = curl_init();
        // Send HTTP request
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.agora.io/dev/v1/channel/user/90c4f33f5bda4b1da1bcad9d9c5250d1/' . $channel,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',

            CURLOPT_HTTPHEADER => array(
                $arr_header,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            echo "Error in cURL : " . curl_error($curl);
        }

        curl_close($curl);

        return $response;
    }
}
