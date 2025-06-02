<!DOCTYPE html>
<html lang="id"> {{-- Mengganti lang ke "id" --}}
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Profil - Tudung Saji</title> {{-- Menambahkan nama aplikasi ke title --}}
  <script src="https://cdn.tailwindcss.com"></script>
  {{-- Font Awesome dari CDN --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  {{-- Menghapus script Font Awesome yang lama karena sudah diganti link CSS --}}
</head>
<body class="bg-gray-50 min-h-screen flex items-stretch">

  <!-- Tombol Kembali -->
  {{-- Pastikan route 'dashboard' sudah benar --}}
  <a href="{{ route('dashboard') }}" class="absolute top-6 left-8 z-10 text-gray-600 hover:text-orange-500 font-medium text-xl">← Kembali</a>

  <!-- Sidebar -->
  <aside class="w-1/4 bg-white shadow-lg p-6 pt-10 flex flex-col items-center rounded-r-3xl">
    {{-- Gunakan asset helper untuk gambar profil jika ada di public, atau path dari storage jika diupload --}}
    <img src="{{ $user->profile_image ? Storage::url($user->profile_image) : asset('profil2.jpg') }}" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover mb-4" />
    <h2 class="text-lg font-bold">{{ $user->first_name }} {{ $user->last_name }}</h2>
    <nav class="w-full space-y-4 mt-6">
      <button class="w-full text-left px-4 py-2 rounded-full bg-orange-100 text-orange-600 font-medium cursor-default">
        <i class="fas fa-user mr-2"></i>Informasi Pribadi
      </button>
      <button onclick="showLogoutPopup()" class="w-full text-left px-4 py-2 rounded-full hover:bg-gray-100">
        <i class="fas fa-sign-out-alt mr-2"></i>Keluar
      </button>

      <!-- Popup Logout -->
      <div id="logoutPopup" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-30 backdrop-blur-sm z-50">
        <div class="bg-white p-6 rounded-xl shadow-xl text-center w-[90%] max-w-sm">
          <h3 class="text-lg font-semibold mb-4">Apakah kamu yakin ingin keluar?</h3>
          <div class="flex justify-center space-x-4">
            {{-- Pastikan route 'logout' sudah benar --}}
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600">Ya</button>
            </form>
            <button onclick="hideLogoutPopup()" class="border border-orange-500 text-orange-500 px-4 py-2 rounded-full hover:bg-orange-50">Tidak</button>
          </div>
        </div>
      </div>
    </nav>
  </aside>

  <!-- Main content -->
  <main class="flex-grow flex items-center justify-center p-10">
    <div class="bg-white rounded-3xl shadow-md p-10 w-full max-w-3xl">
      <h2 class="text-2xl font-bold mb-6">Data Diri</h2>

      <!-- Pesan sukses -->
      @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
      @endif

      <!-- Pesan error validasi -->
      @if($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Oops!</strong>
        <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
        <ul class="list-disc list-inside mt-2">
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      {{-- Pastikan route 'profile.update' sudah benar dan form menggunakan method PUT --}}
      <form action="{{ route('profile.update') }}" method="POST" novalidate>
        @csrf
        @method('PUT') {{-- Ini penting untuk route PUT --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> {{-- Menyesuaikan grid untuk responsif --}}
          <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Pertama <span class="text-red-500">*</span></label>
            <input type="text" id="first_name" name="first_name" required
              class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400"
              value="{{ old('first_name', $user->first_name) }}">
            @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>
          <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Terakhir <span class="text-red-500">*</span></label>
            <input type="text" id="last_name" name="last_name" required
              class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400"
              value="{{ old('last_name', $user->last_name) }}">
            @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>

          <div class="md:col-span-2"> {{-- Menyesuaikan grid untuk responsif --}}
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" required
              class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400"
              value="{{ old('email', $user->email) }}">
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>

          <div class="md:col-span-2">
            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
            <input type="text" id="alamat" name="alamat"
              class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400"
              value="{{ old('alamat', $user->alamat) }}">
            @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
            <input type="text" id="telepon" name="telepon"
              class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400"
              value="{{ old('telepon', $user->telepon) }}">
            @error('telepon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
            {{-- Menggunakan null-safe operator dan format() jika tanggal_lahir adalah objek Carbon --}}
            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
              class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400"
              value="{{ old('tanggal_lahir', $user->tanggal_lahir ? ($user->tanggal_lahir instanceof \Carbon\Carbon ? $user->tanggal_lahir->format('Y-m-d') : $user->tanggal_lahir) : '') }}">
            @error('tanggal_lahir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
            <input type="text" id="lokasi" name="lokasi"
              class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400"
              value="{{ old('lokasi', $user->lokasi) }}">
            @error('lokasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="kode_pos" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
            <input type="text" id="kode_pos" name="kode_pos"
              class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400"
              value="{{ old('kode_pos', $user->kode_pos) }}">
            @error('kode_pos') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="flex justify-end mt-10 space-x-4">
          <button type="reset"
            class="border border-orange-500 text-orange-500 px-6 py-2 rounded-full hover:bg-orange-100 transition duration-150">Buang Perubahan</button>
          <button type="submit"
            class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600 transition duration-150">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </main>

  <script>
    function showLogoutPopup() {
      const popup = document.getElementById('logoutPopup');
      if (popup) {
        popup.classList.remove('hidden');
        popup.classList.add('flex');
      }
    }

    function hideLogoutPopup() {
      const popup = document.getElementById('logoutPopup');
      if (popup) {
        popup.classList.add('hidden');
        popup.classList.remove('flex');
      }
    }
  </script>
</body>
</html>