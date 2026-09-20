<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Ringkasan Usaha
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Pantau pendapatan, laba, dan persediaan dalam satu layar.</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Live Update
            </span>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Banner Kontras Tinggi -->
        <div class="bg-slate-900 text-white p-6 rounded-2xl shadow-md border border-slate-800 relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="text-2xl font-black text-white">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                <p class="text-slate-300 text-sm mt-1">Berikut adalah ikhtisar kondisi performa keuangan usaha Anda hari ini.</p>
            </div>
            <div class="absolute -right-4 -bottom-6 text-8xl opacity-10 select-none">📊</div>
        </div>

        <!-- Metric Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- Omzet -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-slate-300 transition">
                <div class="flex justify-between items-start">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">OMZET PENJUALAN</span>
                    <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg text-lg">💰</div>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-slate-900">Rp {{ number_format($omzet, 0, ',', '.') }}</div>
                    <div class="text-xs text-slate-500 mt-1">Total kotor hasil penjualan</div>
                </div>
            </div>

            <!-- Laba Bersih -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-slate-300 transition">
                <div class="flex justify-between items-start">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">ESTIMASI LABA</span>
                    <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg text-lg">📈</div>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black {{ $laba >= 0 ? 'text-slate-900' : 'text-rose-600' }}">
                        Rp {{ number_format($laba, 0, ',', '.') }}
                    </div>
                    <div class="text-xs text-slate-500 mt-1">Omzet - (HPP + Pengeluaran)</div>
                </div>
            </div>

            <!-- Pengeluaran -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-slate-300 transition">
                <div class="flex justify-between items-start">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">TOTAL PENGELUARAN</span>
                    <div class="p-2 bg-rose-50 text-rose-600 rounded-lg text-lg">💸</div>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-slate-900">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</div>
                    <div class="text-xs text-slate-500 mt-1">Operasional & pengeluaran lain</div>
                </div>
            </div>

            <!-- Stok Menipis -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-slate-300 transition">
                <div class="flex justify-between items-start">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">STOK MENIPIS</span>
                    <div class="p-2 bg-amber-50 text-amber-600 rounded-lg text-lg">📦</div>
                </div>
                <div class="mt-2">
                    <div class="text-2xl font-black text-amber-600">{{ $stokMenipis->count() }} <span class="text-xs text-slate-400 font-normal">Item</span></div>
                    <a href="{{ route('products.index') }}" class="text-xs text-indigo-600 font-semibold hover:underline mt-1 inline-block">Cek daftar produk &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Smart Insight AI Section -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-xs">
            <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100">
                <span class="p-2 bg-indigo-50 text-indigo-600 rounded-lg text-base">💡</span>
                <div>
                    <h4 class="font-extrabold text-slate-900 text-base">SMART INSIGHT AI</h4>
                    <p class="text-xs text-slate-500">Rekomendasi otomatis untuk optimasi bisnis Anda.</p>
                </div>
            </div>

            <ul class="space-y-2.5">
                @forelse($insights as $insight)
                    <li class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl text-xs text-slate-700 font-medium border border-slate-100">
                        <span class="text-indigo-600 font-bold">•</span>
                        <span>{{ $insight }}</span>
                    </li>
                @empty
                    <li class="p-4 bg-slate-50 rounded-xl text-xs text-slate-500 italic text-center">
                        Belum ada insight. Tambahkan transaksi penjualan dan produk untuk mengaktifkan analisis otomatis.
                    </li>
                @endforelse
            </ul>
        </div>

    </div>
</x-app-layout>