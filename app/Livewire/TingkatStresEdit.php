<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\TingkatStres;

class TingkatStresEdit extends Component
{
    public $levels = [];

    public function mount()
    {
        $this->levels = TingkatStres::orderBy('nilai_min')->get()->toArray();
    }

    public function updated($field)
    {
        $this->validateLevels();
    }

    public function validateLevels()
    {
        for ($i = 0; $i < count($this->levels) - 1; $i++) {
            $currentMax = $this->levels[$i]['nilai_max'];
            $nextMin = $this->levels[$i + 1]['nilai_min'];

            if ($currentMax >= $nextMin) {
                $this->addError('levels.' . $i . '.nilai_max', 'Nilai max harus lebih kecil dari nilai min level selanjutnya');
                $this->addError('levels.' . ($i + 1) . '.nilai_min', 'Nilai min harus lebih besar dari nilai max level sebelumnya');
            } else {
                $this->resetErrorBag();
            }
        }
    }

    public function save()
    {
        $this->validateLevels();

        foreach ($this->levels as $level) {
            TingkatStres::where('id', $level['id'])->update([
                'nama_level' => $level['nama_level'],
                'nilai_min' => $level['nilai_min'],
                'nilai_max' => $level['nilai_max'],
            ]);
        }

        session()->flash('success', 'Data berhasil diperbarui');
    }

    public function render()
    {
        return view('livewire.tingkat-stres-edit');
    }
}

