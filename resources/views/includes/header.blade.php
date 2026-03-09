<div class="flex justify-between">
    <a href="{{route('agendas.index')}}">Повестки</a>

    @auth
        <div class="flex">
            <p>{{auth()->user()->name}}</p>
        </div>
    @endauth
</div>
