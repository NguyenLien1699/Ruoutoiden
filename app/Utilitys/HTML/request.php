<?php
namespace App\Utilitys\HTML;

use Exception;

class request
{
    public $status_code;
    public $response;
    public $url;
    public $type_request;

    public function Execute($url, $Data, $type = 'POST')
    {
        $parameter = '';

        foreach ($Data as $key => $value) {
            $parameter .= $key . "=" . urlencode(trim($value)) . "&";
        }

        if (!empty($parameter) && $parameter[strlen($parameter) - 1] == '&') {
            $parameter = substr($parameter, 0, strlen($parameter) - 1);
        }

        if ((strtolower($type) == 'get' || strtolower($type) == 'delete') && !empty($parameter)) {
            $url .= "?" . trim($parameter);
        }

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_URL, $url);

        if ($type === 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);
        } elseif ($type !== 'get') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        }

        curl_setopt($ch, CURLOPT_TIMEOUT, 999999);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $result = new request();
        $result->url = $url;
        $result->type_request = $type;

        try
        {
            $response = curl_exec($ch);
            if (!$response) {
                $result->status_code = 200;
                $result->response = $response;
            } else {
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $result->response = curl_exec($ch);
                $result->status_code = $http_status;
            }
        } catch (Exception $e) {

        }
        curl_close($ch);
        return $result;
    }

    public function Execute_GET($url, $Data)
    {

        $url = $url . '?';

        foreach ($Data as $key => $value) {
            $url .= $key . "=" . urlencode(trim($value)) . "&";
        }

        if (!empty($url) && $url[strlen($url) - 1] == '&') {
            $url = substr($url, 0, strlen($url) - 1);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = new request();
        $result->url = $url;
        $result->type_request = 'GET';

        $response = curl_exec($ch);
        if (!$response) {
            $result->status_code = 200;
            $result->response = $response;
        } else {
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $result->response = curl_exec($ch);
            $result->status_code = $http_status;
        }

        curl_close($ch);

        return $result;
    }

    public function Execute_get_with_proxy($url, $Data, $proxy)
    {
        $url = $url . '?';

        foreach ($Data as $key => $value) {
            $url .= $key . "=" . urlencode(trim($value)) . "&";
        }

        if (!empty($url) && $url[strlen($url) - 1] == '&') {
            $url = substr($url, 0, strlen($url) - 1);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = null;
        $response = curl_exec($ch);
        if (!$response) {
            $result = curl_exec($ch);
        } else {
            $result = null;
        }

        curl_close($ch);

        return $result;
    }

    public function Execute_Json($url, $Data, $type_request = 'GET')
    {

        $url = $url;

        $data_string = json_encode($Data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length:' . strlen($data_string))
        );

        $result = new request();
        $result->url = $url;
        $result->type_request = $type_request;

        $response = curl_exec($ch);

        if (!$response) {
            $result->status_code = 200;
            $result->response = $response;
        } else {
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($http_status != 200) {
                $result->response = curl_exec($ch);
            }

            $result->status_code = $http_status;
        }

        curl_close($ch);

        return $result;
    }

    public function Execute_Json_Type_Request($url, $Data, $type_request = 'GET')
    {

        $url = $url;

        $data_string = json_encode($Data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type_request);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length:' . strlen($data_string))
        );

        $result = new request();
        $result->url = $url;
        $result->type_request = $type_request;

        $response = curl_exec($ch);

        if (!$response) {
            $result->status_code = 200;
            $result->response = $response;
        } else {
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $result->response = curl_exec($ch);
            $result->status_code = $http_status;
        }

        curl_close($ch);

        return $result;
    }
}
