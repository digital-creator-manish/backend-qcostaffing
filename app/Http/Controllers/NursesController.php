<?php

namespace App\Http\Controllers;

use App\Models\Nurses;
use Illuminate\Http\Request;
use App\Http\Resources\NursesResource;
use App\Models\NurseDuty;
use Illuminate\Support\Facades\Validator;

class NursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Nurses = Nurses::with('NurseDuty')->get();
        
		return response([ 'nurses' => $Nurses, 'message' => 'Success'], 200);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

		$validator = Validator::make($data, [
			'fname' => 'required|max:50',
			'lname' => 'required|max:50',
			'm_initial' => 'required|max:50',
			'maiden_name' => 'required|max:50',
			'social_security_number' => 'required|max:50',
        ]);

		if($validator->fails()){
			return response(['error' => $validator->errors(), 'Validation Error']);
		}

       // var_dump($data);
       // exit;


                // create the user
        $Nurses = new Nurses;
        $Nurses->fname = $data["fname"];
        $Nurses->lname = $data["lname"];
        $Nurses->m_initial = $data["m_initial"];
        $Nurses->maiden_name = $data["maiden_name"];
        $Nurses->social_security_number = $data["social_security_number"];
        $Nurses->save();
        //var_dump($Nurses); exit;

        $NurseDuty = new NurseDuty;
        $NurseDuty->available_duty = $data["available_duty"];
        $NurseDuty->available_dutytime = $data["available_dutytime"];
        $NurseDuty->available_day = $data["available_day"];

        // option 1:
        // this will set the user_id on the role, and then save the role to the db
        $NurseDuty->Nurses()->associate($Nurses);
        $NurseDuty->save();

        $Nurses = Nurses::with('NurseDuty')->get();

		return response([ 'nurses' => $Nurses, 'message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nurses  $nurses
     * @return \Illuminate\Http\Response
     */
    public function show(Nurses $nurses)
    {
        //
        $Nurses = Nurses::with('NurseDuty')->get();
        
		return response([ 'nurses' => $Nurses, 'message' => 'Success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nurses  $nurses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nurses $nurses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nurses  $nurses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nurses $nurses)
    {
        //
    }
}
/*
＄users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();
            */