<div>
    <h2 class="text-xl font-bold mb-4">Edit Tingkat Stres</h2>

    @if (session()->has('success'))
        <div class="p-2 bg-green-200 text-green-800">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        @foreach ($levels as $index => $level)
            <div class="p-4 border rounded">
                <h3 class="font-semibold capitalize">{{ $level['nama_level'] }}</h3>

                <div class="mt-2">
                    <label>Nilai Min:</label>
                    <input type="number" wire:model="levels.{{ $index }}.nilai_min" class="border p-1 w-24" />
                    @error("levels.$index.nilai_min")
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-2">
                    <label>Nilai Max:</label>
                    <input type="number" wire:model="levels.{{ $index }}.nilai_max" class="border p-1 w-24" />
                    @error("levels.$index.nilai_max")
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endforeach

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Simpan</button>
    </form>
</div>
