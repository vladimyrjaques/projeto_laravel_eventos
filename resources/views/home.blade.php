@extends('layouts.main')
<style>
header {
    position: absolute !important;
    background-color: #ffffff33 !important;
}

header a.area-logo img{
    display: none;
}
</style>
@section('title','Eventos')
@section('content')
    <section class="page-principal">
        <div class="area-logo">
            <img src="/img/vjeventos.png" alt="">
        </div>
        <div class="area-pesquisa">
            <div>
                <h2>Busque eventos</h2>
                <form action="/" method="GET">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Buscar eventos... ">
                </form>
            </div>
        </div>
    </section>
    <section class="prox-events container spacing">
        @if($search)
            <h2>Resultado da busca por: {{ $search }}</h2>
        @else
            <h2>Próximos Eventos</h2>
        @endif
        @if(count($events) ==0 && $search)
        <div class="text-center">
            <p class="text-center">Não há nenhum evento com {{ $search }}</p>
            <a href="/" class="m-auto btn btn-primary">Ver todos eventos</a>
        </div>
        @elseif(count($events) == 0)
            <p class="text-center">Não há eventos disponíveis</p>
        @endif
        <div class="eventos">
            @foreach($events as $event)
                <div class="card">
                    <img src="/img/events/{{$event->image}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                        <h3 class="card-title">{{$event->title}}</h3>
                        <p class="card-participants">{{count($event->users)}} participantes</p>
                        <a href="/events/{{ $event->id }}" class="btn btn-primary">Saiba mais</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection