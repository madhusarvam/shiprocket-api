<?php
class Shiprocket {
      private $url          = 'https://apiv2.shiprocket.in/v1/external/';
      private $username     = 'username@domain.com';
      private $password     = 'yourSecretPassword';
      private $token;
    function __construct()
    {
        $this->token = $this->generateToken();
    }
       
    public function get_username()
    {
          return $this->username;
    }
    public function get_password()
    {
        return $this->password;
    }
    public function get_token()
    {
        return $this->token;
    }

    public function generateToken()
    {
        $post['email'] = $this->get_username();
        $post['password'] = $this->get_password();
        $data_string = json_encode($post);
        $url = $this->url.'auth/login';
        $headers= array('Accept: application/json','Content-Type: application/json','Content-Length: ' . strlen($data_string));
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if($this->isJson($jsonObj)==1 && $jsonObj!='' && $jsonObj!='null')
        {
            $dataArr	  =	json_decode($jsonObj,true);
            return $dataArr['token'];
        }
        return false;
    }


    public function getPickupAddress()
    {

        $url = $this->url.'settings/company/pickup';

        $headers= array('Accept: application/json','Content-Type: application/json','Authorization: Bearer '.$this->get_token().'');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        //print_r($headers); exit();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if($this->isJson($jsonObj)==1 && $jsonObj!='' && $jsonObj!='null')
        {
            $dataArr	  =	json_decode($jsonObj,true);
            return $dataArr;
        }
        return false;
    }


    public function serviceability($post)
    {

        $data_string = json_encode($post);

        $url = $this->url.'courier/serviceability';
        $headers= array('Accept: application/json','Content-Type: application/json','Authorization: Bearer '.$this->get_token().'');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if($this->isJson($jsonObj)==1 && $jsonObj!='' && $jsonObj!='null')
        {
            $dataArr	  =	json_decode($jsonObj,true);
            return $dataArr;
        }
        return false;
    }

    public function generateOrder($post)
    {

        $data_string = json_encode($post);

        $url = $this->url.'orders/create/adhoc';
        $headers= array('Accept: application/json','Content-Type: application/json','Authorization: Bearer '.$this->get_token().'');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if($this->isJson($jsonObj)==1 && $jsonObj!='' && $jsonObj!='null')
        {
            $dataArr	  =	json_decode($jsonObj,true);
            return $dataArr;
        }
        return false;
    }
    public function generateAwbNo($post)
    {

        $data_string = json_encode($post);

        $url = $this->url.'courier/assign/awb';
        $headers= array('Accept: application/json','Content-Type: application/json','Authorization: Bearer '.$this->get_token().'');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if($this->isJson($jsonObj)==1 && $jsonObj!='' && $jsonObj!='null')
        {
            $dataArr	  =	json_decode($jsonObj,true);
            return $dataArr;
        }
        return false;
    }

    public function generatePickup($post)
    {

        $data_string = json_encode($post);

        $url = $this->url.'courier/generate/pickup';
        $headers= array('Accept: application/json','Content-Type: application/json','Authorization: Bearer '.$this->get_token().'');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if($this->isJson($jsonObj)==1 && $jsonObj!='' && $jsonObj!='null')
        {
            $dataArr	  =	json_decode($jsonObj,true);
            return $dataArr;
        }
        return false;
    }

    public function trackByAwbNo($awbNo)
    {

        $url = $this->url.'courier/track/awb/'.$awbNo;
        $headers= array('Accept: application/json','Content-Type: application/json','Authorization: Bearer '.$this->get_token().'');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if($this->isJson($jsonObj)==1 && $jsonObj!='' && $jsonObj!='null')
        {
            $dataArr	  =	json_decode($jsonObj,true);
            return $dataArr;
        }
        return false;
    }

    public function trackByShipmentId($shipmentId)
    {

        $url = $this->url.'courier/track/shipment/'.$shipmentId;
        $headers= array('Accept: application/json','Content-Type: application/json','Authorization: Bearer '.$this->get_token().'');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if($this->isJson($jsonObj)==1 && $jsonObj!='' && $jsonObj!='null')
        {
            $dataArr	  =	json_decode($jsonObj,true);
            return $dataArr;
        }
        return false;
    }


    public function trackByOrderId($orderId)
    {

        $url = $this->url.'courier/track?order_id='.$orderId;
        $headers= array('Accept: application/json','Content-Type: application/json','Authorization: Bearer '.$this->get_token().'');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if($this->isJson($jsonObj)==1 && $jsonObj!='' && $jsonObj!='null')
        {
            $dataArr	  =	json_decode($jsonObj,true);
            return $dataArr;
        }
        return false;
    }

    public function trackByMulipleShipmentId($post)
    {
//"awbs": ["788830567028","788829354408"]
        $data_string = json_encode($post);

        $url = $this->url.'courier/track/awbs';
        $headers= array('Accept: application/json','Content-Type: application/json','Authorization: Bearer '.$this->get_token().'');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $jsonObj = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if($this->isJson($jsonObj)==1 && $jsonObj!='' && $jsonObj!='null')
        {
            $dataArr	  =	json_decode($jsonObj,true);
            return $dataArr;
        }
        return false;
    }


      function isJson($string) {
 		json_decode($string);
 		return (json_last_error() == JSON_ERROR_NONE);
                
      }
      function writeLog($data){
		$fileName = date("Y-m-d").".txt";
		$fp = fopen(dirname($_SERVER["SCRIPT_FILENAME"])."/logs/".$fileName, 'a+');
		$data = date("Y-m-d H:i:s")." - ".$data;
		fwrite($fp,$data);
                fwrite($fp,"\n");
		fclose($fp);
	}
}
