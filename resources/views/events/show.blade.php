@extends('layouts.main')

@section('title',$event->title)
@section('content')

<section class="single-events container spacing">
        <img src="/img/events/{{ $event->image }}" alt="">
        <div class="conteudo-event">
                <h2>{{ $event->title }}</h2>
                <p>Local: {{ $event->city }}</p>
                <p>Participantes: {{ count($event->users) }}</p>
                <p>Criador: {{$eventOwner['name']}} </p>
                @if(!$hasUserJoined)
                        <form action="/events/join/{{ $event->id }}" method="POST">
                                @csrf
                                <a href="/events/join/{{ $event->id }}" class="btn btn-primary" id="event-submit" onclick="event.preventDefault(); this.closest('form').submit();">Confirmar presença</a>
                        </form>
                @else
                        <p>Você já está participando deste evento</p>
                @endif
        </div>
        <div class="description">
                <h4>Sobre o evento:</h3>
                <p>{{ $event->description }}</p>
        </div>
</section>

@endsection