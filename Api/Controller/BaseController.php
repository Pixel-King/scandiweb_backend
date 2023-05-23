<?php

abstract class BaseController{
    public function __call($name, $arguments)
    {
        $this->sendOutput(404, 'Not Found');
    }

    protected function getQueryStringParams()
    {
        $arrArgs = array();
        if(isset($_SERVER['QUERY_STRING'])){
            parse_str($_SERVER['QUERY_STRING'], $arrArgs);
        } 
        return $arrArgs;
    }

    protected function sendOutput( $message, $data = null )
    {
        header_remove('Set-Cookie');
        $response = null;

        if (isset($data)) 
        {
            $response = [
                'status' => http_response_code(),
                'message' => $message,
                'data' => $data
            ];
        } else {
            $response = [
                'status' => http_response_code(),
                'message' => $message
            ];
        }

        echo json_encode($response);
        exit;
    }
}