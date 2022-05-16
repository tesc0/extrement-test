@extends('layout.layout')
@section('content')
<main>
    <h2 class="text-xl font-bold text-center">Összes vakcina</h2>
    <div class="navigation fixed bottom-16 left-16"> 
        <a href="/admin/vaccine" class="">Új vakcina</a>
        <br>
        <a href="/admin/landing" class="">Nyitó oldal</a>
    </div>
    <div class="w-full">
        <table class="w-4/5 m-auto">
            <tr>
                <th>Típus</th>
                <th>Azonosító</th>
                <th>Érkezés</th>
                <th>Mennyiség</th>
                <th>Rögzítő</th>
                <th>Rögzítve</th>
            </tr>
            @foreach ($vaccines as $vaccine)
            <tr>
                <td class="text-center">{{ $vaccine->type }}</td>
                <td class="text-center">{{ $vaccine->sku }}</td>
                <td class="text-right">{{ $vaccine->arrival }}</td>
                <td class="text-right">{{ $vaccine->amount }} db</td>
                <td class="text-center">{{ $vaccine->name }}</td>
                <td class="text-right">{{ $vaccine->created_at }}</td>
            </tr>
            @endforeach
        </table>
    
    </div>
</main>
@stop