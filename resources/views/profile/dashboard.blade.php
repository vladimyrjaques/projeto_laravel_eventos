@extends('layouts.main')

@section('title','Meus eventos')
@section('content')

<section class="page-meus-eventos">
    <h1>Meus eventos</h1>
    @if(count($events) ==0 && $search)
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
                    <h3 class="card-title">{{$event->title}}</h3>
                    <p class="card-text">{{$event->description}}</p>
                    <a href="/events/{{ $event->id }}" class="btn btn-primary">Saiba mais</a>
                </div>
            </div>
        @endforeach
    </div>
</section>