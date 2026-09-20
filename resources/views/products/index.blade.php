<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Produk & Monitoring Stok 📦</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Form Tambah Produk -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-bold text-lg mb-4">Tambah Produk / Bahan</h3>
            <form action="{{ route('products.store') }}" method="POST" class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @csrf
                <input type="text" name="name" placeholder="Nama Produk" class="border rounded p-2 text-sm" required>
                <input type="number" name="hpp" placeholder="HPP (Rp)" class="border rounded p-2 text-sm" required>
                <input type="number" name="price" placeholder="Harga Jual (Rp)" class="border rounded p-2 text-sm" required>
                <input type="number" name="stock" placeholder="Stok Awal" class="border rounded p-2 text-sm" required>
                <input type="number" name="min_stock" placeholder="Batas Stok Min" value="5" class="border rounded p-2 text-sm" required>
                <input type="text" name="unit" placeholder="Satuan (kg/pcs/L)" value="pcs" class="border rounded p-2 text-sm" required>
                <button type="submit" class="col-span-2 md:col-span-3 bg-blue-600 text-white font-bold py-2 rounded shadow">+ Tambah Produk</button>
            </form>
        </div>

        <!-- Tabel Monitoring Stok -->
        <div class="bg-white p-4 rounded-lg shadow overflow-x-auto">
            <h3 class="font-bold text-lg mb-4">Daftar Stok Produk</h3>
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="p-2">Produk</th>
                        <th class="p-2">HPP</th>
                        <th class="p-2">Harga Jual</th>
                        <th class="p-2">Stok</th>
                        <th class="p-2">Status Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="border-b">
                        <td class="p-2 font-semibold">{{ $product->name }}</td>
                        <td class="p-2">Rp {{ number_format($product->hpp,0,',','.') }}</td>
                        <td class="p-2">Rp {{ number_format($product->price,0,',','.') }}</td>
                        <td class="p-2">{{ $product->stock }} {{ $product->unit }}</td>
                        <td class="p-2">
                            @if($product->stock <= 2)
                                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded">🔴 Hampir habis</span>
                            @elseif($product->stock <= $product->min_stock)
                                <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">🟡 Menipis</span>
                            @else
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">🟢 Aman</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>