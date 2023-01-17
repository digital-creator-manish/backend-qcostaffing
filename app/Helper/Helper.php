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

    static public function success_response($data, $message = "success", $http_response_status_code = 200, $format = false)
    {
        if ($format) {
            $resp_success_arr = ["success" => 1, "message" => $message, "record" => $data];
        }else{
            $resp_success_arr = ["success" => 1, "message" => $message, "record" => ["data" => $data]];
        }

        return response($resp_success_arr, $http_response_status_code);
    }


    static function getRecords($model, $request)
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
            //exit("hello-world1");
            $query->with('created_by', 'updated_by', 'discipline', 'quiz_tutorial');
        }

        if ($searchcol && $searchval) {
            if ($searchexp = "LIKE") {
                $searchval = '%' . $searchval . '%';
            }
            $query->where($searchcol, $searchexp, $searchval);
        }
        $query->orderBy($sortby, $sortorder);
        if ($paging) {
            $discipline = $query->paginate($per_page);
            $discipline->appends($_GET)->links();
            return Helper::success_response($discipline, 'success', 200, true);
        } else {
            $discipline = $query->get();
            return Helper::success_response($discipline);

        }
    }
}
