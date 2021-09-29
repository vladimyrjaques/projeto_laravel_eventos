@component('mail::message')
Evento cancelado

O evento "{{ $event->title }}", foi cancelado pelo criador.

@component('mail::button', ['url' => ''])
Confira novos eventos
@endcomponent

Obrigado,<br>
VJ-Eventos
@endcomponent