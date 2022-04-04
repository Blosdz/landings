<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail as MailCustom;
use App\Mail\SendMail;
use App\Models\Event;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['sendmail', 'welcome']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        $dt = Carbon::Now();
        $events = Event::orderBy('date', 'DESC')
            ->where('date', '>',$dt)->get();
        //dd($events);
        return view('welcome')->with('events', $events);
    }

    public function sendmail(Request $request)
    {

        $data = $request->all();
        
        $data['email_send'] = "dbutron9211@gmail.com";
        //data['email_send'] = "danieldantecuevas@gmail.com";
        $MailCustom = MailCustom::to($data['email_send'])->queue(new SendMail($data));

        return response()->json([
            'status'        => true,
            'message'       => $data,
            'MailCustom'    => $MailCustom
        ], 200);

    }
}
