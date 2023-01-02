<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provider;
use Illuminate\Support\Facades\Crypt;


class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::truncate();

        $Provider = Provider::insert([[
          'key' => 'API KEY AEIA GENERAL',
          'value' => Crypt::encryptString('CHMpPARtmrT0u9V84j0777jm0Nxs5RHOEXQVss4rCUWTWrEgZaD5ul99VPDj2pfZ'),
        ],[
          'key' => 'API FONDO ENERO',
          'value' => Crypt::encryptString('fgwrwApkk8ExAjAeyTwDDRCqPejRCwTMP8lCuxni1VTfO0qZ608a56ByUs1we2j7'),
        ],[
          'key' => 'API FONDO FEBRERO',
          'value' => Crypt::encryptString('viYzNAvMfEtn4SQCqG40wThgdK5C81rRVIArJ8V5SdTGLULM4464DL3me2GypRof'),
        ],[
          'key' => 'API FONDO MARZO',
          'value' => Crypt::encryptString('qoJpqEhLxvrgPt5y65LxRnL6Kg41AdR7TlkZefgWLAoJoCcsHWhpPRsEExWVcgtq'),
        ],[
          'key' => 'API FONDO ABRIL',
          'value' => Crypt::encryptString('sCwuopPOF508o3krNpyGxVTPBF2mXdtMQcuHJg6C2EzTWQUGdmQi86hyic6mCt2H'),
        ],[
          'key' => 'API FONDO MAYO',
          'value' => Crypt::encryptString('rqsDF6LQCTOEsGG0M14S4T0i9KFeV8t6nN9jjbGoMAZEXUkbrMCSjlXkUG0K9sjG'),
        ],[
          'key' => 'API FONDO JUNIO',
          'value' => Crypt::encryptString('Qsu4pv0EupbFzGG8FftzF7KcPbrBxwGrKYCTrXTTpICH7WNLSqWiurL6A9vV4EVu'),
        ],[
          'key' => 'API FONDO JULIO',
          'value' => Crypt::encryptString('xi3g8Z7QfPh4bmQhnIqn7RdIizjfy9LXLMCY9IO0tA9f3zF53cFIVKQpJrF304eu'),
        ],[
          'key' => 'API FONDO AGOSTO',
          'value' => Crypt::encryptString('Pm9ymibgzynjDFYtkno9Ay2c92zqq4n4Gz5RVKG0ovbgmxxEMeWIrHSJDoK409RB'),
        ],[
          'key' => 'API FONDO SETIEMBRE',
          'value' => Crypt::encryptString('ls5OzSSOi2CkOhWY7y1cFomnb9NfT4LYc79qESG4bBMQF8cj3NCkRDmtH92ukK9i'),
        ],[
          'key' => 'API FONDO OCTUBRE',
          'value' => Crypt::encryptString('4DG1uOC0XcYovZG5GLnySbsZ2pA5pnYYyqwuUquEqGjcRjjfqtKvpGk8TUkjp1yI'),
        ],[
          'key' => 'API FONDO NOVIEMBRE',
          'value' => Crypt::encryptString('fYmkr4e0BI5hWhQh1WI1YCqDc9vbFkYPUnmUvy1aH468Z7XRxeeErL6NNwOGzGyL'),
        ],[
          'key' => 'API FONDO DICIEMBRE',
          'value' => Crypt::encryptString('2z5IC4anBsSRgaHZ6xGzzMdrdGSKT1X3FS1PzK5nt38J41BkMg2IMMHVF3kFNAL3'),
        ],[
          'key' => 'API CTA CAPITAL ACOPIADO',
          'value' => Crypt::encryptString('yC4VLLOIyXSQ2ydn7OaK4UKv9KqTyOr79rTX4iGARhwRoQPqiC5oyZNCV5lOEsRE'),
        ],[
          'key' => 'API CTA MEMBRESÍAS',
          'value' => Crypt::encryptString('BkQZrl690RxHyDC7dBS33Lr5ttcWg1tA1fQhp5gNNm1XiTNpVcATwHJPNuxPfLvp'),
        ],[
          'key' => 'API PAGOS',
          'value' => Crypt::encryptString('9Oq4YrBSVn6c82GMPeT317EIvStq9mDJhQdJOjMmlYRUTvSOpq0LpUoQ1qums4Cb'),
        ]]);
    }
}
