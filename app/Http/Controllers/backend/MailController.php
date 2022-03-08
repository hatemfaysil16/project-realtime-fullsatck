<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\mailMessage;
use App\Models\MailCreates;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SendGrid;
use App\Jobs\sendMailJop as sendMailJopAlias;



class MailController extends Controller
{

    public function index()
    {

        $users = User::all();
        return view('backend.mail.index',compact('users'));
    }

    public function sendMail(Request $request)
    {
        $validated = $request->validate([
            'users' => 'required',
            'subject' => 'required',
            'body' => 'required',
        ]);

        // insert to database


        if($request->button=='send' ){
            $message = MailCreates::create([
                'users' => json_encode($request->users),
                'subject' => $request->subject,
                'body' => $request->body,
            ]);

            //send to email


            foreach ($request->users as $user)
            {
//                return $user;die;
                mail::to($user)->send( new mailMessage($request->subject,$request->body) );
            }

            //to Queue jop
            // $jop = sendMailJopAlias::dispatch($request->users ,$request->subject ,$request->body);



        }


        if($request->button=='save')
        {
            $message = MailCreates::create([
                'users' => json_encode($request->users),
                'subject' => $request->subject,
                'body' => $request->body,
            ]);

        }



        session()->flash('Add', 'نم الاورسال بنجاح');
        return redirect()->back();
    }




}
