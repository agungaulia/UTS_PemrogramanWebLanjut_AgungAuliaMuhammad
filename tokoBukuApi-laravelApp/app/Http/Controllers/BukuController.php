<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        return response()->json(Buku::all());
    }

    public function store(Request $request)
    {
        $buku = Buku::create($request->all());
        return response()->json($buku);
    }

    public function show($id)
    {
        return response()->json(Buku::find($id));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);
        $buku->update($request->all());
        return response()->json($buku);
    }

    public function destroy($id)
    {
        Buku::destroy($id);
        return response()->json(['message' => 'Buku dihapus']);
    }
}
