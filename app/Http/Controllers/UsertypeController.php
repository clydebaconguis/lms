<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UsertypeController extends Controller
{
    public function all_usertype(){
        return DB::table('library_usertype')->where('deleted', 0)->get();
    }
    public function get_usertype(Request $request){
        $usertype = DB::table('library_usertype')
        ->where('id', $request->id)
        ->where('deleted', 0)
        ->first();

        return response()->json($usertype);
    }
    public function add_usertype(Request $request){
        if($request->purpose == 'store'){
            $result = DB::table('library_usertype')
                ->insertGetId(
                    [
                        'usertype' => $request->usertype,
                    ]
                );
    
            if ($result) {
                return response()->json(['status' => 'success', 'message' => 'Usertype added successfully!']);
            }
        }else{
            DB::table('library_usertype')
                ->where('id', $request->id)
                ->update(
                    [
                        'usertype' => $request->usertype,
                    ]
                );
                return response()->json(['status' => 'success', 'message' => 'Updated successfully!']);
        }

    }
    public function delete_usertype(Request $request)
    {
        DB::table('library_usertype')
            ->where('id', $request->id)
            ->update([
                'deleted' => 1
            ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully!'
        ]);
    }

}
