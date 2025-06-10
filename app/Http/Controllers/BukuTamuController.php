<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTamu;

class BukuTamuController extends Controller {
    public function showForm() {
        return view('index');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'instansi' => 'required|string|max:255',
        'telepon' => 'required|string|max:15',
        'tujuan' => 'required|string',
        'photo' => 'required|string', // Base64 encoded image
        'signature' => 'required|string' // Base64 encoded signature
    ]);

    // Simpan foto
    $photoName = time() . '_photo.png';
    $photoPath = public_path('uploads/' . $photoName);
    $photoData = $request->photo;
    $photoData = preg_replace('/^data:image\/\w+;base64,/', '', $photoData);
    $photoData = base64_decode($photoData);
    file_put_contents($photoPath, $photoData);

    // Simpan tanda tangan
    $signatureName = time() . '_signature.png';
    $signaturePath = public_path('uploads/' . $signatureName);
    $signatureData = $request->signature;
    $signatureData = preg_replace('/^data:image\/\w+;base64,/', '', $signatureData);
    $signatureData = base64_decode($signatureData);
    file_put_contents($signaturePath, $signatureData);

    // Simpan data ke database
    BukuTamu::create([
        'tanggal' => now()->format('Y-m-d'),
        'waktu' => now()->format('H:i:s'),
        'nama' => $request->nama,
        'instansi' => $request->instansi,
        'telepon' => $request->telepon,
        'tujuan' => $request->tujuan,
        'foto' => $photoName,
        'ttd' => $signatureName,
    ]);

    return response()->json(['success' => 'Data berhasil disimpan!']);
}

}



