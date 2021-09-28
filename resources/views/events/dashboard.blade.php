@extends('layouts.main')

@section('title','Meus eventos')
@section('content')

<section class="page-meus-eventos container spacing">
    <h1>Meus eventos</h1>
    @if(count($events) == 0)
        <div class="text-center">
            <p class="text-center">Você não possui nenhum evento</p>
            <a href="/events/create" class="m-auto btn btn-primary">Criar evento</a>
        </div>
    @endif
    <div class="eventos">
        @foreach($events as $event)
            <div class="card">
                <img src="/img/events/{{$event->image}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                    <a href="/events/{{ $event->id }}" class="card-link">
                        <h3 class="card-title">{{$event->title}}</h3>
                    </a>
                    <p class="card-participants">{{count($event->users)}} Participantes</p>
                    <div class="acoes">
                        <form action="/events/{{ $event->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><i class="fas fa-trash-alt"></i>Deletar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <h1 class="mt-5">Eventos que estou participando</h1>
    @if(count($eventsAsParticipant) == 0)
        <div class="text-center">
            <p class="text-center">Você não está participando de nenhum evento</p>
            <a href="/" class="m-auto btn btn-primary">Eventos</a>
        </div>
    @endif
    <div class="eventos">
        @foreach($eventsAsParticipant as $event)
            <div class="card">
                <img src="/img/events/{{$event->image}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                    <a href="/events/{{ $event->id }}" class="card-link" >
                        <h3 class="card-title">{{$event->title}}</h3>
                    </a>
                    <p class="card-participants">{{count($event->users)}} Participantes</p>
                    <div class="acoes">
                        <form action="/events/leave/{{ $event->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><i class="fas fa-trash-alt"></i>Sair do evento</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</section>

@endsection