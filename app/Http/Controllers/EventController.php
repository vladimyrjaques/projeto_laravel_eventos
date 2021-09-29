<?php

namespace App\Http\Controllers;

use App\Mail\sendMail;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;
// use SendGrid\Mail\Mail;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    public function index() {
        $search = request('search');
        if($search) {
            $events = Event::where([
                ['title','like','%'.$search.'%']
            ])->get();
        }
        else {
            $events = Event::all();
        }

        return view('home',['events' => $events, 'search' => $search]);
        // return view('eventos',['events' => $events]);
    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;

        //Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." .$extension;
            $request->image->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();
        
        return redirect('/')->with('msg','Evento criado com sucesso!');
    }

    public function show($id) {
        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {
            $userEvents = $user->EventsAsParticipant->toArray();

            foreach($userEvents as $userEvent) {
                if($userEvent['id'] == $id) {
                    $hasUserJoined = true;
                } 
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard() {
        $user = auth()->user();
        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard',['events' => $events,'eventsAsParticipant' => $eventsAsParticipant ]);
    }

    public function destroy($id) {
        $event = Event::findOrFail($id);
        foreach($event->users as $user){
            $user->eventsAsParticipant()->detach($id);
        }
        Event::findOrFail($id)->delete();
        Mail::to('vjeventos@vjeventos')->send(new sendMail($event));

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso');
    }

    public function joinEvent($id) {
        $user = auth()->user();
        $user->eventsAsParticipant()->attach($id);
        $event = Event::findOrFail($id);
    
        
        return redirect('/dashboard')->with('msg','Presença confirmada no evento '.$event->title );
    }
    
    public function leaveEvent($id) {
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);
        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg','Desistência confirmada no evento '.$event->title );
    }

    // public function sendEmail() {
    //     $user = auth()->user();
    //     Mail::to('vjeventos@vjeventos')->send(new sendMail());
    //     return new sendMail();
    // }
}
