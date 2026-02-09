@extends('layouts.public')

@section('title', 'Member PRMI Regional Ambon')

@section('content')
<div class="card card-body mx-3 mx-md-4 rounded-4 shadow-blur bg-white-blur position-relative">
    <div class="container mb-auto mx-auto mt-8" data-aos="fade-up">
        <div class="row">
            <div class="col-12 mx-auto text-center">
                <h1>Daftar Member PRMI</h1>
                <p class="text-muted">Daftar Member terdaftar dalam situs : <a href="https://membership.madridambon.my.id" target="_blank" class="text-decoration-none text-primary">membership.madridambon.my.id</a></p>
                <hr class="shadow border-2 mx-auto" width="50%">
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive mx-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">#</th>
                            <th width="25">Nama Lengkap</th>
                            <th width="10%">Kode Member</th>
                            <th width="20%">Alamat</th>
                            <th width="10%">Tipe Member</th>
                            <th width="10%">Tanggal Expired</th>
                            <th width="5%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach($members as $member)
                            @php
                                // Menghitung selisih hari antara tanggal expired dan tanggal sekarang
                                $expiryDate = strtotime($member['membership']['expiry_date']);
                                $currentDate = time();
                                $daysDifference = floor(($expiryDate - $currentDate) / (60 * 60 * 24));

                                // Tentukan status membership berdasarkan perbedaan hari
                                $membershipStatus = ($daysDifference < 0) ? 'Expired' : 'Aktif';
                                $badge = "danger";

                                // Mengubah badge jika status aktif
                                if($membershipStatus == 'Aktif'){
                                    $badge = 'success';
                                }
                            @endphp
                            <tr>
                                <td>{{ $no }}</td>
                                <td>
                                    <img src="https://membership.madridambon.my.id/uploads/member_photos/{{ $member['photo'] }}" class="img-thumbnail rounded shadow-sm" width="100px" />
                                </td>
                                <td>
                                    {{ $member['fullname'] }}
                                </td>
                                <td>
                                    {{ $member['membership']['membership_number'] }}
                                </td>
                                <td class="text-wrap">
                                    {{ $member['address'] }}
                                </td>
                                <td>
                                    {{ $member['membership']['membership_type']['type'] }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($member['membership']['expiry_date'])->translatedFormat('d F Y') }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $badge }}">{{ $membershipStatus }}</span>
                                </td>
                            </tr>
                            @php $no++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
