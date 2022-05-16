@extends('layout.layout')
@section('content')
    <h2 class="text-xl font-bold text-center">Vakcina adatai</h2>

    <div class="navigation fixed bottom-16 left-16"> 
        <a href="/admin/vaccines" class="">Vakcinák</a>
        <br>
        <a href="/admin/landing" class="">Nyitó oldal</a>
    </div>
    <form class="w-1/2 m-auto" method="post" action="/admin/vaccine">
        <div class="my-3">
            <label class="w-32 inline-block">Típus: </label>          
            <select name="vaccine[type_id]" class="rounded p-1">
                <option value="" disabled selected>Válassz..</option>
                @foreach ($vaccines as $vaccine) 
                <option value="{{ $vaccine->id }}">{{ $vaccine->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="my-3">
            <label class="w-32 inline-block">SKU: </label>
            <input type="text" name="vaccine[sku]" class="rounded border border-gray-400">
        </div>
        <div class="my-3">
            <label class="w-32 inline-block">Érkezés: </label>
            <input type="date" name="vaccine[arrival]" class="rounded border border-gray-400">
        </div>
        <div class="my-3">
            <label class="w-32 inline-block">Mennyiség: </label>
            <input type="number" name="vaccine[amount]" min="1" step="1" class="rounded border border-gray-400">
        </div>
        <div class="my-3 text-center">
            @isset ($id)
                <input type="hidden" name="vaccine[id]" value="{{ $id }}">
            @endisset
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="rounded border-2 border-green-400 hover:bg-green-400 hover:text-white px-3 py-1">Rögzítés</button>
        </div>
    </form>
@stop
