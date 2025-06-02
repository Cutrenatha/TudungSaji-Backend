<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ isset($resep) ? 'Edit Resep' : 'Tambah Resep' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f4ebd6] font-sans">

<!-- Header -->
<header class="flex items-center justify-between px-6 py-4 border-b border-orange-300 bg-[#f4c988]">
  <div class="flex items-center space-x-2">
    <img src="{{ asset('logo.png') }}" alt="Tudung Saji" class="h-[7vh] w-[6vw]" />
  </div>
  <h1 class="text-2xl font-bold">
    {{ isset($resep) ? 'Edit' : 'Tambah' }} <span class="text-orange-600">Resep</span>
  </h1>
  <div class="flex items-center space-x-2">
    <div class="flex items-center space-x-3">
      @auth
      <a href="{{ route('profile.edit') }}" class="hover:underline">
        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
      </a>
      <a href="{{ route('profile.edit') }}"
         class="w-9 h-9 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold hover:scale-105 transition duration-200 shadow-md">
        {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
      </a>
      @endauth
    </div>
  </div>
</header>

<!-- Breadcrumb -->
<nav class="px-6 py-3 mx-6 mt-4 flex items-center text-sm text-black space-x-2">
  <a href="{{ route('dashboard') }}" class="font-semibold hover:underline transition">Beranda</a>
  <span class="text-gray-400">›</span>
  <a href="{{ isset($resep) ? route('resep.edit', $resep->id) : route('resep.create') }}" class="font-semibold hover:underline transition">{{ isset($resep) ? 'Edit Resep' : 'Tambah Resep' }}</a>
</nav>

{{-- Tampilkan error validasi --}}
@if ($errors->any())
    <div class="px-8 mt-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Oops! Ada kesalahan:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

{{-- Tampilkan pesan sukses --}}
@if (session('success'))
    <div class="px-8 mt-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
@endif


<!-- Form tambah resep -->
<form action="{{ isset($resep) ? route('resep.update', $resep->id) : route('resep.store') }}" method="POST" enctype="multipart/form-data" class="px-8 pb-8 mt-4">
  @csrf
  @if(isset($resep))
    @method('PUT')
  @endif

  {{-- Wrapper untuk Kolom Kiri dan Kanan agar bersebelahan --}}
  <div class="flex flex-col md:flex-row gap-5 mb-6"> {{-- mb-6 untuk memberi jarak ke tombol aksi --}}

    <!-- Kolom Kiri -->
    <div class="w-full md:w-1/3 bg-white rounded-xl p-5 shadow-md">
      {{-- Konten Kolom Kiri --}}
      <div class="text-center p-5 border-2 border-dashed border-gray-300 rounded-lg text-gray-500 text-sm mb-5">
        <label for="gambar" class="cursor-pointer block font-bold">
          📷<br>Foto Resep<br><small class="font-normal">Tambahkan Foto Akhir Masakan</small>
        </label>
        <input type="file" id="gambar" name="gambar" class="hidden" onchange="previewImage(event)" />
        <img id="gambar-preview" src="{{ isset($resep) && $resep->gambar ? asset('storage/' . $resep->gambar) : '#' }}" alt="Preview Gambar Resep" class="w-40 mt-4 mx-auto rounded {{ isset($resep) && $resep->gambar ? '' : 'hidden' }}">
      </div>

      <label for="porsi" class="block mb-1 font-bold">Porsi</label>
      <input type="text" id="porsi" name="porsi" value="{{ old('porsi', $resep->porsi ?? '') }}" placeholder="Contoh: 2 Orang" class="w-full p-2 mb-4 border border-gray-300 rounded-md"  />

      <label class="block mb-1 font-bold">Bahan-bahan:</label>
      <div id="bahan-list">
        @php
          $bahanList = old('bahan_bahan', (isset($resep) && is_array($resep->bahan_bahan)) ? $resep->bahan_bahan : ['']);
        @endphp
        @foreach($bahanList as $index => $bahan)
          <div class="flex items-center gap-2 mb-2 bahan-item">
            <span class="cursor-move">☰</span>
            <input type="text" name="bahan_bahan[]" value="{{ $bahan }}" placeholder="Tulis bahan..." class="flex-1 p-2 border border-gray-300 rounded-md"  />
            @if($index > 0 || count($bahanList) > 1)
              <button type="button" class="text-red-500 hover:text-red-700" onclick="hapusItem(this, 'bahan-item')">X</button>
            @endif
          </div>
        @endforeach
      </div>
      <button type="button" class="text-blue-600 hover:text-blue-800 text-sm mt-2 font-semibold" onclick="tambahBahan()">+ Bahan</button>
    </div>

    <!-- Kolom Kanan -->
    <div class="w-full md:w-2/3 bg-white rounded-xl p-5 shadow-md">
      {{-- Konten Kolom Kanan --}}
      <label for="judul" class="block mb-1 font-bold">Judul</label>
      <input type="text" id="judul" name="judul" value="{{ old('judul', $resep->judul ?? '') }}" placeholder="Judul Resep" class="w-full p-2 mb-4 border border-gray-300 rounded-md"  />

      <label for="deskripsi" class="block mb-1 font-bold">Deskripsi</label>
      <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi Resep" class="w-full p-2 mb-4 border border-gray-300 rounded-md">{{ old('deskripsi', $resep->deskripsi ?? '') }}</textarea>

      <label for="lamaMemasak" class="block mb-1 font-bold">Lama Memasak</label>
      <input type="text" id="lamaMemasak" name="lamaMemasak" value="{{ old('lamaMemasak', $resep->lama_memasak ?? '') }}" placeholder="Contoh: 30 Menit" class="w-full p-2 mb-4 border border-gray-300 rounded-md"  />

      <label class="block mb-1 font-bold">Langkah:</label>
      <div id="langkah-list">
        @php
          $langkahList = old('langkah_memasak', (isset($resep) && is_array($resep->langkah_memasak)) ? $resep->langkah_memasak : ['']);
        @endphp
        @foreach($langkahList as $indexLangkah => $langkah)
          <div class="flex items-center gap-2 mb-3 langkah-item">
            <span class="cursor-move">☰</span>
            <input type="text" name="langkah_memasak[]" value="{{ $langkah }}" placeholder="Tulis langkah..." class="flex-1 p-2 border border-gray-300 rounded-md"  />
             @if($indexLangkah > 0 || count($langkahList) > 1)
              <button type="button" class="text-red-500 hover:text-red-700" onclick="hapusItem(this, 'langkah-item')">X</button>
            @endif
          </div>
        @endforeach
      </div>
      <button type="button" class="text-blue-600 hover:text-blue-800 text-sm mt-2 font-semibold" onclick="tambahLangkah()">+ Langkah</button>
    </div>
  </div> {{-- Akhir dari div wrapper untuk kolom Kiri dan Kanan --}}

  <!-- Tombol Aksi (Di bawah kontainer form) -->
  <div class="w-full flex justify-end gap-3">
    @if(isset($resep))
        <button type="button" onclick="confirmDelete()" class="px-4 py-2 bg-[#fce2e0] text-[#b5332e] rounded-md font-bold hover:bg-red-200 transition duration-150">Hapus Resep</button>
    @else
        <button type="reset" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-bold hover:bg-gray-300 transition duration-150">Reset</button>
    @endif
    <button type="submit" class="px-4 py-2 bg-[#b5332e] text-white rounded-md font-bold hover:bg-red-700 transition duration-150">
      {{ isset($resep) ? 'Update & Terbitkan' : 'Terbitkan' }}
    </button>
  </div>
</form>

{{-- Form untuk hapus resep (jika tombol hapus di atas ditekan) --}}
@if(isset($resep))
<form id="delete-resep-form" action="{{ route('resep.destroy', $resep->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endif

<script>
  function previewImage(event) {
    const reader = new FileReader();
    const imagePreview = document.getElementById('gambar-preview');
    reader.onload = function(){
      imagePreview.src = reader.result;
      imagePreview.classList.remove('hidden');
    }
    if (event.target.files[0]) {
      reader.readAsDataURL(event.target.files[0]);
    } else {
      imagePreview.src = "#";
      imagePreview.classList.add('hidden');
    }
  }

  function tambahBahan() {
    const div = document.createElement('div');
    div.className = 'flex items-center gap-2 mb-2 bahan-item';
    div.innerHTML = `
      <span class="cursor-move">☰</span>
      <input type="text" name="bahan_bahan[]" placeholder="Tulis bahan..." class="flex-1 p-2 border border-gray-300 rounded-md" required>
      <button type="button" class="text-red-500 hover:text-red-700" onclick="hapusItem(this, 'bahan-item')">X</button>
    `;
    document.getElementById('bahan-list').appendChild(div);
  }

  function tambahLangkah() {
    const div = document.createElement('div');
    div.className = 'flex items-center gap-2 mb-3 langkah-item';
    div.innerHTML = `
      <span class="cursor-move">☰</span>
      <input type="text" name="langkah_memasak[]" placeholder="Tulis langkah..." class="flex-1 p-2 border border-gray-300 rounded-md" required>
      <button type="button" class="text-red-500 hover:text-red-700" onclick="hapusItem(this, 'langkah-item')">X</button>
    `;
    document.getElementById('langkah-list').appendChild(div);
  }

  function hapusItem(button, itemClass) {
    const itemList = document.getElementById(itemClass === 'bahan-item' ? 'bahan-list' : 'langkah-list');
    if (itemList.getElementsByClassName(itemClass).length > 1) {
        button.closest('.' + itemClass).remove();
    } else {
        const input = button.closest('.' + itemClass).querySelector('input[type="text"]');
        if (input) {
            input.value = '';
        }
    }
  }

  function confirmDelete() {
      if (confirm("Apakah Anda yakin ingin menghapus resep ini?")) {
          document.getElementById('delete-resep-form').submit();
      }
  }

  document.addEventListener('DOMContentLoaded', function() {
    const bahanList = document.getElementById('bahan-list');
    if (bahanList.children.length === 0) {
        tambahBahan();
    }
    const langkahList = document.getElementById('langkah-list');
    if (langkahList.children.length === 0) {
        tambahLangkah();
    }
  });
</script>

</body>
</html>