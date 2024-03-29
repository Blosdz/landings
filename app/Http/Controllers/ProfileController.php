<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\ProfileRepository;
use App\Models\Profile;
use App\Models\User;
use App\Models\Notification;
use App\Models\RejectionHistory;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Session;
use PDF;
use Illuminate\Support\Facades\Auth;
use Monarobase\CountryList\CountryListFacade;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Traits\MakeFile;
use App\Traits\BellTrait;

class ProfileController extends AppBaseController
{
    /** @var  ProfileRepository */
    private $profileRepository;
    use MakeFile;

    public function __construct(ProfileRepository $profileRepo)
    {
        $this->profileRepository = $profileRepo;
    }

    /**
     * Display a listing of the Profile.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $profiles = Profile::orderBy('verified')
                  ->filterByNameOrLastName($request['name'])
                  ->filterByStatus($request['status'])
                  ->get();

        return view('profiles.index')
            ->with('profiles', $profiles);
    }

    public function indexSubscribers(Request $request)
    {
        $profiles = Profile::orderBy('verified')
                  ->filterByNameOrLastName($request['name'])
                  ->filterByStatus($request['status'])
                  ->whereHas('user', function($query) {
                      $query->where('rol', 2);
                  })
                  ->get();

        return view('profiles.index')
            ->with(compact('profiles'));
    }
    public function verified()
    {
        return view('profiles.verified');
    }
    /**
     * Show the form for creating a new Profile.
     *
     * @return Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created Profile in storage.
     *
     * @param CreateProfileRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileRequest $request)
    {
        $input = $request->all();

        $profile = $this->profileRepository->create($input);

        Flash::success('Profile saved successfully.');

        return redirect(route('profiles.index'));
    }

    /**
     * Display the specified Profile.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profile = $this->profileRepository->find($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        return view('profiles.show')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified Profile.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //$profile = $this->profileRepository->find($id);
        $profile = Profile::where('id', $id)->with('user')->first();
        
        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        return view('profiles.edit')->with('profile', $profile);
    }

    /**
     * Update the specified Profile in storage.
     *
     * @param int $id
     * @param UpdateProfileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileRequest $request)
    {
        $profile = $this->profileRepository->find($id);
        //dd($profile);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        $data = $request->all();
        //dd($data);

        if(!$data["obs"] && $request['verified'] == 3){
            Flash::error("Tiene que ingresar observacion.");
            return redirect()->back();
        }

        $profile = $this->profileRepository->update($request->all(), $id);
        $user = User::where("id", $profile->user_id);
        if ($profile->verified == 2) {
            $user->update(['validated' => 1]);
            $notification = Notification::create([
                'title' => "Validación de información",
                'body' => "Su informacion ha sido validado Correctamente",
                'user_id' => $profile->user_id,
            ]);
            BellTrait::verifyNotification($profile->user_id, 'notification', true);
        } else {

            if ($profile->verified == 3) {
                $notification = Notification::create([
                    'title' => "Validación de información",
                    'body' => $data["obs"],
                    'user_id' => $profile->user_id,
                ]);
                RejectionHistory::create([
                    'user_id'   => $profile->user_id,
                    'comment'   => $data["obs"],
                    'date'      => Carbon::now()
                ]);
                BellTrait::verifyNotification($profile->user_id, 'notification', true);
            }
            $user->update(['validated' => 0]);

        }
        //dd($user);

        Flash::success('Verificacion de informacion guardado correctamente.');

        return redirect(route('profiles.index'));
    }

    /**
     * Remove the specified Profile from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profile = $this->profileRepository->find($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        $this->profileRepository->delete($id);

        Flash::success('Profile deleted successfully.');

        return redirect(route('profiles.index'));
    }

    public function edit2()
    {
        //$profile = $this->profileRepository->find($id);
        $profile = Profile::where("user_id", Auth::user()->id)->first();

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        return view('profiles.edit2')->with('profile', $profile);
    }

    public function update2($id, UpdateProfileRequest $request)
    {
        $profile = $this->profileRepository->find($id);
        
        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        $data = $request->all();

        /*
        //dd($data);

        $path = 'profile/';
  
        if($request->hasFile('file')){
            if ( ! Storage::exists($path)) {
                Storage::makeDirectory('public/'.$path, 0777, true);
            }
        
            $file = $request->file('file');
            $extantion = $file->getClientOriginalExtension();
            $prefix = "profile";
            $dealer_name = $prefix.'-'.uniqid();

            $filename = $dealer_name.'.'.$extantion;
            $path = 'public/'.$path;
            $file->storeAs($path, $filename);
        }

        $path = 'profile/';
        if($request->hasFile('file_r')){
            if ( ! Storage::exists($path)) {
                Storage::makeDirectory('public/'.$path, 0777, true);
            }
        
            $file = $request->file('file_r');
            $extantion = $file->getClientOriginalExtension();
            $prefix = "profile";
            $dealer_name = $prefix.'-'.uniqid();

            $filename2 = $dealer_name.'.'.$extantion;
            $path = 'public/'.$path;
            $file->storeAs($path, $filename2);
        }

        $path = 'profile/';
        if($request->hasFile('profile_picture')){
            if ( ! Storage::exists($path)) {
                Storage::makeDirectory('public/'.$path, 0777, true);
            }
        
            $file = $request->file('profile_picture');
            $extantion = $file->getClientOriginalExtension();
            $prefix = "profile";
            $dealer_name = $prefix.'-'.uniqid();

            $filename3 = $dealer_name.'.'.$extantion;
            $path = 'public/'.$path;
            $file->storeAs($path, $filename3);
        }

        $data["dni"] = substr($path.$filename, 7);
        $data["dni_r"] = substr($path.$filename2, 7);
        $data["profile_picture"] = substr($path.$filename3, 7);
        
        //dd($data);
        */
        
        $data["verified"] = 1;
        $profile = $this->profileRepository->update($data, $id);
        
        Flash::success('Verificacion de informacion guardado correctamente.');

        return redirect(route('profiles.user'));
    }

    public function upload_file(Request $request){

        $profile = Profile::where("user_id", Auth::user()->id)->first();

        $file_fields;
        $file_fields[0] = "dni";
        $file_fields[1] = "dni_r"; 
        $file_fields[2] = "profile_picture"; 
        $file_fields[3] = "dni2";
        $file_fields[4] = "dni2_r"; 
        $file_fields[5] = "profile_picture2"; 
        $file_fields[6] = "dni3";
        $file_fields[7] = "dni3_r"; 
        $file_fields[8] = "profile_picture3"; 

        $file_fields[9] = "business_file"; 
        $file_fields[10] = "power_file"; 
        $file_fields[11] = "taxes_file"; 

        $path;
        $name;

        for ( $i = 0; $i < sizeof($file_fields); $i++)
        {
            if ($request->hasFile($file_fields[$i])) {
                $filePath = 'profile/';

                if (!file_exists(storage_path($filePath))) {
                    Storage::makeDirectory('public/'.$filePath, 0777, true);
                }
                $name = uniqid().'.'.$request->file($file_fields[$i])->getClientOriginalExtension();
                $path = $filePath.$name;

                if (is_file(storage_path('/app/public/'.$profile[$file_fields[$i]]))){   
                   unlink(storage_path('/app/public/'.$profile[$file_fields[$i]]));
                }
                $request->file($file_fields[$i])->storeAs('public/'.$filePath, $name);
                $profile->update([$file_fields[$i] => $path]);
            }
        }
        return response()->json(
        [
            'url'=> url('/storage/'.$path),
            'message'=> $name.' subido',
            'file_name'=> $name
        ], 200);
    }
}
