@extends('layout.layout')
@section('content')
<main class="w-full">
    
    <h2 class="text-xl font-bold text-center">Jelentkezés oltásra</h2>

    <form method="post" action="/registration" class="w-1/2 m-auto flex flex-col content-center">
    <div class="w-1/2 my-3 m-auto">
            <label class="w-52 inline-block">Név: </label>
            <input type="text" name="application[name]" class="rounded border border-gray-400">            
        </div>
        <div class="w-1/2 my-3 m-auto">
            <label class="w-52 inline-block">Email: </label>
            <input type="email" name="application[email]" class="rounded border border-gray-400">            
        </div>
        <div class="w-1/2 my-3 m-auto">
            <label class="w-52 inline-block">Választott vakcina: </label>
            <select name="application[vaccine_type_id]" class="p-1 rounded">
                @foreach ($vaccines as $vaccine)
                <option value="{{ $vaccine->id }}">{{ $vaccine->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-1/2 my-3 m-auto text-center">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="rounded border-2 border-green-400 hover:bg-green-400 hover:text-white px-3 py-1">Jelentkezés</button>
        </div>
    </form>
</main>
@stop