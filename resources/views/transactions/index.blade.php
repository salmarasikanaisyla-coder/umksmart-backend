<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight flex items-center gap-2">
            💸 Catat Transaksi
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-xl shadow-xs flex items-center gap-2">
                <span>✅</span>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Form Pemasukan/Penjualan -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 hover:shadow-md transition-all">
                <div class="flex items-center gap-3 mb-5 border-b border-slate-100 pb-4">
                    <div class="p-2.5 bg-emerald-100 text-emerald-700 rounded-xl font-bold">🛒</div>
                    <div>
                        <h3 class="font-extrabold text-lg text-slate-900">Tambah Penjualan</h3>
                        <p class="text-xs text-slate-500">Catat transaksi barang keluar / transaksi pembeli</p>
                    </div>
                </div>

                <form action="{{ route('transactions.sale') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Tanggal Transaksi</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full border-slate-300 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 text-sm py-2.5" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Pilih Produk</label>
                        @if($products->isEmpty())
                            <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-800">
                                ⚠️ Belum ada produk. Silakan tambah produk di menu <a href="{{ route('products.index') }}" class="underline font-bold text-blue-600">Produk & Stok</a> terlebih dahulu.
                            </div>
                        @else
                            <select name="product_id" class="w-full border-slate-300 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 text-sm py-2.5" required>
                                <option value="" disabled selected>-- Pilih Produk --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} — Rp {{ number_format($product->price,0,',','.') }} (Stok: {{ $product->stock }})</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Jumlah / Qty</label>
                        <input type="number" name="quantity" min="1" value="1" class="w-full border-slate-300 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 text-sm py-2.5" required>
                    </div>

                    <button type="submit" @if($products->isEmpty()) disabled @endif class="w-full bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-bold py-3 rounded-xl shadow-md hover:shadow-lg transition-all text-sm disabled:opacity-50">
                        + Simpan Transaksi Penjualan
                    </button>
                </form>
            </div>

            <!-- Form Pengeluaran -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 hover:shadow-md transition-all">
                <div class="flex items-center gap-3 mb-5 border-b border-slate-100 pb-4">
                    <div class="p-2.5 bg-rose-100 text-rose-700 rounded-xl font-bold">💸</div>
                    <div>
                        <h3 class="font-extrabold text-lg text-slate-900">Tambah Pengeluaran</h3>
                        <p class="text-xs text-slate-500">Catat biaya operasional, sewa, gaji, atau bahan baku</p>
                    </div>
                </div>

                <form action="{{ route('transactions.expense') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Tanggal Transaksi</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full border-slate-300 rounded-xl focus:ring-rose-500 focus:border-rose-500 text-sm py-2.5" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kategori Pengeluaran</label>
                        <input type="text" name="category" placeholder="Contoh: Bahan Baku, Listrik, Kebersihan" class="w-full border-slate-300 rounded-xl focus:ring-rose-500 focus:border-rose-500 text-sm py-2.5" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Rincian Keterangan</label>
                        <input type="text" name="description" placeholder="Penjelasan pengeluaran..." class="w-full border-slate-300 rounded-xl focus:ring-rose-500 focus:border-rose-500 text-sm py-2.5" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Jumlah Nominal (Rp)</label>
                        <input type="number" name="amount" placeholder="0" class="w-full border-slate-300 rounded-xl focus:ring-rose-500 focus:border-rose-500 text-sm py-2.5" required>
                    </div>

                    <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 active:bg-rose-800 text-white font-bold py-3 rounded-xl shadow-md hover:shadow-lg transition-all text-sm">
                        + Simpan Pengeluaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>