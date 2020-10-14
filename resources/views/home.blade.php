@extends('layouts.master')
​
@section('title')
    <title>Dashboard</title>
@endsection
​
@section('content')
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left" style="margin-right: 5px">
                            <h2 class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></h2>
                        </ol>
                        <ol class="breadcrumb float-sm-left">
                            <h2 class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Transaksi</a></h2>
                        </ol>
                    </div>
                    
​
        <!-- Main content -->
    </div>
@endsection
