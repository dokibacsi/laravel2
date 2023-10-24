<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    public function index(){
        return Lending::all();
    }

    public function show ($user_id, $copy_id, $start)
    {
        $lending = Lending::where('user_id', $user_id)->where('copy_id', $copy_id)->where('start', $start)->get();
        return $lending[0];
    }


    public function destroy($user_id, $copy_id, $start){
        LendingController::show($user_id, $copy_id, $start)->delete();
    }
    /*
    public function update(Request $request, $user_id, $copy_id, $start){
        $lending = Lending::show($user_id, $copy_id, $start);
        $lending->user_id = $request->user_id;
        $lending->copy_id = $request->copy_id;
        $lending->start = $request->start;
        $lending->save();
    }
    */
    public function store(Request $request){
        $lending = new Lending();
        $lending->user_id = $request->user_id;
        $lending->copy_id = $request->copy_id;
        $lending->start = $request->start;
        $lending->save();
        
    }

    public function userOneWith(){
        $user = Auth::user();
        $lendings = Lending::with('userOne')->where('user_id','=',$user->id)->get();
    }


}
