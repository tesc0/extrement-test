@extends('layout.layout')
@section('content')
    <h2 class="text-xl font-bold text-center">Bejelentkezés</h2>
    <form class="w-1/2 m-auto" method="post" action="/admin">
        <div class="my-3">
            <label class="w-14 inline-block">Email: </label>
            <input type="text" name="email" class="rounded border border-gray-400">            
        </div>
        <div class="my-3">
            <label class="w-14 inline-block">Jelszó: </label>
            <input type="password" name="password" class="rounded border border-gray-400">
        </div>
        <div class="my-3 text-center">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="rounded border-2 border-green-400 hover:bg-green-400 hover:text-white px-3 py-1">Bejelentkezés</button>
        </div>
    </form>
@stop
