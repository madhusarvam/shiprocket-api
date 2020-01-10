<?php
class Shiprocket
{
    private $url = 'https://apiv2.shiprocket.in/v1/external/';
    private $username = 'username@domain.com';
    private $password = 'yourSecretPassword';
    private $token;
    function __construct()
    {
        /*
        Constructor to generate Token
        */
        $this->token = $this->generateToken();
    }

    public function get_username()
    {
        /*
        Returns Username
        */
        return $this->username;
    }
    public function get_password()
    {
        /*
        Returns Password
        */
        return $this->password;
    }
    public function get_token()
    {
        /*
        Returns Token
        */
        return $this->token;
    }

    /*
      Generate Token
    */
    public function generateToken()
    {
        $post['email'] = $this->get_username();
        $post['password'] = $this->get_password();
        $data_string = json_encode($post);
        $url = $this->url . 'auth/login';
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($this->isJson($jsonObj) == 1 && $jsonObj != '' && $jsonObj != 'null')
        {
            $dataArr = json_decode($jsonObj, true);
            return $dataArr['token'];
        }
        return false;
    }

    /*
      Get Pickup address details from shiprcket
    */
    public function getPickupAddress()
    {

        $url = $this->url . 'settings/company/pickup';

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->get_token() . ''
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        //print_r($headers); exit();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($this->isJson($jsonObj) == 1 && $jsonObj != '' && $jsonObj != 'null')
        {
            $dataArr = json_decode($jsonObj, true);
            return $dataArr;
        }
        return false;
    }

    /*
      Check pincode is servicable
    */
    public function serviceability($post)
    {

        $data_string = json_encode($post);

        $url = $this->url . 'courier/serviceability';
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->get_token() . ''
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($this->isJson($jsonObj) == 1 && $jsonObj != '' && $jsonObj != 'null')
        {
            $dataArr = json_decode($jsonObj, true);
            return $dataArr;
        }
        return false;
    }

    /*
      Generate Order 
    */
    public function generateOrder($post)
    {

        $data_string = json_encode($post);

        $url = $this->url . 'orders/create/adhoc';
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->get_token() . ''
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($this->isJson($jsonObj) == 1 && $jsonObj != '' && $jsonObj != 'null')
        {
            $dataArr = json_decode($jsonObj, true);
            return $dataArr;
        }
        return false;
    }
    /*
      Generate AWB No.
    */
    public function generateAwbNo($post)
    {

        $data_string = json_encode($post);

        $url = $this->url . 'courier/assign/awb';
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->get_token() . ''
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($this->isJson($jsonObj) == 1 && $jsonObj != '' && $jsonObj != 'null')
        {
            $dataArr = json_decode($jsonObj, true);
            return $dataArr;
        }
        return false;
    }

    /*
      Generate Pickup Request
    */
    public function generatePickup($post)
    {

        $data_string = json_encode($post);

        $url = $this->url . 'courier/generate/pickup';
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->get_token() . ''
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($this->isJson($jsonObj) == 1 && $jsonObj != '' && $jsonObj != 'null')
        {
            $dataArr = json_decode($jsonObj, true);
            return $dataArr;
        }
        return false;
    }

    /*
      Track Courier by AWB No
    */
    public function trackByAwbNo($awbNo)
    {

        $url = $this->url . 'courier/track/awb/' . $awbNo;
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->get_token() . ''
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($this->isJson($jsonObj) == 1 && $jsonObj != '' && $jsonObj != 'null')
        {
            $dataArr = json_decode($jsonObj, true);
            return $dataArr;
        }
        return false;
    }

    /*
      Track Courier by Shipment Id
    */
    public function trackByShipmentId($shipmentId)
    {

        $url = $this->url . 'courier/track/shipment/' . $shipmentId;
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->get_token() . ''
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($this->isJson($jsonObj) == 1 && $jsonObj != '' && $jsonObj != 'null')
        {
            $dataArr = json_decode($jsonObj, true);
            return $dataArr;
        }
        return false;
    }

    /*
      Track Courier by Order ID
    */
    public function trackByOrderId($orderId)
    {

        $url = $this->url . 'courier/track?order_id=' . $orderId;
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->get_token() . ''
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($this->isJson($jsonObj) == 1 && $jsonObj != '' && $jsonObj != 'null')
        {
            $dataArr = json_decode($jsonObj, true);
            return $dataArr;
        }
        return false;
    }

    /*
      Track Multiple Courier by Shipment Id
    */
    public function trackByMulipleShipmentId($post)
    {

        $data_string = json_encode($post);

        $url = $this->url . 'courier/track/awbs';
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->get_token() . ''
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($this->isJson($jsonObj) == 1 && $jsonObj != '' && $jsonObj != 'null')
        {
            $dataArr = json_decode($jsonObj, true);
            return $dataArr;
        }
        return false;
    }

    /*
      Check if string is JSON
    */
    function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);

    }
    /*
      Writes logs in the server
    */
    function writeLog($data)
    {
        $fileName = date("Y-m-d") . ".txt";
        $fp = fopen(dirname($_SERVER["SCRIPT_FILENAME"]) . "/logs/" . $fileName, 'a+');
        $data = date("Y-m-d H:i:s") . " - " . $data;
        fwrite($fp, $data);
        fwrite($fp, "\n");
        fclose($fp);
    }
}

