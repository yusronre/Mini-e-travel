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
                        <h1 class="m-0 text-dark">Manajemen Destinasi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Destinasi</li>
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
                            <table>
                                <tr>
                                    <td>
                            <a href="{{ route('destinasi.create') }}" 
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Tambah
                                </a>
                                </td>
                                <td><form action="{{ route('destinasi.cari') }}" method="GET" class="form-inline">
                                <input class="form-control ml-5" type="text" name="cari" placeholder="Cari hotel...." value="{{ old('cari') }}">
                                <input class="btn btn-primary ml-3" type="submit" value="CARI">
                            </form></td>
                            </tr>
                            </table>

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
                                            <th>Harga/Malam</th>
                                            <th>Last Updated</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    @forelse ($destinations as $row)
    <tr>
        <td>
            @if (!empty($row->photo))
                <img src="{{ asset('uploads/destination/' . $row->photo) }}" 
                    alt="{{ $row->destination }}" width="50px" height="50px">
            @else
                <img src="http://via.placeholder.com/50x50" alt="{{ $row->destination }}">
            @endif
        </td>
        <td>
            <strong>{{ ucfirst($row->destination) }}</strong>
        </td>
        <td>Rp {{ number_format($row->price) }}</td>
        <td>{{ $row->updated_at }}</td>
        <td>
            <form action="{{ route('destinasi.destroy', $row->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <a href="{{ route('destinasi.edit', $row->id) }}" 
                    class="btn btn-warning btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
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
                    {!! $destinations->links() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection