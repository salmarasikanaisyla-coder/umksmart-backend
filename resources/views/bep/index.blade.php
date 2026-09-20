<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kalkulator BEP (Break Even Point) 🎯</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <form action="{{ route('bep.index') }}" method="GET" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium">Biaya Tetap / Fixed Cost (Rp)</label>
                    <input type="number" name="fixed_cost" value="{{ request('fixed_cost', 2000000) }}" class="w-full border rounded p-2 text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Harga Jual Per Unit (Rp)</label>
                    <input type="number" name="price" value="{{ request('price', 15000) }}" class="w-full border rounded p-2 text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Biaya Variabel Per Unit / HPP (Rp)</label>
                    <input type="number" name="variable_cost" value="{{ request('variable_cost', 10000) }}" class="w-full border rounded p-2 text-sm" required>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded shadow">Hitung BEP</button>
            </form>

            @if(isset($bepUnit))
                <div class="mt-6 p-4 bg-indigo-50 border-l-4 border-indigo-500 rounded">
                    <p class="text-sm font-bold text-indigo-700">Hasil Perhitungan:</p>
                    <p class="text-2xl font-extrabold text-indigo-900 my-1">BEP = {{ $bepUnit }} Unit</p>
                    <p class="text-sm text-indigo-800">🎯 Usaha Anda perlu menjual sekitar <strong>{{ $bepUnit }} produk</strong> untuk mencapai titik impas (kembali modal).</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>