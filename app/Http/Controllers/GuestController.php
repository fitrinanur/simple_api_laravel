<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Guest;

class GuestController extends Controller
{
    public function index()
    {
        $guest=Guest::all();
        return response()->json(['status' => 'success', 'data' =>$guest]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'phone_number' => 'required',
            'description' => 'required|min:8'
          ]);
   
          if (Guest::create($request->all())) {
            return response()->json(['status' => 'success', 'message' => 'Data has been created' ],201);
          } else {
            return response()->json(['status' => 'error', 'message' => 'Internal Server Error' ],500);
          }
    }


    public function show($id)
    {
        $guest=Guest::find($id);
        if ($guest) {
            return response()->json(['status' => 'success', 'data'=> $guest]);
          }
   
          return response()->json(['status' => 'error', 'message' => 'Data not found'],404);
       
    }

    public function update($id, Request $request)
    { 
        $this->validate($request, [
            'username' => 'required',
            'phone_number' => 'required|unique:users,email,'.$id,
            'description' => 'required|min:8'
          ]);
   
          $guest = Guest::find($id);
          if ($guest) {
            $guest->update($request->all());
            return response()->json(['status' => 'success', 'message' => 'Data has been updated']);
          }
   
          return response()->json(['status' => 'error', 'message' => 'Cannot updating data'],400);

    
    }
    public function destroy($id)
    {
        $guest = Guest::find($id);
        if(is_null($guest))
        {
            return response()->json(['status'=>" error ",'message' =>'not found'], 404);
        }
     
        $success=$guest->delete();
     
        if(!$success)
        {
            return response()->json(['status' => 'error', 'message' => 'Cannot delete data'],500);
        }
     
        return response()->json(['status' => "success",'message' => 'Data has been delete'],200);
    }
}
