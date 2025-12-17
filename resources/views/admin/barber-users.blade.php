@extends('layouts.admin')

@section('title', 'Kelola Akun Kapster')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Akun Kapster</h1>
            <p class="text-gray-600">Buat dan kelola akun login untuk kapster</p>
        </div>
        <button onclick="openCreateModal()" 
                class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-2 rounded-lg font-semibold transition-colors">
            + Buat Akun Kapster
        </button>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-700">Total Akun</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $barberUsers->count() }}</p>
                </div>
                <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-2.25"></path>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-700">Akun Aktif</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $barberUsers->where('is_active', true)->count() }}</p>
                </div>
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-700">Kapster Tersedia</h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ $availableBarbers->count() }}</p>
                </div>
                <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Barber Users Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Daftar Akun Kapster</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapster</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($barberUsers as $barberUser)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($barberUser->barber->photo)
                                        <img src="{{ asset('image/' . $barberUser->barber->photo) }}" alt="{{ $barberUser->barber->name }}" class="w-10 h-10 rounded-full object-cover mr-3" 
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <!-- Fallback when image fails to load -->
                                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3" style="display: none;">
                                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $barberUser->barber->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $barberUser->barber->level_display }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $barberUser->username }}</div>
                                <div class="text-sm text-gray-500">{{ $barberUser->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $barberUser->email }}</div>
                                @if($barberUser->phone)
                                    <div class="text-sm text-gray-500">{{ $barberUser->phone }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($barberUser->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $barberUser->formatted_last_login }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button onclick="editBarberUser({{ $barberUser->id }})" 
                                        class="text-blue-600 hover:text-blue-900 transition-colors">Edit</button>
                                <button onclick="resetPassword({{ $barberUser->id }}, '{{ $barberUser->username }}')" 
                                        class="text-yellow-600 hover:text-yellow-900 transition-colors">Reset Password</button>
                                <button onclick="deleteBarberUser({{ $barberUser->id }}, '{{ $barberUser->username }}')" 
                                        class="text-red-600 hover:text-red-900 transition-colors">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Belum ada akun kapster yang dibuat
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="barberUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Buat Akun Kapster</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="barberUserForm" method="POST">
                @csrf
                <div id="methodField"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="barber_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kapster *</label>
                        <select id="barber_id" name="barber_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <option value="">Pilih Kapster</option>
                            @foreach($availableBarbers as $barber)
                                <option value="{{ $barber->id }}">{{ $barber->name }} ({{ $barber->level_display }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username *</label>
                        <input type="text" id="username" name="username" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                        <input type="text" id="name" name="name" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" id="email" name="email" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                        <input type="password" id="password" name="password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <p class="text-xs text-gray-500 mt-1" id="passwordHelp">Minimal 6 karakter</p>
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                </div>
                
                <div class="mt-4" id="statusField" style="display: none;">
                    <label class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" class="rounded border-gray-300 text-yellow-600 shadow-sm focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Akun Aktif</span>
                    </label>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal()" 
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-black rounded-md transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let isEditMode = false;
let editId = null;

function openCreateModal() {
    isEditMode = false;
    editId = null;
    document.getElementById('modalTitle').textContent = 'Buat Akun Kapster';
    document.getElementById('barberUserForm').action = '{{ route("admin.barber-users.store") }}';
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('passwordHelp').textContent = 'Minimal 6 karakter';
    document.getElementById('password').required = true;
    document.getElementById('statusField').style.display = 'none';
    
    // Reset form
    document.getElementById('barberUserForm').reset();
    
    document.getElementById('barberUserModal').classList.remove('hidden');
}

async function editBarberUser(id) {
    try {
        const response = await fetch(`/admin/barber-users/${id}/edit`);
        if (response.ok) {
            window.location.href = `/admin/barber-users/${id}/edit`;
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengambil data');
    }
}

async function resetPassword(id, username) {
    const newPassword = prompt(`Reset password untuk kapster "${username}".\nMasukkan password baru (minimal 6 karakter):`);
    
    if (newPassword && newPassword.length >= 6) {
        try {
            const response = await fetch(`/admin/barber-users/${id}/reset-password`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    password: newPassword
                })
            });
            
            const result = await response.json();
            
            if (response.ok) {
                alert(`Password berhasil direset!\nUsername: ${username}\nPassword baru: ${newPassword}`);
            } else {
                alert(result.message || 'Gagal reset password');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat reset password');
        }
    } else if (newPassword !== null) {
        alert('Password harus minimal 6 karakter');
    }
}

async function deleteBarberUser(id, username) {
    if (confirm(`Apakah Anda yakin ingin menghapus akun kapster "${username}"?`)) {
        try {
            const response = await fetch(`/admin/barber-users/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            if (response.ok) {
                location.reload();
            } else {
                alert('Gagal menghapus akun kapster');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus akun');
        }
    }
}

function closeModal() {
    document.getElementById('barberUserModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('barberUserModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection