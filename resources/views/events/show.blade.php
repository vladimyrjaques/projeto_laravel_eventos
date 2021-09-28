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
                <div class="share-icons">
                        <p>Convide um amigo <i class="fas fa-share"></i></p>
                        <a target="_blank" id="fa-whatsapp-square" href=""><i class="fab fa-whatsapp-square"></i></a>
                        <a target="_blank" id="fa-facebook-square" href=""><i class="fab fa-facebook-square"></i></a>
                        <a target="_blank" id="fa-twitter-square" href=""><i class="fab fa-twitter-square"></i></a>
                        <a target="_blank" id="fa-linkedin" href=""><i class="fab fa-linkedin"></i></a>
                        <a target="_blank" id="fa-envelope-square" href=""><i class="fas fa-envelope-square"></i></a>
                </div>
        </div>
        <div class="description">
                <h4>Sobre o evento:</h3>
                <p>{{ $event->description }}</p>
        </div>
</section>
<script>initSupportSocialShare()</script>
@endsection