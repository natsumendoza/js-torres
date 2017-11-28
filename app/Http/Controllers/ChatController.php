<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin())
        {
            $clientListTemp = DB::table('users')
                ->leftJoin('messages', 'users.id', '=', 'messages.from')
                ->select(DB::raw('users.*, count(messages.read_flag) as unread_message'))
                ->where('users.id', '<>', Auth::user()->id)
                ->groupBy('users.id')
                ->get();

            $clientList = array();
            foreach($clientListTemp as $client)
            {
                $clientList[] = (array) $client;
            }


            return view('chats.chatClientList', compact('clientList'));
        }
        else
        {
            return redirect('/');
        }
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
        date_default_timezone_set('Asia/Manila');
        $validated_message = array();
        $redirect = "";

        if(Auth::user()->isAdmin())
        {
            $validated_message = $this->validate($request, [
                'to' => 'required',
                'message' => 'required',
            ]);
            $validated_message['to'] = base64_decode($validated_message['to']);
            $redirect = "/chat/admin/" . base64_encode($validated_message['to']);
        }
        else
        {
            $validated_message = $this->validate($request, [
                'message' => 'required',
            ]);
            $validated_message['to'] = 1;
            $redirect = "/chat/client";
        }
        $validated_message['from'] = Auth::user()->id;
        $validated_message['read_flag'] = config('constants.NO');

        Message::create($validated_message);

        return redirect($redirect);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $clientId
     * @return \Illuminate\Http\Response
     */
    public function chatAdminSide($clientId)
    {
        if(Auth::user()->isAdmin())
        {
            $data = array();

            $clientId = base64_decode($clientId);

            $this->updateReadFlag($clientId);

            $data['user'] = User::find($clientId);
            $messagesTemp = DB::table('messages')
                ->where(function($query) use ($clientId){
                    $query->where('from', $clientId);
                    $query->where('to', Auth::user()->id);
                })
                ->orWhere(function($query) use ($clientId){
                    $query->where('from', Auth::user()->id);
                    $query->where('to', $clientId);
                })->get();

            $data['messages'] = array();
            foreach($messagesTemp as $message)
            {
                $data['messages'][] = (array) $message;
            }

            return view('chats.chatAdminSide', compact('data'));
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function chatClientSide()
    {
        if(!Auth::guest() AND !Auth::user()->isAdmin())
        {
            $this->updateReadFlag();

            $data['messages'] = array();
            $data['messages'] = Message::where('from', Auth::user()->id)
                ->orWhere('to', Auth::user()->id)
                ->get()->toArray();

            return view('chats.chatClientSide', compact('data'));
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateReadFlag($sender = NULL)
    {
        $unreadMessages = 0;
        if($sender != NULL)
        {
            Message::where('to', Auth::user()->id)
                ->where('from', $sender)
                ->update(array('read_flag' => config('constants.YES')));

            // COUNT UNREAD MESSAGE
            $unreadMessages = Message::where('to', Auth::user()->id)
                ->where('read_flag', config('constants.NO'))
                ->count();
        }
        else
        {
            Message::where('to', Auth::user()->id)
                ->update(array('read_flag' => config('constants.YES')));
        }



        Session::put('unreadMessages', $unreadMessages);
    }
}
