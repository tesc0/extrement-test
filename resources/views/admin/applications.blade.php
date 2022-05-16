@extends('layout.layout')
@section('content')
<main>    
    <div class="navigation fixed bottom-16 left-16"> 
        <a href="/admin/landing" class="">Nyitó oldal</a>
    </div>

    <h2 class="text-xl font-bold text-center">Oltásra jelentkezettek</h2>
    <div class="w-full mt-6">
        <table class="w-4/5 m-auto">
            <tr>
                <th>Név</th>
                <th>Email</th>
                <th>Választott vakcina</th>
                <th>Jelentkezés ideje</th>
            </tr>
            @foreach ($applications as $application)
            <tr>
                <td class="text-center">{{ $application->name }}</td>
                <td class="text-center">{{ $application->email }}</td>
                <td class="text-right">{{ $application->type }}</td>
                <td class="text-right">{{ $application->created_at }}</td>
            </tr>
            @endforeach
        </table>
    
    </div>
</main>


@stop