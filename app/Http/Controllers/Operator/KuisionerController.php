<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kuisioner;

class KuisionerController extends Controller
{
    public function index()
    {
        return view('operator.kuisioner.index');
    }

    public function data()
    {
        $data = Kuisioner::all();
        return datatables()->of($data)->addIndexColumn()->make(true);
    }

    public function store(Request $request)
    {
        $sum = Kuisioner::count(); // Ambil total pertanyaan saat ini

        // Pengecekan jumlah pertanyaan
        if ($sum >= 10) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Kuisioner sudah mencapai batas maksimal 10 pertanyaan.',
                ],
                400,
            );
        }

        // Validasi input dari request
        $request->validate([
            'pertanyaan' => 'required',
            'is_positive' => 'required',
        ]);

        // Konversi ke boolean 1/0
        $is_positive = filter_var($request->is_positive, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

        // Simpan data kuisioner
        try {
            Kuisioner::create([
                'pertanyaan' => $request->pertanyaan,
                'is_positive' => $is_positive,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pertanyaan kuisioner berhasil ditambahkan',
            ]);
        } catch (\Exception $e) {
            // Untuk debugging, log error-nya
            \Log::error('Gagal menyimpan kuisioner: ' . $e->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menambahkan pertanyaan.',
                ],
                500,
            );
        }
    }

    public function edit($id)
    {
        $data = Kuisioner::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'is_positive' => 'required|in:true,false',
        ]);

        $kuisioner = Kuisioner::find($id);
        if (!$kuisioner) {
            return response()->json(['success' => false, 'message' => 'Kuisioner tidak ditemukan'], 404);
        }

        $kuisioner->pertanyaan = $request->pertanyaan;
        $kuisioner->is_positive = $request->is_positive === 'true'; // Konversi ke boolean
        $kuisioner->save();

        return response()->json(['success' => true, 'message' => 'Kuisioner berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $data = Kuisioner::findOrFail($id);
        $data->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data kuisioner berhasil dihapus.',
        ]);
    }

    public function show(Request $request, $jenis, $pasien_id)
    {
        if (!in_array($jenis, ['pretest', 'posttest'])) {
            abort(404);
        }
        return view('tim.kuisioner.step-form', compact('jenis', 'pasien_id'));
    }
}
