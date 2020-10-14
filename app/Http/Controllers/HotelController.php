<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;

class HotelController extends Controller
{
    //
    public function index()
    {
        $hotels = Hotel::orderBy('created_at', 'DESC')->paginate(10);
        return view('hotels.index', compact('hotels'));
    }

    public function harga($id){
        return Hotel::findOrFail($id);
    }


    public function store(Request $request)
    {
    	$this->validate($request, [
        'category' => 'required|string|max:50',
        'price' => 'required|integer'
    ]);
        $hotels = Hotel::firstOrCreate([
            'category' => $request->category,
            'price' => $request->price
        ]);
        return redirect()->back()->with(['success' => 'Hotel: ' . $hotels->hotel . ' Ditambahkan']);
    }


    public function destroy($id)
    {
    	$hotels = Hotel::findOrFail($id);
    	$hotels->delete();
    	return redirect()->back()->with(['success' => 'Hotel: ' . $hotels->hotel . ' Telah Dihapus']);
    }


    public function edit($id)
    {
    	$hotels = Hotel::findOrFail($id);
    	return view('hotels.edit', compact('hotels'));
    }

    public function cari(Request $request)
    {
        $cari = $request->cari;
        $hotels = Hotel::where('hotel','like',"%".$cari."%")->paginate(10);
        return view('hotels.index', compact('hotels'));
    }


    public function update(Request $request, $id)
    {
    	$this->validate($request, [
        'category' => 'required|string|max:50',
        'price' => 'nullable|string'
    ]);
        //select data berdasarkan id
        $hotels = Hotel::findOrFail($id);
        //update data
        $hotels->update([
            'category' => $request->category,
            'price' => $request->price
        ]);
        
        //redirect ke route hotel.index
        return redirect(route('hotel.index'))->with(['success' => 'Hotel: ' . $hotels->hotel . ' Diupdate']);
        //jika gagal, redirect ke form yang sama lalu membuat flash message error
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
}
