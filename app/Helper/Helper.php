<?php

namespace App\Helper;

use Illuminate\Support\Facades\Validator;

class Helper
{
    public function format_response()
    {
    }

    static public function check_validation($request_array, $validate_array)
    {
        $response = "pass";
        $validator = Validator::make($request_array->all(), $validate_array);
        if ($validator->fails()) {
            $response =  response(['success' => 0, 'message' => implode($validator->messages()->all())], 422);
        }
        return $response;
    }

    static public function success_response($data, $message="success", $http_response_status_code = 200)
    {
        $resp_success_arr = ["success" => 1, "message" => $message, "data" => $data];
        return response($resp_success_arr, $http_response_status_code);
    }
}
