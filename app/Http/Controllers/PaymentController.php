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
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
//use Symfony\Component\HttpFoundation\Response;


use Flash;
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
        $payments = $this->paymentRepository->all();
        $payments = Payment::where("user_id", Auth::user()->id)->with('contract')->get();
        $current = null;
        return view('payments.index2')
            ->with(compact('payments', 'current'));
    }

    public function new_order(Request $request)
    {
        try {
            /*$body = json_decode('{
                "env" : {
                    "terminalType": "APP"
                },
                "merchantTradeNo": "9825382937292",
                "orderAmount": 25.17,
                "currency": "BUSD",
                "goods" : {
                    "goodsType": "01",
                    "goodsCategory": "D000",
                    "referenceGoodsId": "7876763A3B",
                    "goodsName": "Ice Cream",
                    "goodsDetail": "Greentea ice cream cone"
                }
            }');*/
            $db_key = Provider::where('key','API GENERAL BINANCE PAY')->first();
            $apiKey = Crypt::decryptString($db_key->value);
            $secretKey = Crypt::decryptString($db_key->secret_key);
            //$url = 'https://bpay.binanceapi.com/binancepay/openapi/v2/order';
            
            $timestamp = Carbon::now()->isoFormat('x');
            $nonce = Str::random(32);
            $body =[
                "wallet" => "SPOT_WALLET",
                "currency" => "BUSD"
            ];

            $payload = $timestamp."\n".$nonce."\n".json_encode($body)."\n";
            $url = 'https://bpay.binanceapi.com/binancepay/openapi/v2/balance';
            $signature = strtoupper(hash_hmac('sha512',$payload,$secretKey));
            /*$headers = array(
                'Content-Type:application/json',
                'BinancePay-Timestamp:'.$timestamp,
                'BinancePay-Nonce:' . $nonce,
                'BinancePay-Certificate-SN:'.$apiKey,
                'BinancePay-Signature:'.$signature
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$body); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);*/
            //debug($result);
            $response = Http::accept('application/json')
            ->withHeaders([
                'BinancePay-Timestamp'=>$timestamp,
                'BinancePay-Nonce'=>$nonce,
                'BinancePay-Certificate-SN'=>$apiKey,
                'BinancePay-Signature'=>$signature
            ])
            ->post('https://bpay.binanceapi.com/binancepay/openapi/v2/balance', $body);
            
            return $this->sendResponse(json_decode($response),'Test.');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(),500);
        }
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
        ->get();
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

    public function client_pay(Request $request)
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
        
        $input["user_id"] = Auth::user()->id;
        if((int)Carbon::parse()->format('d') >= 28)
        {
            $input["month"] = $months[((int)Carbon::parse()->format('m')+1)%12];
        } else {
            $input["month"] = $months[(int)Carbon::parse()->format('m')];
        }
        $input["total"] = $input["mount"];
        $input["date_transaction"] = Carbon::parse()->format('Y-m-d');
        
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

        Flash::success('Deposito realizado correctamente.');

        return redirect(route('clients.index'));
        
    }

    public function pay(CreatePaymentRequest $request)
    {
        $input = $request->all();

        $input["user_id"] = Auth::user()->id;
        $input["month"] = "Diciembre";
        $input["total"] = 1000.00;
        $input["date_transaction"] = Carbon::parse()->format('Y-m-d');

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
        Flash::success('Deposito recibido correctamente.');

        return redirect(route('payments.index2'));
    }
}
