<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data_penulis = Buku::select('penulis')->distinct()->get();
        $query = Buku::query();

        if ($request->has('search') && $request->search != '') {
            $query = $query->where('judul','LIKE','%'.$request->search.'%');
        }

        if ($request->has('penulis') && $request->penulis != '') {
            $query = $query->where('penulis', $request->penulis);
        }

        $data_buku = $query->get();

        $lima_buku = Buku::all()->sortByDesc('id')->take(5);
        

        $total_buku = Buku::count();
        $total_harga_semua_buku = Buku::sum('harga');
        $harga_terendah = Buku::min('harga');
        $harga_tertinggi = Buku::max('harga');

        return view("buku.index", compact(
            'data_buku', 
            'lima_buku', 
            'data_penulis', 'total_buku', 
            'total_harga_semua_buku', 
            'harga_terendah', 
            'harga_tertinggi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        return redirect('/buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', ['buku' => $buku]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::findOrFail($id);

        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        return redirect('/buku')->with('success', 'Data buku berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku');
    }
}
