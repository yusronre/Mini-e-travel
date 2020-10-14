
<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Pembookingan Perjalanan</h4>
		<h6>Traveling</a></h5>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>#</th>
                <th>Destinasi</th>
                <th>Hari</th>
                <th>Jumlah Orang</th>
                <th>Kategori Hotel</th>
                <th>Jumlah Ruangan</th>
                <th>Total</th>
                <th>NIK</th>
                <th>Last Updated</th>
			</tr>
		</thead>
		<tbody>
			@php $no=1 @endphp
			@foreach($transactions as $row)
			<tr>
				<td>{{ $no++ }}</td>
				<td>
            	<strong>{{ ucfirst($row->destinasi) }}</strong>
        		</td>
				<td>{{ $row->hari }}</td>
       			<td>{{ $row->orang }}</td>
	        	<td>{{ $row->hotel }}</td>
        		<td>{{ $row->jumlah_ruangan }}</td>
        		<td>Rp. {{ number_format($row->total) }}</td>
        		<td>00{{ $row->nik }}</td>
		        <td>{{ $row->updated_at }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>