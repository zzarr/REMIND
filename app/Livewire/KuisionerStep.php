<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kuisioner;
use App\Models\Jawaban;
use App\Models\HasilAnalisis;

class KuisionerStep extends Component
{
    public $pasien_id, $jenis;
    public $pertanyaan = [];
    public $currentIndex = 0;
    public $selesai = false;
    public $showModal = false;

    public function mount($pasien_id, $jenis)
    {
        $this->pasien_id = $pasien_id;
        $this->jenis = $jenis;
        $this->pertanyaan = Kuisioner::all()->toArray();

        // Cari index pertanyaan yang belum dijawab
        $jawabanTerdahulu = Jawaban::where('id_pasien', $this->pasien_id)
            ->where('jenis_test', $this->jenis)
            ->pluck('id_kuisioner')
            ->toArray();

        foreach ($this->pertanyaan as $i => $soal) {
            if (!in_array($soal['id'], $jawabanTerdahulu)) {
                $this->currentIndex = $i;
                break;
            }
        }

        if ($this->currentIndex >= count($this->pertanyaan)) {
            $this->selesai = true;
        }
    }

    public function pilihJawaban($nilai)
    {
        if (!isset($this->pertanyaan[$this->currentIndex])) return;

        $kuis = $this->pertanyaan[$this->currentIndex];

        $finalNilai = $kuis['is_positive'] ? (4 - $nilai) : $nilai;

        $exists = Jawaban::where('id_pasien', $this->pasien_id)
            ->where('id_kuisioner', $kuis['id'])
            ->where('jenis_test', $this->jenis)
            ->exists();

        if (!$exists) {
            Jawaban::create([
                'id_kuisioner' => $kuis['id'],
                'id_pasien' => $this->pasien_id,
                'nilai' => $finalNilai,
                'jenis_test' => $this->jenis
            ]);
        }

        $this->currentIndex++;

        if ($this->currentIndex >= count($this->pertanyaan)) {
            $this->hitungSkor();
            $this->selesai = true;
            $this->showModal = true;
        }
    }

    public function hitungSkor()
    {
        $total = Jawaban::where('id_pasien', $this->pasien_id)
            ->where('jenis_test', $this->jenis)
            ->sum('nilai');

        $analisis = HasilAnalisis::firstOrNew(['id_pasien' => $this->pasien_id]);

        if ($this->jenis === 'pretest') {
            $analisis->skor_pretest = $total;
            $analisis->tanggal_pretest = now();
        } else {
            $analisis->skor_posttest = $total;
            $analisis->tanggal_posttest = now();

            if (!is_null($analisis->skor_pretest)) {
                $analisis->kesimpulan = match (true) {
                    $total > $analisis->skor_pretest => 'Meningkat',
                    $total < $analisis->skor_pretest => 'Menurun',
                    default => 'Netral',
                };
            }
        }

        $analisis->save();
    }

    public function redirectToPasien()
    {
        return redirect()->route('tim_peneliti.pasien.index');
    }

    public function render()
    {
        return view('livewire.kuisioner-step');
    }
}
