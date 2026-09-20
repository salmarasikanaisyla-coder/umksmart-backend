<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-9 h-9 bg-indigo-600 text-white rounded-xl flex items-center justify-center font-black text-lg shadow-sm">
                            S
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-slate-800 text-base leading-none">SMARTBOOK</span>
                            <span class="text-[10px] text-indigo-600 font-bold tracking-widest uppercase">UMKM EDITION</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:space-x-1 sm:ms-6">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 font-bold border-b-2 border-indigo-600' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }} px-3 py-2 rounded-lg text-sm transition-all duration-150 inline-flex items-center gap-2">
                        📊 Dashboard
                    </a>
                    <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.index') ? 'bg-indigo-50 text-indigo-700 font-bold border-b-2 border-indigo-600' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }} px-3 py-2 rounded-lg text-sm transition-all duration-150 inline-flex items-center gap-2">
                        📦 Produk & Stok
                    </a>
                    <a href="{{ route('transactions.index') }}" class="{{ request()->routeIs('transactions.index') ? 'bg-indigo-50 text-indigo-700 font-bold border-b-2 border-indigo-600' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }} px-3 py-2 rounded-lg text-sm transition-all duration-150 inline-flex items-center gap-2">
                        💸 Transaksi
                    </a>
                    <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.index') ? 'bg-indigo-50 text-indigo-700 font-bold border-b-2 border-indigo-600' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }} px-3 py-2 rounded-lg text-sm transition-all duration-150 inline-flex items-center gap-2">
                        📈 Laporan
                    </a>
                    <a href="{{ route('bep.index') }}" class="{{ request()->routeIs('bep.index') ? 'bg-indigo-50 text-indigo-700 font-bold border-b-2 border-indigo-600' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }} px-3 py-2 rounded-lg text-sm transition-all duration-150 inline-flex items-center gap-2">
                        ⚖️ Kalkulator BEP
                    </a>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 px-3 py-1.5 border border-slate-200 rounded-full bg-slate-50 hover:bg-slate-100 text-slate-700 font-medium text-xs transition">
                            <span class="w-6 h-6 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">👤 Profil Saya</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                🚪 Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-200 bg-slate-50 p-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-slate-700 font-medium">📊 Dashboard</a>
        <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-lg text-slate-700 font-medium">📦 Produk & Stok</a>
        <a href="{{ route('transactions.index') }}" class="block px-3 py-2 rounded-lg text-slate-700 font-medium">💸 Transaksi</a>
        <a href="{{ route('reports.index') }}" class="block px-3 py-2 rounded-lg text-slate-700 font-medium">📈 Laporan</a>
        <a href="{{ route('bep.index') }}" class="block px-3 py-2 rounded-lg text-slate-700 font-medium">⚖️ Kalkulator BEP</a>
        <div class="border-t border-slate-200 pt-3 flex justify-between items-center">
            <span class="text-xs font-bold text-slate-600">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs bg-rose-600 text-white px-3 py-1 rounded-md font-bold">Logout</button>
            </form>
        </div>
    </div>
</nav>