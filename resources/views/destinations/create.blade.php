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
                        <h1 class="m-0 text-dark">Tambah Destinasi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('destinasi.index') }}">Destinasi</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
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
                            <form action="{{ route('destinasi.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="destination">Destinasi</label>
                                    <input type="text"
                                    name="destination"
                                    class="form-control {{ $errors->has('destination') ? 'is-invalid':'' }}" id="destination" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga/Malam</label>
                                    <input type="number" name="price" id="price" class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}" required=""></input>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" id="photo" class="form-control">
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                </div>
                            @slot('footer')
                                <div class="card-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection