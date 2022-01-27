<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail as MailCustom;
use App\Mail\SendMail;

use Flash;
use Response;
use Hash;

class UserController extends AppBaseController
{
    /** @var $userRepository UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = User::whereIn("rol", [2,3])->get();
        //$users = $this->userRepository->all();

        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = $this->userRepository->create($input);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $input =  $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
        $user = $this->userRepository->update($input, $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    public function invite(Request $request)
    {
        $user = $this->userRepository->find(Auth::user()->id);

        return view('users.invite')->with('user', $user);
    }

    public function link(Request $request)
    {

        $input =  $request->all();

        $exist = User::where("link", $input["link"])->first();
        if ($exist) {
            Flash::error('El codigo ('.$input["link"].') ya ha sido usado.');
        } else {
            $user = $this->userRepository->update($input, Auth::user()->id);
            if ($user) {
                Flash::success('Enlace de invitacion guardado correctamente.');
            }
        }

        return redirect(route('invite.user'));
    }

    public function confirmationEmail($token, Request $request)
    {

        $user = User::where("remember_token", $token)->get()->first();
        //dd($user);
        if(!$user->email_verified_at){
            $data = [
                'email_verified_at' => Carbon::now()
            ];
            //dd($data);
            $user = $this->userRepository->update($data, $user->id);

            $data = [
                "email_send" => $user->email,
                "view" => "emails.welcome",
                "subject" => "AEIA EMPIEZA A INVERTIR [Bienvenido]",
            ];
            $MailCustom = MailCustom::to($data['email_send'])->queue(new SendMail($data));
        }

        return redirect(route('login'));
    }
}
