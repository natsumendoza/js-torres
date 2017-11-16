<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate(request(), [
            'firstName' => 'required|string|max:255',
            'middleName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|string',
            'email' => 'required|string|email|max:255',
            'phoneNo' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user->first_name = $request->get('firstName');
        $user->middle_name = $request->get('middleName');
        $user->last_name = $request->get('lastName');
        $user->gender = $request->get('gender');
        $user->email = $request->get('email');
        $user->phone_no = $request->get('phoneNo');
        $user->address = $request->get('address');
        $user->password = bcrypt($request->get('password'));

        $user->save();

        return redirect('user')->with('success', 'User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find(base64_decode($id));
        $user->delete();

        return redirect('users')->with('success', 'User has been deleted');
    }


    public function showUserList()
    {
        $userList = User::where('role_id', NULL)->get()->toArray();

        return view('users.userList', compact('userList'));
    }
}
