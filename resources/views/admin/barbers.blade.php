@extends('layouts.admin')

@section('title', 'Kelola Kapster')
@section('page-title', 'Kelola Kapster')

@section('content')
@if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form Tambah Kapster -->
    <div class="lg:col-span-1">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Tambah Kapster Baru</h3>
                
                <form method="POST" action="{{ isset($barber) ? route('admin.barbers.update', $barber->id) : route('admin.barbers.store') }}" 
                      class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    @if(isset($barber))
                        @method('PUT')
                    @endif
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Kapster</label>
                        <input type="text" name="name" id="name" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                               placeholder="Contoh: Ahmad Rizki" value="{{ old('name', $barber->name ?? '') }}">
                    </div>

                    <div>
                        <label for="level" class="block text-sm font-medium text-gray-700">Level Kapster</label>
                        <select name="level" id="level" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                            <option value="">Pilih Level</option>
                            <option value="junior" {{ old('level', $barber->level ?? '') == 'junior' ? 'selected' : '' }}>Junior Kapster</option>
                            <option value="professional" {{ old('level', $barber->level ?? '') == 'professional' ? 'selected' : '' }}>Professional Kapster</option>
                            <option value="senior" {{ old('level', $barber->level ?? '') == 'senior' ? 'selected' : '' }}>Senior Kapster</option>
                            <option value="master" {{ old('level', $barber->level ?? '') == 'master' ? 'selected' : '' }}>Master Kapster</option>
                            <option value="specialist" {{ old('level', $barber->level ?? '') == 'specialist' ? 'selected' : '' }}>Specialist Kapster</option>
                            <option value="creative" {{ old('level', $barber->level ?? '') == 'creative' ? 'selected' : '' }}>Creative Kapster</option>
                        </select>
                    </div>

                    <div>
                        <label for="experience" class="block text-sm font-medium text-gray-700">Pengalaman</label>
                        <input type="text" name="experience" id="experience" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                               placeholder="Contoh: 5 Tahun" value="{{ old('experience', $barber->experience ?? '') }}">
                    </div>

                    <div>
                        <label for="specialty" class="block text-sm font-medium text-gray-700">Spesialisasi</label>
                        <input type="text" name="specialty" id="specialty" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                               placeholder="Contoh: Modern Cut, Fade Cut" value="{{ old('specialty', $barber->specialty ?? '') }}">
                    </div>

                    <div>
                        <label for="skills" class="block text-sm font-medium text-gray-700">Keahlian (pisahkan dengan koma)</label>
                        <input type="text" name="skills" id="skills"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                               placeholder="Contoh: Fade Cut, Pompadour, Beard Styling" 
                               value="{{ old('skills', isset($barber) && $barber->skills ? implode(', ', $barber->skills) : '') }}">
                    </div>



                    <!-- Detailed Schedule Management -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Jadwal Detail (untuk sistem booking)</label>
                        <div id="schedule-container" class="space-y-3">
                            @if(isset($barber) && $barber->schedules->count() > 0)
                                @foreach($barber->schedules as $schedule)
                                <div class="schedule-row flex gap-2 items-center">
                                    <select name="schedules[{{ $loop->index }}][day]" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                        <option value="">Pilih Hari</option>
                                        @foreach(\App\Models\BarberSchedule::getDayOptions() as $value => $label)
                                            <option value="{{ $value }}" {{ $schedule->day_of_week == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <input type="time" name="schedules[{{ $loop->index }}][start_time]" 
                                           value="{{ $schedule->start_time->format('H:i') }}"
                                           class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                    <input type="time" name="schedules[{{ $loop->index }}][end_time]" 
                                           value="{{ $schedule->end_time->format('H:i') }}"
                                           class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                    <button type="button" onclick="removeScheduleRow(this)" class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                                @endforeach
                            @else
                                <div class="schedule-row flex gap-2 items-center">
                                    <select name="schedules[0][day]" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                        <option value="">Pilih Hari</option>
                                        @foreach(\App\Models\BarberSchedule::getDayOptions() as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <input type="time" name="schedules[0][start_time]" placeholder="Jam Mulai"
                                           class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                    <input type="time" name="schedules[0][end_time]" placeholder="Jam Selesai"
                                           class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                    <button type="button" onclick="removeScheduleRow(this)" class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addScheduleRow()" class="mt-2 text-sm text-yellow-600 hover:text-yellow-800">
                            + Tambah Jadwal
                        </button>
                    </div>

                    <div>
                        <label for="rating" class="block text-sm font-medium text-gray-700">Rating (0-5)</label>
                        <input type="number" name="rating" id="rating" min="0" max="5" step="0.1"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                               placeholder="4.5" value="{{ old('rating', $barber->rating ?? '5.0') }}">
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700">Foto Kapster</label>
                        <input type="file" name="photo" id="photo" accept="image/*"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                        @if(isset($barber) && $barber->photo)
                            <div class="mt-2">
                                <img src="{{ asset('image/' . $barber->photo) }}" alt="{{ $barber->name }}" class="w-16 h-16 object-cover rounded-lg">
                                <p class="text-xs text-gray-500 mt-1">Foto saat ini: {{ $barber->photo }}</p>
                            </div>
                        @endif
                    </div>

                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                        <textarea name="bio" id="bio" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                                  placeholder="Bio singkat kapster...">{{ old('bio', $barber->bio ?? '') }}</textarea>
                    </div>

                    <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        {{ isset($barber) ? 'Update Kapster' : 'Tambah Kapster' }}
                    </button>

                    @if(isset($barber))
                        <a href="{{ route('admin.barbers') }}" 
                           class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                            Batal Edit
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Daftar Kapster -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Daftar Kapster</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($barbers as $barber)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-3">
                            @if($barber->photo)
                                <div class="w-12 h-12 rounded-full overflow-hidden mr-3">
                                    <img src="{{ asset('image/' . $barber->photo) }}" alt="{{ $barber->name }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-lg font-medium text-gray-900">{{ $barber->name }}</h4>
                                    <!-- Status Badge -->
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $barber->is_present ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $barber->is_present ? 'HADIR' : 'TIDAK HADIR' }}
                                    </span>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-sm text-gray-500 mr-2">{{ ucfirst($barber->level) }}</p>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">{{ $barber->formatted_rating }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Pengalaman: {{ $barber->experience }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Spesialisasi: {{ $barber->specialty }}
                            </div>
                            @if($barber->bio)
                            <div class="text-xs text-gray-500 mt-2">
                                {{ Str::limit($barber->bio, 80) }}
                            </div>
                            @endif
                        </div>
                        
                        <div class="grid grid-cols-3 gap-2">
                            <a href="{{ route('admin.barbers.edit', $barber->id) }}" 
                               class="bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full hover:bg-yellow-200 transition-colors text-center">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.barbers.toggle-presence', $barber->id) }}" 
                                  class="inline" onsubmit="return confirm('Yakin ingin mengubah status kehadiran {{ $barber->name }}?')">
                                @csrf
                                <button type="submit" 
                                        class="w-full {{ $barber->is_present ? 'bg-orange-100 text-orange-800 hover:bg-orange-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }} text-xs font-medium px-3 py-1 rounded-full transition-colors">
                                    Status Karyawan
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.barbers.destroy', $barber->id) }}" 
                                  class="inline" onsubmit="return confirm('Yakin ingin menghapus kapster ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-red-100 text-red-800 text-xs font-medium px-3 py-1 rounded-full hover:bg-red-200 transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 text-center py-8 text-gray-500">
                        Belum ada kapster. Tambahkan kapster pertama Anda!
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Barber Stats -->
<div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Kapster</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $barbers->count() }}</dd>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Kapster Aktif</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $barbers->where('is_active', true)->count() }}</dd>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Rating Rata-rata</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $barbers->count() > 0 ? number_format($barbers->avg('rating'), 1) : '0.0' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Booking Hari Ini</dt>
                        <dd class="text-lg font-medium text-gray-900">8</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let scheduleIndex = {{ isset($barber) && $barber->schedules->count() > 0 ? $barber->schedules->count() : 1 }};

function addScheduleRow() {
    const container = document.getElementById('schedule-container');
    const newRow = document.createElement('div');
    newRow.className = 'schedule-row flex gap-2 items-center';
    newRow.innerHTML = `
        <select name="schedules[${scheduleIndex}][day]" class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
            <option value="">Pilih Hari</option>
            @foreach(\App\Models\BarberSchedule::getDayOptions() as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
        <input type="time" name="schedules[${scheduleIndex}][start_time]" placeholder="Jam Mulai"
               class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
        <input type="time" name="schedules[${scheduleIndex}][end_time]" placeholder="Jam Selesai"
               class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
        <button type="button" onclick="removeScheduleRow(this)" class="text-red-600 hover:text-red-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    `;
    container.appendChild(newRow);
    scheduleIndex++;
}

function removeScheduleRow(button) {
    const container = document.getElementById('schedule-container');
    if (container.children.length > 1) {
        button.closest('.schedule-row').remove();
    }
}
</script>
@endsection