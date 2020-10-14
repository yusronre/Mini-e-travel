<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Hotel;
use App\Destination;
use PDF;

class RiwayatController extends Controller
{
    //
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'DESC')->paginate(10);
        $hotel = Hotel::all();
        $tujuan = Destination::all();
        return view('riwayat.index', compact('transactions','tujuan','hotel'));
    }

    public function show()
    {
        $transactions = Transaction::all();
        $pdf = PDF::loadview('riwayat/riwayat_pdf',['transactions'=>$transactions]);
        return $pdf->download('laporan-transaksi.pdf');
    }

    public function destroy($id)
    {
    	$transactions = Transaction::findOrFail($id);
    	$transactions->delete();
    	return redirect()->back()->with(['success' => 'Transaksi: ' . $transactions->nik . ' Telah Dihapus']);
    }

}
