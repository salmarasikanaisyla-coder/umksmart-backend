<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UmkmController extends Controller
{
    // 1. DASHBOARD & SMART INSIGHT
    public function dashboard() {
        $userId = Auth::id();

        $omzet = Sale::where('user_id', $userId)->sum('total');
        $pengeluaran = Expense::where('user_id', $userId)->sum('amount');
        
        // HPP total dari barang yang terjual
        $hppTotal = Sale::where('sales.user_id', $userId)
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->sum(DB::raw('sales.quantity * products.hpp'));

        $laba = $omzet - $hppTotal - $pengeluaran;
        $stokMenipis = Product::where('user_id', $userId)->whereColumn('stock', '<=', 'min_stock')->get();

        // Logika Smart Insight Sederhana
        $insights = [];
        
        // Insight 1: Produk paling menguntungkan
        $bestProduct = Sale::where('sales.user_id', $userId)
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM((sales.price - products.hpp) * sales.quantity) as total_profit'))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_profit')
            ->first();

        if ($bestProduct) {
            $insights[] = "Produk Paling Menguntungkan: {$bestProduct->name} memberikan kontribusi margin terbesar bagi usaha Anda.";
        }

        // Insight 2: Evaluasi Stok
        if ($stokMenipis->count() > 0) {
            $insights[] = "Perhatian Stok: Terdapat {$stokMenipis->count()} barang yang stoknya sudah di bawah batas minimum.";
        } else {
            $insights[] = "Stok Aman: Semua persediaan bahan dan produk Anda saat ini dalam tingkat aman.";
        }

        return view('dashboard', compact('omzet', 'laba', 'pengeluaran', 'stokMenipis', 'insights'));
    }

    // 2. MANAJEMEN PRODUK & STOK
    public function indexProduct() {
        $products = Product::where('user_id', Auth::id())->get();
        return view('products.index', compact('products'));
    }

    public function storeProduct(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'hpp' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'min_stock' => 'required|integer',
            'unit' => 'required|string'
        ]);

        Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'hpp' => $request->hpp,
            'price' => $request->price,
            'stock' => $request->stock,
            'min_stock' => $request->min_stock,
            'unit' => $request->unit,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // 3. TRANSAKSI (PEMASUKAN & PENGELUARAN)
    public function indexTransaction() {
        $userId = Auth::id();
        $products = Product::where('user_id', $userId)->get();
        $sales = Sale::where('user_id', $userId)->with('product')->latest()->take(10)->get();
        $expenses = Expense::where('user_id', $userId)->latest()->take(10)->get();

        return view('transactions.index', compact('products', 'sales', 'expenses'));
    }

    public function storeSale(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'date' => 'required|date',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $total = $product->price * $request->quantity;

        Sale::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'date' => $request->date,
            'quantity' => $request->quantity,
            'price' => $product->price,
            'total' => $total
        ]);

        // Potong Stok Produk
        $product->decrement('stock', $request->quantity);

        return redirect()->back()->with('success', 'Penjualan berhasil dicatat!');
    }

    public function storeExpense(Request $request) {
        $request->validate([
            'date' => 'required|date',
            'category' => 'required|string',
            'description' => 'required|string',
            'amount' => 'required|numeric'
        ]);

        Expense::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'category' => $request->category,
            'description' => $request->description,
            'amount' => $request->amount
        ]);

        return redirect()->back()->with('success', 'Pengeluaran berhasil dicatat!');
    }

    // 4. LAPORAN KEUANGAN
    public function report() {
        $userId = Auth::id();
        $pendapatan = Sale::where('user_id', $userId)->sum('total');
        $hpp = Sale::where('sales.user_id', $userId)
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->sum(DB::raw('sales.quantity * products.hpp'));
        $labaKotor = $pendapatan - $hpp;
        $bebanOperasional = Expense::where('user_id', $userId)->sum('amount');
        $labaBersih = $labaKotor - $bebanOperasional;

        return view('reports.index', compact('pendapatan', 'hpp', 'labaKotor', 'bebanOperasional', 'labaBersih'));
    }

    // 5. KALKULATOR BEP
    public function bep(Request $request) {
        $bepUnit = null;
        if ($request->has(['fixed_cost', 'price', 'variable_cost'])) {
            $fixedCost = $request->fixed_cost;
            $price = $request->price;
            $variableCost = $request->variable_cost;

            $margin = $price - $variableCost;
            if ($margin > 0) {
                $bepUnit = ceil($fixedCost / $margin);
            }
        }

        return view('bep.index', compact('bepUnit'));
    }
}