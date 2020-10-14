<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use App\Transaction;
use App\Hotel;
use App\Destination;

class TransactionController extends Controller
{
    //
    public function index(){
    	$destinations = Destination::orderBy('price', 'ASC')->get();
    	$hotels = Hotel::orderBy('price', 'ASC')->get();
    	return view('transactions.index', compact('destinations', 'hotels'));

    }

     public function store(Request $request)
    {
        $this->validate($request, [
        'nik' => 'required|integer|min:8'
    ]);
    	$transactions = Transaction::firstOrCreate([
            'id_destinasi' => $request->destinasi,
            'hari' => $request->hari,
            'orang' => $request->orang,
            'id_hotel' => $request->hotel,
            'jumlah_ruangan' => $request->ruangan,
            'total' => $request->total,
            'check_in' => $request->tanggal,
            'nik' => $request->nik
        ]);
        return redirect()->back()->with(['success' => 'Transaction: ' . $transactions->nik . ' Ditambahkan']);
    }

    
}
