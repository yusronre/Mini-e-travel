@extends('layouts.master')
​
@section('title')
    <title>Tambah Destinasi</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
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
                            
                            @endslot
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            <form action="{{ route('transaksi.store', '$destinations->id') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <table class="table table-bordered table-hover table-striped">
                            <tr>
                                <td></td>
                                <td><input type="text" name="destination" value="{{ $destinations->destination }}" class="form-control {{ $errors->has('destination') ? 'is-invalid':'' }}" id="destination" required>></td>
                                    <td><input type="number" name="harga" disabled></td>
                            </tr>
                            <tr>
                                <td>Lama Hari</td>
                                <td><input type="number" name="hari" class="form-control" placeholder="Hari.." required onchange="return hit();"></td>
                                <td><input type="number" name="harga1" disabled></td>
                            </tr>
                            <tr>
                                <td>Jumlah Orang</td>
                                <td><input type="number" name="orang" class="form-control" placeholder="Jumlah.." required onchange="return hit();"></td>
                                <td><input type="number" name="harga2" disabled></td>
                            </tr>
                            <tr>
                                <td>Kategori Hotel</td>
                                <td><select name="kategori" class="form-control"><option value="" selected disabled>
                                    Hotel</option></select></td>
                                <td><input type="number" name="harga3" disabled></td>
                            </tr>
                            <tr>
                                <td>Jumlah Ruangan</td>
                                <td><input type="number" name="ruangan" class="form-control" placeholder="Ruangan.." required onchange="return hit();"></td>
                                <td><input type="number" name="harga4" disabled></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td><input type="number" name="total" disabled></td>
                            </tr>
                        </table>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-send"></i> Simpan
                                    </button>
                                </div>
                            </form>
                            @slot('footer')
​
                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
