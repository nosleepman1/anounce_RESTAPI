<?php 

class message {
    public static function json_message($message, $code = 200)  {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        $success = true;
        if ($code < 200 || $code > 299) {
            $success = false;
        }
        echo json_encode([
            'success' => $success,
            'message' => $message,
            'status' => $code    
        ]);
        exit;
    }

    public static function json_datas ($datas){
        header('Content-Type: application/json; charset: utf8');
        echo json_encode([
            'datas' => $datas   
        ]);
        exit;
    }

}