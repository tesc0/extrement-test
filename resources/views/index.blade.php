@extends('layout.layout')
@section('content')
    <main>        
    <h2 class="text-xl font-bold text-center">Elérhető vakcinák</h2>
    <div class="flex justify-around">
    @if ($vaccines->isNotEmpty())
        @foreach ($vaccines as $vaccine)
            <div class="p-3 m-4 text-center">
                <span class="">{{ $vaccine->type }}</span>
                <br>
                <span class="">{{ $vaccine->amount }} db</span>
            </div>
        @endforeach
    @else
        <p class="block m-6">Nincs elérhető vakcina még</p>
    @endif
    </div>

    </main>
    <section class="text-center">
        <div>
            <a href="/registration" class="rounded border-2 border-blue-400 hover:bg-blue-400 hover:text-white px-3 py-1">Jelentkezés oltásra</a>
        </div>
    </section>
@stop