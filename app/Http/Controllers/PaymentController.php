<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepository;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Contract;
use App\Models\Plan;
use App\Models\User;
use App\Models\Provider;
use App\Models\ClientPayment;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ClientPaymentRequest;
use App\Http\Services\BinanceQRGeneratorService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Traits\BinanceDoughSenderTrait;
//use Symfony\Component\HttpFoundation\Response;


use Flash;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Builder;
use Response;

class PaymentController extends AppBaseController
{
    /** @var  PaymentRepository */
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepo)
    {
        $this->paymentRepository = $paymentRepo;
    }

    /**
     * Display a listing of the Payment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $payments = $this->paymentRepository->all();

        return view('payments.index')
            ->with('payments', $payments);
    }

    /**
     * Show the form for creating a new Payment.
     *
     * @return Response
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * Store a newly created Payment in storage.
     *
     * @param CreatePaymentRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentRequest $request)
    {
        $input = $request->all();

        $payment = $this->paymentRepository->create($input);

        Flash::success('Payment saved successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Display the specified Payment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments.show')->with('payment', $payment);
    }

    /**
     * Show the form for editing the specified Payment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments.edit')->with('payment', $payment);
    }

    /**
     * Update the specified Payment in storage.
     *
     * @param int $id
     * @param UpdatePaymentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentRequest $request)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $payment = $this->paymentRepository->update($request->all(), $id);

        Flash::success('Payment updated successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Remove the specified Payment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $this->paymentRepository->delete($id);

        Flash::success('Payment deleted successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Display a listing of the Payment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index2(Request $request)
    {
        $user = Auth::user();

        $payments = $user
                  ->payments()
                  ->with('contract')
                  ->get();

        $current = null;

        //TODO this must be better implemented
        $lastPaidPayment = $user->payments()
                            ->lastPayment()
                            ->isPaid()
                            ->first();

        $lastPendingPayment = $user->payments()
                            ->lastPayment()
                            ->isPending()
                            ->first();


        if ($lastPaidPayment){
            $current = true;
            $message = "No puedes hacer mas pagos hasta " . $lastPaidPayment->expiration_date;
            Flash::error($message, 'message');
        };

        if($lastPendingPayment){
            $current = true;
            $message = "Tiene un estado de pago en PENDIENTE";
            Flash::error($message, 'message');
        }
;
        return view('payments.index2')
        ->with(compact('payments', 'current'));




    }

    public function generateQR($data)
    {
        $env = \config('app');
        $ngrok = \config('binance.ngrok');

        //IMPORTANT
        if ($env["env"] == 'local' && $env["url"] == "http://localhost:8000") {
            $binanceQR = new BinanceQRGeneratorService($data, $ngrok);
            $binanceQR->generate();
        }
        else {
            $binanceQR = new BinanceQRGeneratorService($data, $env["url"]);
            $binanceQR->generate();
        }

        // return $this->sendResponse(($binanceQR->getResponse()), 200);
        return $binanceQR->getResponse();
    }

    public function client_index(Request $request)
    {
        $input = $request->all();

        $payments = $this->paymentRepository->all();
        $payments = Payment::where("user_id", Auth::user()->id)
                  ->with('contract')
                  ->with('client_payment')
                  ->when( (isset($input['plan']) && $input['plan']!= 0) , function($query) use ($input){
                      return $query->whereHas('client_payment', function($query2) use ($input) {
                          $query2->where('plan_id',$input['plan']);
                      });
                  })
                  ->when( (isset($input['year']) && is_numeric($input['year'])) , function ($query) use ($input) {
                      return $query->whereBetween('created_at',[$input['year'].'-01-01 00:00:00',$input['year'].'-12-31 23:59:59']);
                  })
                  ->when( (isset($input['funds']) && $input['funds'] != 0), function ($query) use ($input) {
                      $months = [
                          1 => 'Enero',
                          2 => 'Febrero',
                          3 => 'Marzo',
                          4 => 'Abril',
                          5 => 'Mayo',
                          6 => 'Junio',
                          7 => 'Julio',
                          8 => 'Agosto',
                          9 => 'Setiembre',
                          10 => 'Octubre',
                          11 => 'Noviembre',
                          12 => 'Diciembre'
                      ];
                      return $query->where('month',$months[$input['funds']]);
                  } )
                  ->get()
                  ->sortBy(function ($payment) {
                      switch ($payment->status) {
                          case 'PENDIENTE':
                              return 1;
                          case 'PAGADO':
                              return 2;
                          case 'VENCIDO':
                              return 3;
                          default:
                              return 4;
                      }
                  });
        $plans = Plan::pluck('name','id')->toArray();

        return view('payments.clients')
            ->with(compact('payments', 'plans'));
    }

    public function client_detail($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments.client_detail')->with('payment', $payment);
    }

    public function select_plan()
    {
        $plans = Plan::get();
        return view('payments.select_plan')->with(compact('plans'));
    }

    public function plan_detail($id)
    {
        $plan = Plan::find($id);
        return view('payments.detail')->with(compact('plan'));
    }

    public function client_pay(ClientPaymentRequest $request)
    {
        $input = $request->all();

        $months = [
            0 => 'Diciembre',
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Setiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        if((int)Carbon::parse()->format('d') >= 28)
        {
            $input["month"] = $months[((int)Carbon::parse()->format('m')+1)%12];
        } else {
            $input["month"] = $months[(int)Carbon::parse()->format('m')];
        }
        $input["total"] = $input["amount"];
        $input["date_transaction"] = Carbon::parse()->format('Y-m-d');
        $input["name"] = $input["month"];
        $input["details"] = $input["month"];


        $qr = $this->generateQR($input);
        if ($qr->status !== "SUCCESS"){
            return $this->sendError($qr, 400);
        }

        $input["user_id"] = Auth::user()->id;

        $input["date_transaction"] = Carbon::parse()->format('Y-m-d');
        // $input["total"] = number_format($input["total"], 7);
        $input["prepay_code"] = $qr->data->prepayId;

        $expireTime = Carbon::createFromTimestamp($qr->data->expireTime / 1000)->format("Y-m-d H:i:s");

        $input["expire_time"] = $expireTime;
        $input["qr_url"] = $qr->data->qrcodeLink;

        $payment = $this->paymentRepository->create($input);

        $profile = Profile::where('user_id',$payment->user_id)->first();
        $contract = [
            'user_id' => $profile->user_id,
            'type' => 2,
            'full_name' => $profile->first_name.' '.$profile->lastname,
            'country' => $profile->country,
            'city' => $profile->city,
            'state' => $profile->state,
            'address' => $profile->address,
            'country_document' => $profile->country_document,
            'type_document' => $profile->type_document,
            'identification_number' => $profile->identification_number,
            'code' => uniqid(),
            'payment_id' => $payment->id
        ];

        $contract = Contract::create($contract);

        $referred_user = User::where('link',$input['code'])->first();

        $client_payment = [
            'user_id' => $profile->user_id,
            'payment_id' => $payment->id,
            'referred_code' => $input['code'],
            'plan_id' => $input['plan_id'],
            'code' => uniqid()
        ];

        if(!empty($referred_user))
        {
            $client_payment['referred_user_id'] = $referred_user->id;
        }

        ClientPayment::create($client_payment);

        $expireTime = Carbon::createFromTimestamp($qr->data->expireTime / 1000)->format("Y-m-d H:i:s");


        $responseData = [
            'qrcodeLink' => $qr->data->qrcodeLink,
            'expiration' => $expireTime,
        ];

        return $this->sendResponse(($responseData), "QR info sent", 200);
    }


    public function pay(Request $request)
    {
        $input = $request->all();
        $qr = $this->generateQR($input);
        if ($qr->status !== "SUCCESS"){
            return $this->sendError($qr, 400);
        }


        $input["user_id"] = Auth::user()->id;
        $input["date_transaction"] = Carbon::parse()->format('Y-m-d');
        // $input["total"] = number_format($input["total"], 7);
        $input["prepay_code"] = $qr->data->prepayId;

        $expireTime = Carbon::createFromTimestamp($qr->data->expireTime / 1000)->format("Y-m-d H:i:s");

        $input["expire_time"] = $expireTime;

        $input["qr_url"] = $qr->data->qrcodeLink;

        $payment = $this->paymentRepository->create($input);


        $profile = Profile::where('user_id',$payment->user_id)->first();
        $contract = [
            'user_id' => $profile->user_id,
            'type' => 1,
            'full_name' => $profile->first_name.' '.$profile->lastname,
            'country' => $profile->country,
            'city' => $profile->city,
            'state' => $profile->state,
            'address' => $profile->address,
            'country_document' => $profile->country_document,
            'type_document' => $profile->type_document,
            'identification_number' => $profile->identification_number,
            'code' => uniqid(),
            'payment_id' => $payment->id
        ];

        $contract = Contract::create($contract);
        // Flash::success('Deposito recibido correctamente.');

        $responseData = [
            'qrcodeLink' => $qr->data->qrcodeLink,
            'expiration' => $expireTime,
        ];

        return $this->sendResponse(($responseData), "QR info sent", 200);
    }

    public function webhook(Request $request){
        $input = $request->input();
        $data = json_decode($input["data"]);
        try {
            $payment = Payment::where("prepay_code", $input["bizId"])->first();


            if ($input["bizStatus"] == "PAY_SUCCESS" && $payment->status == "PENDIENTE"){

                $payment->status = "PAGADO";
                $payment->transact_code = $data->transactionId;

                $transactTime = Carbon::createFromTimestamp($data->transactTime/1000)->format("Y-m-d H:i:s");
                $payment->transact_timestamp = $transactTime;

                if ($payment->user->rol === 2) {
                    $payment->update([
                        'expiration_date' => $payment->date_transaction->addYear(1),
                    ]);
                }

                $payment->save();
            }
        }
        catch(\Exception $e){
                return $this->setResponse($e->getMessage());
        }
        return;
    }

    public function testSendingMoney(){
        $test = BinanceDoughSenderTrait::send(0.0000001, "572351555");
        dd($test);
    }
}
