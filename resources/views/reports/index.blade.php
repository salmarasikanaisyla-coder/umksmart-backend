<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Keuangan 📊</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-lg shadow font-mono space-y-3">
            <div class="text-center border-b pb-3">
                <h3 class="font-bold text-lg">UMKM SMARTBOOK</h3>
                <p class="text-sm text-gray-500">LAPORAN LABA RUGI</p>
            </div>

            <div class="flex justify-between">
                <span>Pendapatan</span>
                <span class="font-bold">Rp {{ number_format($pendapatan,0,',','.') }}</span>
            </div>
            <div class="flex justify-between text-red-600">
                <span>HPP</span>
                <span>(Rp {{ number_format($hpp,0,',','.') }})</span>
            </div>
            <hr>
            <div class="flex justify-between font-bold text-gray-800">
                <span>Laba Kotor</span>
                <span>Rp {{ number_format($labaKotor,0,',','.') }}</span>
            </div>
            <div class="flex justify-between text-red-600">
                <span>Beban Operasional</span>
                <span>(Rp {{ number_format($bebanOperasional,0,',','.') }})</span>
            </div>
            <hr class="border-2 border-black">
            <div class="flex justify-between font-extrabold text-lg text-green-700 bg-green-50 p-2 rounded">
                <span>LABA BERSIH</span>
                <span>Rp {{ number_format($labaBersih,0,',','.') }}</span>
            </div>
        </div>
    </div>
</x-app-layout>