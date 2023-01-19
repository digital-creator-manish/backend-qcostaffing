<?php

namespace App\Helper;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    static public function success_response($data = [], $message = "success", $http_response_status_code = 200, $format = false)
    {
        if ($format) {
            $resp_success_arr = ["success" => 1, "message" => $message, "record" => $data];
        } else {
            $resp_success_arr = ["success" => 1, "message" => $message, "record" => ["data" => $data]];
        }

        return response($resp_success_arr, $http_response_status_code);
    }

    static public function error_response($data = [], $message = "error", $http_response_status_code = 400)
    {
        $resp_success_arr = ["success" => 0, "message" => $message];
        return response($resp_success_arr, $http_response_status_code);
    }


    static function getRecords($model, $request, $data_arr = true)
    {
        $paging = $request->paging ? $request->paging : false;
        $per_page = $request->per_page ? $request->per_page : 0;
        $sortby = $request->sortby ? $request->sortby : "id";
        $sortorder = $request->sortorder == "ASC" ? $request->sortorder : "DESC";
        $searchcol = $request->searchcol ? $request->searchcol : false;
        $searchval = $request->searchval ? $request->searchval : false;
        $searchexp = $request->searchexp ? $request->searchexp : "=";

        $model_name = class_basename($model);

        $query = $model::query();
        if ($model_name == "Form") {
            $query->with('form_type_id', 'created_by', 'updated_by', 'discipline');
        }

        if ($model_name == "News") {
            $query->with('created_by', 'updated_by');
        }

        if ($model_name == "Tutorial") {
            $query->with('created_by', 'updated_by', 'discipline', 'quiz_tutorial');
        }

        if ($model_name == "Skill") {
            $query->with('created_by', 'updated_by', 'discipline');
        }

        if ($model_name == "Document") {
            $query->with('created_by', 'discipline');
        }

        if ($searchcol && $searchval) {
            if ($searchexp == "LIKE") {
                $searchval = '%' . $searchval . '%';
            }
            $query->where($searchcol, $searchexp, $searchval);
        }
        $query->orderBy($sortby, $sortorder);

        $msg = 'success';
        $code = 200;
        $bool = false;
        if ($paging) {
            $result = $query->paginate($per_page);
            $result->appends($_GET)->links();
            $bool = true;
        } else {
            $result = $query->get();
            // return Helper::success_response($result);
        }
        // exit(var_dump($result->toArray()));
        // $res_array = array();
        foreach ($result as $resultObj) {
            if ($resultObj->filename) {
                $resultObj = Self::process_data($resultObj);
                if ($data_arr == false) {
                    return Helper::success_response($resultObj, $msg, $code, $bool);
                }
            }
        }
        // foreach($result->toArray() as $res){
        //     if(array_key_exists("filename", $res)){
        //         $res["filename"] = Self::getFileUrl($res["filename"]);
        //         $res_array[] = $res;
        //     }
        // }

        return Helper::success_response($result, $msg, $code, $bool);
    }


    public static function uploadFile($fileObj)
    {
        $filename = time() . '-' . $fileObj->getClientOriginalName();
        if (Storage::disk('public')->put($filename, file_get_contents($fileObj))) {
            return $filename;
        } else {
            return "";
        }
    }


    public static function getFileUrl($filename)
    {
        return $file_url =  url('api/download?filename=' . $filename); //. '/download?filename=' . ;
    }

    public static function process_data($data)
    {
        $data->filename = Self::getFileUrl($data->filename);
        return $data;
    }

    public static function addRemoveFile($request, $existing_file = "")
    {
        $filename = "";
        if ($existing_file) {
            Storage::delete($existing_file);
        }

        if ($request->file('filename')) {
            $filename = Self::uploadFile($request->file('filename'));
        }
        return $filename;
    }
}
