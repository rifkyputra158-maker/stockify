@extends('layouts.dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Konfirmasi Barang Masuk & Keluar</h1>
    <p class="text-sm text-slate-500 mt-1">Periksa fisik barang, lalu konfirmasi atau tolak transaksi yang tercatat.</p>
</div>

@if (session('success'))
    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-100">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-100">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm text-left text-slate-500">
        <thead class="text-xs text-slate-700 uppercase bg-slate-50">
            <tr>
                <th class="px-6 py-3">Tanggal</th>
                <th class="px-6 py-3">Produk</th>
                <th class="px-6 py-3">Tipe</th>
                <th class="px-6 py-3">Jumlah</th>
                <th class="px-6 py-3">Dicatat Oleh</th>
                <th class="px-6 py-3">Catatan</th>
                <th class="px-6 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $trx)
                <tr class="border-b last:border-0">
                    <td class="px-6 py-4">{{ $trx->date }}</td>
                    <td class="px-6 py-4 font-medium text-slate-900">{{ $trx->product->name }}</td>
                    <td class="px-6 py-4">
                        @if ($trx->type === 'in')
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">Masuk</span>
                        @else
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700">Keluar</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $trx->quantity }}</td>
                    <td class="px-6 py-4">{{ $trx->user->name }}</td>
                    <td class="px-6 py-4">{{ $trx->notes ?? '-' }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <form action="{{ route('stock-transactions.confirm', $trx->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin barang sudah diperiksa dan sesuai?')">
                                @csrf
                                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 transition-colors font-medium rounded-lg text-xs px-4 py-2">
                                    Konfirmasi
                                </button>
                            </form>

                            <button type="button" onclick="document.getElementById('reject-modal-{{ $trx->id }}').classList.remove('hidden')"
                                    class="text-white bg-red-600 hover:bg-red-700 transition-colors font-medium rounded-lg text-xs px-4 py-2">
                                Tolak
                            </button>
                        </div>

                        <!-- Modal alasan penolakan -->
                        <div id="reject-modal-{{ $trx->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
                            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md text-left">
                                <h3 class="text-lg font-semibold text-slate-900 mb-3">Tolak Transaksi</h3>
                                <p class="text-sm text-slate-500 mb-4">
                                    Produk: <strong>{{ $trx->product->name }}</strong> ({{ $trx->quantity }} unit)
                                </p>
                                <form action="{{ route('stock-transactions.reject', $trx->id) }}" method="POST">
                                    @csrf
                                    <label class="block mb-1 text-sm font-medium text-slate-900">Alasan Penolakan</label>
                                    <textarea name="rejection_reason" rows="3" required placeholder="Contoh: Barang cacat, kemasan rusak"
                                              class="bg-slate-50 border border-slate-300 text-sm rounded-lg block w-full p-2.5 mb-4 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400"></textarea>
                                    <div class="flex gap-2 justify-end">
                                        <button type="button" onclick="document.getElementById('reject-modal-{{ $trx->id }}').classList.add('hidden')"
                                                class="text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 font-medium rounded-lg text-sm px-4 py-2 transition-colors">
                                            Batal
                                        </button>
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-4 py-2 transition-colors">
                                            Tolak Transaksi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-slate-500">Tidak ada transaksi yang menunggu konfirmasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $transactions->links() }}
</div>
@endsection