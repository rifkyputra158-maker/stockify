@extends('layouts.dashboard')

@section('content')
<div class="px-4 pt-6">
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Supplier</h1>
        <a href="{{ route('suppliers.create') }}"
   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    + Tambah Supplier
</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">Telepon</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $supplier->name }}</td>
                        <td class="px-6 py-4">{{ $supplier->address ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $supplier->phone ?? '-' }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('suppliers.edit', $supplier) }}"
                               class="font-medium text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b">
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada supplier.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $suppliers->links() }}
    </div>
</div>
@endsection