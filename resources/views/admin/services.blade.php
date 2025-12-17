@extends('layouts.admin')

@section('title', 'Kelola Layanan')
@section('page-title', 'Kelola Layanan')

@section('content')
<!-- Success/Error Messages -->
@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
    <strong>Berhasil!</strong> {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
    <strong>Error:</strong>
    <ul class="mt-2 list-disc list-inside">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form Tambah Layanan -->
    <div class="lg:col-span-1">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                    @if(isset($service)) Edit Layanan @else Tambah Layanan Baru @endif
                </h3>
                
                <!-- Debug Info -->

                
                <form method="POST" action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}" 
                      enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @if(isset($service))
                        @method('PUT')
                    @endif
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
                        <input type="text" name="name" id="name" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                               placeholder="Contoh: Haircut Premium" value="{{ old('name', isset($service) ? $service->name : '') }}">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="2"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                                  placeholder="Deskripsi layanan...">{{ old('description', isset($service) ? $service->description : '') }}</textarea>
                    </div>

                    <!-- Upload Foto -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Foto Layanan</label>
                        
                        <!-- Preview Area (will be populated by JavaScript) -->
                        <div id="image-preview-container" class="mt-1 mb-2" style="display: none;">
                            <!-- Preview will be inserted here -->
                        </div>
                        
                        <!-- Inline JavaScript for immediate loading -->
                        <script>
                        console.log('✅ Image preview JavaScript loaded');
                        

                        
                        // Handle image change
                        function handleImageChange(input) {
                            const file = input.files[0];
                            if (!file) return;
                            
                            // Validate file type
                            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                            if (!allowedTypes.includes(file.type)) {
                                alert('❌ Tipe file tidak didukung. Gunakan JPG, PNG, atau GIF.');
                                input.value = '';
                                return;
                            }
                            
                            // Validate file size (2MB)
                            if (file.size > 2048 * 1024) {
                                alert('❌ Ukuran file terlalu besar. Maksimal 2MB.');
                                input.value = '';
                                return;
                            }
                            
                            // Show preview
                            showImagePreview(file);
                        }
                        
                        // Show image preview
                        function showImagePreview(file) {
                            const container = document.getElementById('image-preview-container');
                            if (!container) return;
                            
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                container.innerHTML = `
                                    <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <img src="${e.target.result}" alt="Preview" class="h-16 w-16 object-cover rounded-lg">
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-green-800">✅ ${file.name}</p>
                                                <p class="text-xs text-green-600">Ukuran: ${(file.size / 1024).toFixed(1)} KB</p>
                                                <p class="text-xs text-green-600">Siap untuk diupload!</p>
                                            </div>
                                            <button type="button" onclick="clearImagePreview()" class="text-red-500 hover:text-red-700 text-sm px-2 py-1 rounded">✖</button>
                                        </div>
                                    </div>
                                `;
                                container.style.display = 'block';
                            };
                            reader.readAsDataURL(file);
                        }
                        
                        // Clear preview
                        function clearImagePreview() {
                            const container = document.getElementById('image-preview-container');
                            if (container) {
                                container.innerHTML = '';
                                container.style.display = 'none';
                            }
                            
                            const input = document.getElementById('image');
                            if (input) {
                                input.value = '';
                            }
                        }
                        </script>
                        

                        
                        <div id="upload-area" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-yellow-400 transition-colors">
                            <div class="space-y-1 text-center">
                                @if(isset($service) && $service->image)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="Current image" class="mx-auto h-32 w-32 object-cover rounded-lg">
                                    <p class="text-xs text-gray-500 mt-2">Foto saat ini</p>
                                </div>
                                @endif
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-yellow-600 hover:text-yellow-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-yellow-500">
                                        <span>Upload foto</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="handleImageChange(this)">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Tipe Layanan</label>
                        <select name="type" id="type" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                            <option value="">Pilih Tipe</option>
                            <option value="ekonomis" {{ old('type', isset($service) ? $service->type : '') == 'ekonomis' ? 'selected' : '' }}>Ekonomis</option>
                            <option value="populer" {{ old('type', isset($service) ? $service->type : '') == 'populer' ? 'selected' : '' }}>Populer</option>
                            <option value="premium" {{ old('type', isset($service) ? $service->type : '') == 'premium' ? 'selected' : '' }}>Premium</option>
                            <option value="paket" {{ old('type', isset($service) ? $service->type : '') == 'paket' ? 'selected' : '' }}>Paket</option>
                        </select>
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                        <input type="number" name="price" id="price" required min="0"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                               placeholder="50000" value="{{ old('price', isset($service) ? $service->price : '') }}">
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700">Durasi (menit)</label>
                        <input type="number" name="duration" id="duration" required min="1"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                               placeholder="45" value="{{ old('duration', isset($service) ? $service->duration : '') }}">
                    </div>

                    <div>
                        <label for="features" class="block text-sm font-medium text-gray-700">Fitur (pisahkan dengan koma)</label>
                        <input type="text" name="features" id="features"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                               placeholder="Konsultasi gratis, Potong rambut profesional" 
                               value="{{ old('features', isset($service) && $service->features ? implode(', ', $service->features) : '') }}">
                    </div>

                    <div class="flex space-x-3">
                        <button type="submit" 
                                class="flex-1 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if(isset($service))
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                @endif
                            </svg>
                            @if(isset($service)) Update Layanan @else Tambah Layanan @endif
                        </button>
                        
                        @if(isset($service))
                        <a href="{{ route('admin.services') }}" 
                           class="flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                            Batal
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Daftar Layanan -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Daftar Layanan</h3>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Layanan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tipe
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Harga
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Durasi
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($services as $service)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($service->image)
                                        <div class="w-12 h-12 mr-3">
                                            <img src="{{ asset('storage/' . $service->image) }}" 
                                                 alt="{{ $service->name }}" 
                                                 class="w-full h-full object-cover rounded-lg">
                                        </div>
                                        @else
                                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $service->name }}</div>
                                            @if($service->description)
                                            <div class="text-xs text-gray-500">{{ Str::limit($service->description, 50) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $service->type_color }}">
                                        {{ ucfirst($service->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $service->formatted_price }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $service->duration }} menit</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.services.edit', $service->id) }}" 
                                           class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        
                                        <!-- Delete Button -->
                                        <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}" 
                                              class="inline" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada layanan</h3>
                                        <p class="text-gray-500 mb-4">Tambahkan layanan pertama menggunakan form di sebelah kiri</p>
                                        <div class="text-sm text-gray-400">
                                            💡 Tips: Upload foto untuk membuat layanan lebih menarik
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Service Stats -->
<div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Layanan Aktif</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $services->count() }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Rata-rata Harga</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $services->count() > 0 ? 'Rp ' . number_format($services->avg('price'), 0, ',', '.') : 'Rp 0' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Rata-rata Durasi</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $services->count() > 0 ? round($services->avg('duration')) : 0 }} menit</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Form submission handler
document.addEventListener('DOMContentLoaded', function() {
    const serviceForm = document.querySelector('form[enctype="multipart/form-data"]');
    if (serviceForm) {
        serviceForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '⏳ Menyimpan...';
            }
        });
    }
});
</script>
@endpush