<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kuisioner;
use App\Models\Jawaban;
use App\Models\HasilAnalisis;
use App\Models\TingkatStres;

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
        $jawabanTerdahulu = Jawaban::where('id_pasien', $this->pasien_id)
            ->where('jenis_test', $this->jenis)
            ->pluck('id_kuisioner');

        $this->pertanyaan = Kuisioner::whereNotIn('id', $jawabanTerdahulu)->get()->toArray();
        $this->currentIndex = 0;

        if (empty($this->pertanyaan)) {
            $this->selesai = true;
            $this->showModal = true;
        }
    }

    public function pilihJawaban($nilai)
    {
        if (!isset($this->pertanyaan[$this->currentIndex])) return;

        $kuis = $this->pertanyaan[$this->currentIndex];

        $finalNilai = $kuis['is_positive'] ? (4 - $nilai) : $nilai;

        $existing = Jawaban::where('id_pasien', $this->pasien_id)
                ->where('id_kuisioner', $kuis['id'])
                ->where('jenis_test', $this->jenis)
                ->first();

        if (!$existing) {
            Jawaban::create([
                'id_kuisioner' => $kuis['id'],
                'id_pasien' => $this->pasien_id,
                'nilai' => $finalNilai,
                'jenis_test' => $this->jenis
            ]);
        }else{
            $existing->update([
                'nilai' => $finalNilai
            ]);
        }

        // pindah otomatis ke soal selanjutnya
        if ($this->currentIndex < count($this->pertanyaan) - 1) {
            $this->currentIndex++;
        } else {
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

        $maxNilai = Kuisioner::count() * 4;
        $persentase = $total / $maxNilai * 100;

        $tingkatStres = TingkatStres::pluck('nilai_max', 'nama_level');
        $idTingkatStres = TingkatStres::pluck('id', 'nama_level');

        $level = match (true) {
            $persentase <= $tingkatStres['rendah'] => $idTingkatStres['rendah'],
            $persentase <= $tingkatStres['sedang'] => $idTingkatStres['sedang'],
            default => $idTingkatStres['tinggi'],
        };

        $analisis = HasilAnalisis::firstOrNew(['id_pasien' => $this->pasien_id]);

        if ($this->jenis === 'pretest') {
            $analisis->skor_pretest = $total;
            $analisis->tanggal_pretest = now();
            $analisis->hasil_pretest = $level;
        } else {
            $analisis->skor_posttest = $total;
            $analisis->tanggal_posttest = now();
            $analisis->hasil_posttest = $level;

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


    public function sebelumnya()
    {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
        }
    }

    public function selanjutnya()
    {
        if ($this->currentIndex < count($this->pertanyaan) - 1) {
            $this->currentIndex++;
        }
    }

    public function goToSoal($index)
    {
        if (isset($this->pertanyaan[$index])) {
            $this->currentIndex = $index;
        }
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
