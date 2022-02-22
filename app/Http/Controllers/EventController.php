<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Repositories\EventRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Traits\MakeFile;
use App\Models\User;
use DB;


class EventController extends AppBaseController
{
    /** @var  EventRepository */
    private $eventRepository;
    use MakeFile;

    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepository = $eventRepo;
    }

    /**
     * Display a listing of the Event.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $events = $this->eventRepository->all();

        return view('events.index')
            ->with('events', $events);
    }

    /**
     * Show the form for creating a new Event.
     *
     * @return Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created Event in storage.
     *
     * @param CreateEventRequest $request
     *
     * @return Response
     */
    public function store(CreateEventRequest $request)
    {
        $input = $request->all();

        $file = 'image';
        if ($request->hasFile($file)) {
          $filePath = 'image/event/';         
          $input = $this->makeFile($request,$filePath,$file);
        }

        $event = $this->eventRepository->create($input);

        Flash::success('Event saved successfully.');

        return redirect(route('events.index'));
    }

    /**
     * Display the specified Event.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }

        return view('events.show')->with('event', $event);
    }

    /**
     * Show the form for editing the specified Event.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }

        return view('events.edit')->with('event', $event);
    }

    /**
     * Update the specified Event in storage.
     *
     * @param int $id
     * @param UpdateEventRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventRequest $request)
    {
        $event = $this->eventRepository->find($id);
        $input = $request->all();

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }

        $file = 'image';
        if ($request->hasFile($file)) {
          $filePath = 'image/event/';   
          $input = $this->updateFile($request,$filePath,$event,$file);
        }
        $event = $this->eventRepository->update($input, $id);

        Flash::success('Event updated successfully.');

        return redirect(route('events.index'));
    }

    /**
     * Remove the specified Event from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }
        $file = 'image';
        $filePath = 'image/event/';
        $this->deleteFile($filePath,$event,$file);
        $this->eventRepository->delete($id);

        Flash::success('Event deleted successfully.');

        return redirect(route('events.index'));
    }
    public function rejectionHistory($user_id)
    {
        $user = User::join('rejection_history', 'users.id', '=', 'rejection_history.user_id')
               ->where('rejection_history.user_id', $user_id)
               ->get(['users.*', 'rejection_history.comment','rejection_history.date']);

        return view('profiles.reject_history_table')->with('user', $user);
    }
    public function DeleteRejectionHistory($user_id)
    {
        DB::table('rejection_history')->where('user_id', '=', $user_id)->delete();
        Flash::success('Event deleted successfully.');
        return redirect(route('rejectionHistory',$user_id));
    }

}
