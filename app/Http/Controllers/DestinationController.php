<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Destination;
use File;
use Image;

class DestinationController extends Controller
{
    //
    public function index()
    {
    $destinations = Destination::orderBy('created_at', 'DESC')->paginate(10);
    return view('destinations.index', compact('destinations'));
    }


    public function create()
	{
    $destinations = Destination::orderBy('destination', 'ASC')->get();
    return view('destinations.create', compact('destinations'));
	}
    public function harga($id){
        return Destination::findOrFail($id);
    }


	public function store(Request $request)
	{
		$this->validate($request, [
        'destination' => 'required|string|max:35|unique:destinations',
        'price' => 'required|integer|',
        'photo' => 'nullable|image|mimes:jpg,png,jpeg'
    ]);

	try {
    	$photo = null;
    	if ($request->hasFile('photo')) {
    		$photo = $this->saveFile($request->destination, $request->file('photo'));
    	}

    $destinations = Destination::create([
    		'destination' => $request->destination,
            'price' => $request->price,
            'photo' => $photo
        ]);

    return redirect(route('destinasi.index'))
    	->with(['success' => '<strong>' . $destinations->destination . '</strong> Ditambahkan']);
    } catch (\Exception $e) {
    	return redirect()->back()->with(['error' => $e-getMessage()]);
    }
    }


    private function saveFile($destination, $photo)
    {
    	$images = str_slug($destination) . time() . '.' . $photo->getClientOriginalExtension();
    //set path untuk menyimpan gambar
    $path = public_path('uploads/destination');

    if (!File::isDirectory($path)){
    	File::makeDirectory($path, 0777, true, true);
    }

    Image::make($photo)->save($path . '/' . $images);
    return $images;
    }

    public function show(Request $request)
    {
        $cari = $request->cari;
        $destinations = Destination::where('destination','like',"%".$cari."%")->paginate(10);
        return view('destinations.index', compact('destinations'));
    }


    public function destroy($id)
	{
    $destinations = Destination::findOrFail($id);
    if (!empty($destinations->photo)) {
        //file akan dihapus dari folder uploads/produk
        File::delete(public_path('uploads/destination/' . $destinations->photo));
    }
    //hapus data dari table
    $destinations->delete();
    return redirect()->back()->with(['success' => '<strong>' . $destinations->name . '</strong> Telah Dihapus!']);
	}


	public function edit($id)
	{
    //query select berdasarkan id
    $destinations = Destination::findOrFail($id);
    $destinations = Destination::orderBy('destination', 'ASC')->first();
    return view('destinations.edit', compact('destinations'));
	}

	public function update(Request $request, $id)
    {
    	 $this->validate($request, [
        'destination' => 'required|string|max:10|exists:destinations',
        'price' => 'required|integer',
        'photo' => 'nullable|image|mimes:jpg,png,jpeg'
    ]);

    	 try {
    	 	$destinations = Destination::findOrFail($id);
    	 	$photo = $destinations->photo;

    	 	if ($request->hasFile('photo')) {
    	 		!empty($photo) ? File::delete(public_path('uploads/destination/' . $photo)):null;
    	 		$photo = $this ->saveFile($request->destination, $request->file('photo'));
    	 	}

    	 	$destinations->update([
            'destination' => $request->destination,
            'price' => $request->price,
            'photo' => $photo
        ]);

    	 	return redirect(route('destinasi.index'))
    	 		->with(['success' => '<strong>' . $destinations->destinasi . '</strong> Diperbarui']);
    	 } catch (\Exception $e) {
    	 	return redirect()->back()
    	 		->with(['error' => $e->getMessage()]);
    	 }
	}
}
