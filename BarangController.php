<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Http\Requests\StorebarangRequest;
use App\Http\Requests\UpdatebarangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // mengambil data dari table barang
        $barang = DB::table('barang')->get();
        $user = Auth::user();
        // mengirim data barang ke view index
        return view('layout.data')->with([
        'barang' => $barang,
        'user' => $user,
    ]);
        // return view('layout.data')->with([
        //     'barang' => Barang::all(),
        //     'user' => Auth::user(),

        // ]);
        // return view('layout.data')->with([
        //     'user' => Auth::user(),
        // ]);

    }

    public function add(Request $request)
    {
        return view('layout.tambah')->with([

            'user' => Auth::user(),

        ]);


    }

    public function tambah()
{

    return view('layout.tambah')->with([

        'user' => Auth::user(),

    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'idbarang'     => 'required',
            'namabarang'     => 'required',
            'jumlahbarang'   => 'required'
        ]);
        DB::table('barang')->insert([
            'idbarang' => $request->idbarang,
            'namabarang' => $request->namabarang,
            'jumlahbarang' => $request->jumlahbarang,
            ]);

        //redirect to index
        return redirect('/barang')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebarangRequest $request, barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(barang $barang)
    {
        //
    }
}
