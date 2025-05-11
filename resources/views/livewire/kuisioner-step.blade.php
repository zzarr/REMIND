<div class="container mt-5">
    @php
        use App\Models\Jawaban;
    @endphp

    @if ($selesai)
        <div class="text-center">
            <h4 class="text-success mb-3">Terima kasih! Kuisioner {{ ucfirst($jenis) }} telah selesai.</h4>
            <a href="{{ route('tim_peneliti.pasien.index') }}" class="btn btn-primary">Kembali ke daftar pasien</a>
        </div>
    @else
        @php
            $item = $pertanyaan[$currentIndex];
            $labels = [
                0 => 'Never',
                1 => 'Almost Never',
                2 => 'Sometimes',
                3 => 'Fairly Often',
                4 => 'Very Often',
            ];

            $jawabanSebelumnya = Jawaban::where('id_pasien', $pasien_id)
                ->where('id_kuisioner', $item['id'])
                ->where('jenis_test', $jenis)
                ->first();
        @endphp

        @if ($jawabanSebelumnya)
            <div class="alert alert-info">
                Jawaban sebelumnya: <strong>{{ $jawabanSebelumnya->label }}</strong>
            </div>
        @endif

        <div class="card shadow-sm ">
            <div class="card-body">
                <h5 class="mb-3">Pertanyaan {{ $currentIndex + 1 }} dari {{ count($pertanyaan) }}</h5>
                <p class="fs-5">{{ $item['pertanyaan'] }}</p>

                <div class="d-grid gap-2">
                    @foreach ($labels as $val => $text)
                        <button wire:click="pilihJawaban({{ $val }})"
                            class="btn btn-outline-primary text-start">
                            <strong>{{ $text }}</strong>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@if ($showModal)
    <div wire:ignore.self class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-success">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Kuisioner Selesai</h5>
                </div>
                <div class="modal-body">
                    Kuisioner {{ ucfirst($jenis) }} telah berhasil diisi. Terima kasih atas partisipasinya.
                </div>
                <div class="modal-footer">
                    <button wire:click="redirectToPasien" class="btn btn-success">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
@endif
