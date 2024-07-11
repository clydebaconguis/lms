<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Session;

class UserController extends Controller
{
    public function clear_session(){
        // Using Session facade
        Session::forget(['id', 'email', 'usertype']);
    }
    public function catalogue_signin(Request $request){
        $isExist = DB::table('users')->where('email', $request->cardid)->exists();
        if (!$isExist) {
            return response()->json(['status' => 'warning', 'message' => 'Card ID doesn\'t exist!']);
        }
        $borrower = DB::table('users')->where('email', $request->cardid)->first();

        if($borrower){
            Session::put([
                'id' => $borrower->id, 
                'email' => $borrower->email,
                'usertype' => $borrower->type,
            ]);
        } 

        return response()->json(['status' => 'success', 'message' => 'Hi, Welcome '. $borrower->name, 'user' => $borrower]);
    }

    public function users()
    {
        return DB::table('users')
        ->join('library_usertype', 'users.usertype', '=', 'library_usertype.id')
        ->select(
            'users.*',
            'library_usertype.usertype'
        )
        ->get();
    }

    public function update_profile(Request $request) {
        $request->validate([
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $user = auth()->user();
        DB::table('users')
        ->where('id', $user->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    
        // if ($request->hasFile('image')) {
        //     $imageName = time() . '.' . $request->image->extension();

        //     // $url = app()->environment('local') ? url('http://essentiel.ck/') : secure_url('http://essentiel.ck/');
            
        //     $activesy = DB::table('sy')->where('isactive', 1)->value('sydesc');
            
        //     // Decode base64 data and save the image
        //     $base64Data = base64_encode(file_get_contents($request->image->getRealPath()));
        //     $decodedData = base64_decode($base64Data);
        //     $clouddestinationPath = 'http://essentiel.ck/'. 'employeeprofile/'. $activesy . '/'. $imageName;
        //     file_put_contents($clouddestinationPath, $decodedData);
            
        //     DB::table('teacher')
        //     ->where('userid', auth()->user()->id)
        //     ->update([
        //         'picurl' => 'employeeprofile/'. $activesy . '/' . $imageName,
        //     ]);
        // }
    
        return response()->json(['status' => 'success', 'message' => 'Profile Updated!']);
    }
    
    public function saveUser(Request $request)
    {
        $isExist = DB::table('users')->where('email', strtolower($request->username))->exists();
        if ($isExist) {
            return response()->json(['status' => 'warning', 'message' => 'Username already exist!']);
        }

        $result = DB::table('users')
            ->insertGetId(
                [
                    'name' => $request->name,
                    'usertype' => $request->usertype,
                    'email' => $request->username,
                    'password' => Hash::make($request->password),
                ]
            );

        if ($result) {
            return response()->json(['status' => 'success', 'message' => 'User saved successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'User failed to save!']);
    }

    public function deleteUser(Request $request)
    {
        DB::table('users')
            ->where('id', $request->id)
            ->delete();

        return array(
            (object) [
                'status' => 200,
                'statusCode' => "success",
                'message' => 'Deleted Successfully!',
            ]
        );
    }

    public function updatePassword(Request $request) {
        // Validate the request data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8',
        ]);
    
        // Get the authenticated user
        $user = auth()->user();
    
        // Verify the current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['status' => 'error', 'message' => 'The current password is incorrect.']);
        }
    
        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->isdefault = 0;
        $user->save();
    
        return response()->json(['status' => 'success', 'message' => 'Password updated successfully.']);
    }

    public function reset_password(Request $request)
    {
        $affectedRows = DB::table('users')
            ->where('id', $request->id)
            ->update([
                'isdefault' => 1,
                'isreset' => 0,
                'password' => Hash::make('123456'),
            ]);
    
        if ($affectedRows > 0) {
            // Update was successful
            return response()->json([
                'status' => 'success',
                'message' => 'Password Reset Successfully!',
            ]);
        } else {
            // No rows were updated (user with given ID not found)
            return response()->json([
                'status' => 'error',
                'message' => 'User not found or no changes made.',
            ], 404); // You can customize the HTTP status code based on your requirements
        }
    }

    public function request_reset_password(Request $request){

        $isExist = DB::table('users')->where('email', strtolower($request->reset_email))->exists();
        if (!$isExist) {
            return response()->json(['status' => 'warning', 'message' => 'Username doesn\'t exist!']);
        }

        DB::table('users')
        ->where('email', $request->reset_email)
        ->update([
            'isreset' => 1
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Request was successfully Sent!'
        ]);
    }
    
}