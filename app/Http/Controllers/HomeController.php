<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail as MailCustom;
use App\Mail\SendMail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['sendmail']]);
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

    public function sendmail(Request $request)
    {

        $data = $request->all();
        
        $data['email_send'] = "danieldantecuevas@gmail.com";
        $MailCustom = MailCustom::to($data['email_send'])->queue(new SendMail($data));

        return response()->json([
            'status'        => true,
            'message'       => $data
        ], 200);

    }
}
