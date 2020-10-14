@extends('layouts.master')
​
@section('title')
    <title>Manajemen Destinasi</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Riwayat Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('transaksi.index')}}">Transaksi</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                            @slot('title')
                            <a href="{{ route('transaksi.index') }}" 
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Tambah
                            </a>
                            <a href="{{ route('riwayat.show') }}" 
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Cetak
                            </a>
                            @endslot
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Destinasi</th>
                                            <th>Hari</th>
                                            <th>Jumlah Orang</th>
                                            <th>Kategori Hotel</th>
                                            <th>Jumlah Ruangan</th>
                                            <th>Total</th>
                                            <th>Check-In</th>
                                            <th>NIK</th>
                                            <th>Last Updated</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    @php $no = 1; @endphp
    @forelse ($transactions as $row)
    <tr>
        <td>{{ $no++ }}</td>
        <td>
            <strong>{{ $tujuan->where('id', $row->id_destinasi)->first()->destination }}</strong>
        </td>
        <td>{{ $row->hari }}</td>
        <td>{{ $row->orang }}</td>
        <td>{{ $hotel->where('id', $row->id_hotel)->first()->category }}</td>
        <td>{{ $row->jumlah_ruangan }}</td>
        <td>Rp. {{ number_format($row->total) }}</td>
        <td>{{ $row->check_in }}</td>
        <td>00{{ $row->nik }}</td>
        <td>{{ $row->updated_at }}</td>
        <td>
            <form action="{{ route('riwayat.destroy', $row->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7" class="text-center">Tidak ada data</td>
    </tr>
    @endforelse
</tbody>
                                </table>
                            </div>
                            @slot('footer')
​
                            @endslot
                        @endcard
                    </div>
                    <div class="float-right">
                    {!! $transactions->links() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection