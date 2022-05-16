@extends('layout.layout')
@section('content')
<main>
    <div class="flex justify-around">
        <div>
            <a href="/admin/vaccines" class="hover:underline hover:text-blue-500">Vakcinák</a>
        </div>
        <div>
            <a href="/admin/applications" class="hover:underline hover:text-blue-500">Oltásra jelentkezők</a>
        </div>
    </div>
</main>
@stop