@extends('layouts.public')

@section('title', 'Daftar Event')

@section('content')
<div class="card card-body mx-3 mx-md-4 rounded-4 shadow-blur bg-white-blur position-relative">
    <div class="container mb-auto mx-auto mt-8" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-12 my-auto text-center">
                <h1 class="text-gradient text-dark">Daftar Event</h1>
                <hr class="shadow border-2 border-blue-700 mx-auto" width="50%">
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr class="bg-gradient-warning">
                    <th class="text-white">Nama Event</th>
                    <th class="text-white">Tanggal/Jam</th>
                    <th class="text-white">Lokasi</th>
                    <th class="text-white">Ketentuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>
                            <strong>{{ $event->nama }}</strong><br>
                            <small class="text-muted">{{ $event->deskripsi }}</small>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($event->tanggal_event)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($event->tanggal_event)->translatedFormat('H:i') }} WIT</td>
                        <td>
                            {{ $event->lokasi }}
                        </td>
                        <td>
                            {!! nl2br(e($event->ketentuan)) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
