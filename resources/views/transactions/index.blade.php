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
                            <form role="form" action="{{ route('transaksi.store') }}" method="POST">
                                @csrf
                                <input style="width: 24%;" type="number" name="nik" id="nik" class="form-control" placeholder="NIK" required>
                                <br>
                                <table class="table table-bordered table-hover table-striped">
                            <tr>
                                <td>Tujuan</td>
                                <td><select name="destinasi" id="destinasi" class="form-control">
                                    <option value="">Pilih</option>
                                        @foreach ($destinations as $row)
                                            <option value="{{ $row->id }}">{{ $row->destination }}</option>
                                        @endforeach    
                                        </td>
                                <td><input type="number" name="harga" class="form-control" readonly id="harga" placeholder="<--"></td>
                            </tr>
                            <tr>
                                <td>Lama Hari</td>
                                <td><input type="text" name="hari" id="hari" class="form-control" placeholder="Hari.." required></td>
                                <td><input type="hidden" name="total1" id="total" class="form-control" readonly placeholder="<--" required></td>
                            </tr>
                            <tr>
                                
                            </tr>
                            <tr>
                                <td>Jumlah Orang</td>
                                <td><input type="number" name="orang" id="orang" class="form-control" placeholder="Jumlah.." required></td>
                                <td><input type="hidden" name="total2" id="total2" class="form-control" readonly placeholder="<--" required></td>
                            </tr>
   
                            <tr>
                                <td>Kategori Hotel</td>
                                <td><select name="hotel" id="hotel" class="form-control">
                                    <option value="">Pilih</option>
                                        @foreach ($hotels as $row)
                                            <option value="{{ $row->id }}">{{ $row->category }}</option>
                                        @endforeach    </select></td>
                                <td><input type="number" name="harga2" id="harga2" class="form-control" readonly placeholder="<--"></td>
                            </tr>
                             <tr>
                                <td>Jumlah Ruangan</td>
                                <td><input type="number" name="ruangan" id="ruangan" class="form-control" placeholder="Ruangan.." required></td>
                                <td><input type="hidden" name="total3" id="total3" class="form-control" readonly placeholder="<--" ></td>
                            </tr>
                            <tr>
                                <td>Check-In</td>
                                <td><input type="date" name="tanggal" class="form-control" placeholder="Check-in"></td>
                                <td><input type="number" name="total" id="totalall" class="form-control" readonly placeholder="Total"></td>
                            </tr>
                        </table>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm-right">
                                        <i class="fa fa-send"></i> Lanjut
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
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).on('change', '#destinasi',() => {
            var id = $('#destinasi').val();
            $.ajax({
                dataType : 'json',
                type : 'get',
                url : 'destinasi/' + id+ '/harga',
                data : '',
                success:function(data){
                    $('#harga').val(data.price);
                }
            })
        });
        

        $(document).on('change', '#hotel',() => {
            var id = $('#hotel').val();
            $.ajax({
                dataType : 'json',
                type : 'get',
                url : 'hotel/' + id+ '/harga',
                data : '',
                success:function(data){
                    $('#harga2').val(data.price);
                }
            })
        });

        $(document).on('keyup', '#hari',() => {
            var a = $('#harga').val();
            var b = $('#hari').val()
            var hasil = a*b;
            $('#total').val(hasil);
        });

        $(document).on('keyup', '#orang',() => {
            var a = $('#orang').val()
            var b = $('#total').val()
            var hasil = a*b;
            $('#total2').val(hasil);
        });

        $(document).on('keyup', '#ruangan',() => {
            var a = $('#harga2').val()
            var b = $('#ruangan').val()
            var hasil = a*b;
            $('#total3').val(hasil);
        });

        $(document).on('keyup', '#ruangan',() => {
            var a = $('#total2').val()
            var b = $('#total3').val()
            var hasil = parseInt(a) + parseInt(b);
            $('#totalall').val(hasil);
        });
    </script>
@endsection
