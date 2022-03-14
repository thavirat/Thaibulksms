<?php namespace Thavirat\Thaibulksms;

class Thaibulksms{
    public $token;

    public function sendSMS($mobile , $message , $sender="" ,  $force="Standard"){
        if(!$sender){
            $sender = env('THAIBULK_SENDER');
        }

        $curl = curl_init();
        $token = env('THAIBULK_TOKEN');
        $secret = env('THAIBULK_SECRET');
        $authen = base64_encode($token.':'.$secret);

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-v2.thaibulksms.com/sms',
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'msisdn='.$mobile.'&force='.$force.'&message='.urlencode($message).'&sender='.$sender,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.$authen,
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}


?>