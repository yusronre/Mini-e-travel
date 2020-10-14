@extends('layouts.master')
​
@section('title')
    <title>Manajemen Hotel</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Hotel</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('hotel.index') }}">Hotel</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        @card
                            @slot('title')
                            Tambah
                            @endslot
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
​
                            <form role="form" action="{{ route('hotel.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="category">Hotel</label>
                                    <input type="text" 
                                    name="category"
                                    class="form-control {{ $errors->has('category') ? 'is-invalid':'' }}" id="category" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" name="price" id="price" class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}"></input>
                                </div>
                            @slot('footer')
                                <div class="card-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            @endslot
                        @endcard
                    </div>
                    <div class="col-md-8">
                        @card
                            @slot('title')
                            Kategori Hotel
                            @endslot
                            <form action="{{ route('hotel.cari') }}" method="GET" class="form-inline">
                                <input class="form-control" type="text" name="cari" placeholder="Cari hotel...." value="{{ old('cari') }}">
                                <input class="btn btn-primary ml-3" type="submit" value="CARI">
                            </form>
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Hotel</td>
                                            <td>Harga</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @forelse ($hotels as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->category }}</td>
                                            <td>Rp {{ number_format($row->price) }}</td>
                                            <td>
                                                <form action="{{ route('hotel.destroy', $row->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="{{ route('hotel.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
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
                </div>
            </div>
        </section>
    </div>
@endsection