@extends('layouts.master')
​
@section('title')
    <title>Edit Hotel</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Hotel</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('hotel.index') }}">Hotel</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        @card
                            @slot('title')
                            Edit
                            @endslot
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
​
                            <form role="form" action="{{ route('hotel.update', $hotels->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="hotel">Hotel</label>
                                    <input type="text" 
                                        name="hotel"
                                        value="{{ $hotels->hotel }}"
                                        class="form-control {{ $errors->has('hotel') ? 'is-invalid':'' }}" id="hotel" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" name="price" id="price" value="{{ $hotels->price }}" class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}"></input>
                                </div>
                            @slot('footer')
                                <div class="card-footer">
                                    <button class="btn btn-info">Update</button>
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