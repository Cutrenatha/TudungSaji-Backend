{{-- Asumsikan disimpan di resources/views/tudungsaji/myresep.blade.php atau resep/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ResepKu - Tudung Saji</title>
  <script src="https://cdn.tailwindcss.com"></script>
  {{-- Style untuk sticky footer, jika belum ada di layout utama --}}
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh; /* Minimal setinggi viewport */
    }
    .content-wrapper {
      flex-grow: 1; /* Konten akan tumbuh mengisi ruang */
    }
  </style>
</head>
<body class="bg-beige font-sans bg-[#ECE7D4]" style="font-family: 'Inter', sans-serif;">

  <!-- Header -->
  <header class="flex items-center justify-between px-6 py-4 border-b border-orange-300 bg-[#f4c988]">
    <div class="flex items-center space-x-2">
      <img src="{{ asset('logo.png') }}" alt="Tudung Saji" class="h-[7vh] w-[6vw]">
    </div>
    <h1 class="text-2xl font-bold">
      Resep<span class="text-orange-600">Ku</span>
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

  {{-- Wrapper untuk konten utama agar footer tetap di bawah --}}
  <main class="content-wrapper">
    <!-- Breadcrumb -->
    <nav class="px-6 py-3 mx-6 mt-4 flex items-center text-sm text-black space-x-2">
      <a href="{{ route('dashboard') }}" class="font-semibold hover:underline transition">Beranda</a>
      <span class="text-gray-400">›</span>
      <a href="{{ route('resep.index') }}" class="font-semibold hover:underline transition">ResepKu</a>
    </nav>

    {{-- Tampilkan pesan sukses --}}
    @if (session('success'))
      <div class="max-w-6xl mx-auto px-4 mt-4">
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
              <strong class="font-bold">Sukses!</strong>
              <span class="block sm:inline">{{ session('success') }}</span>
          </div>
      </div>
    @endif

    <!-- Judul & Deskripsi & Tombol Tambah (jika ada resep) -->
    <section class="max-w-6xl mx-auto px-4 py-4">
      <div class="text-center mb-4">
          <h2 class="text-2xl font-bold mb-2">ResepKu</h2>
          <p class="text-gray-600">Nikmati Kembali Masakan Mu!</p>
      </div>

      {{-- Tombol "+ Tambah Resep Baru" di kanan atas HANYA MUNCUL JIKA ADA RESEP --}}
      @if(isset($reseps) && !$reseps->isEmpty())
      <div class="flex justify-end mb-4">
          <a href="{{ route('resep.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded transition duration-150">
              + Tambah Resep Baru
          </a>
      </div>
      @endif
    </section>

    <!-- Grid Resep -->
    <section class="max-w-6xl mx-auto px-4 py-6">
      {{-- Memastikan $reseps terdefinisi sebelum digunakan --}}
      @if(!isset($reseps) || $reseps->isEmpty())
        <div class="text-center py-10">
          {{-- Pastikan path ilustrasi benar --}}
          <p class="text-xl text-gray-700 mb-2">Kamu belum punya resep nih.</p>
          <p class="text-gray-500 mb-6">Yuk, mulai bagikan kreasi masakanmu!</p>
          {{-- Tombol besar "Buat Resep Pertamamu" HANYA MUNCUL JIKA TIDAK ADA RESEP --}}
          @auth {{-- Pastikan user login untuk bisa buat resep --}}
          <a href="{{ route('resep.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded transition duration-150">
              Buat Resep Pertamamu
          </a>
          @endauth
        </div>
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
          @foreach($reseps as $resep)
          <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
            <a href="{{ route('resep.show.public', $resep->id) }}"> {{-- Sesuaikan jika punya route detail resepku sendiri --}}
              @if($resep->gambar)
                <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->judul }}" class="w-full h-48 object-cover">
              @endif
            </a>
            <div class="p-4 flex flex-col flex-grow">
              <h3 class="font-bold text-lg mb-2 truncate" title="{{ $resep->judul }}">{{ $resep->judul }}</h3>
              <p class="text-gray-600 text-sm mb-1">Porsi: {{ $resep->porsi }}</p>
              <p class="text-gray-600 text-sm mb-3">Waktu: {{ $resep->lama_memasak }}</p>

              <div class="mt-auto flex justify-between items-center">
                <a href="{{ route('resep.edit', $resep->id) }}" class="text-sm bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-150">
                  Edit
                </a>
                <form action="{{ route('resep.destroy', $resep->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus resep ini?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-sm bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded transition duration-150">
                    Hapus
                  </button>
                </form>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      @endif
    </section>
  </main> {{-- Akhir dari .content-wrapper --}}

 <!-- Footer (Sama seperti sebelumnya) -->
 <footer class="bg-[#f2e9db] border-t border-gray-300 pt-10 pb-6 relative overflow-hidden mt-12">
  <img src="{{ asset('rempahfoter1.png') }}" alt="Spices Left" class="absolute left-0 bottom-0 h-full object-cover opacity-80 hidden md:block" />
  <img src="{{ asset('rempatfot2.png') }}" alt="Spices Right" class="absolute right-0 bottom-0 h-full object-cover opacity-80 hidden md:block" />
  <div class="relative z-10 container mx-auto px-4 flex flex-col items-center text-center text-black space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
      <div>
        <h3 class="font-bold mb-2">Menu</h3>
        <ul class="space-y-1">
          <li><a href="{{ route('beranda') }}" class="hover:underline">Beranda</a></li>
          <li><a href="{{ route('tipsmasak') }}" class="hover:underline">Tips Masak</a></li>
          <li><a href="#" class="hover:underline">Tentang Kita</a></li>
          <li><a href="{{ route('favorit.index') }}" class="hover:underline">Favorit</a></li> {{-- Pastikan nama route benar --}}
          <li><a href="{{ route('resepmasakan') }}" class="hover:underline">Resep</a></li>
        </ul>
      </div>
      <div>
        <h3 class="font-bold mb-2">Kontak</h3>
        <ul class="space-y-1">
          <li><a href="#" class="hover:underline">Tentang Kami</a></li>
          <li><a href="#" class="hover:underline">Chat Langsung</a></li>
        </ul>
      </div>
      <div>
        <h3 class="font-bold mb-2">Hubungi Kami</h3>
        <div class="flex justify-center space-x-4 mt-2">
          <a href="#" class="hover:scale-110 transition">
            <svg fill="url(#igGradientMyResep)" viewBox="0 0 24 24" class="w-8 h-8"> {{-- Pastikan ID gradient unik jika perlu --}}
              <defs>
                <linearGradient id="igGradientMyResep" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#feda75" />
                  <stop offset="50%" stop-color="#d62976" />
                  <stop offset="100%" stop-color="#4f5bd5" />
                </linearGradient>
              </defs>
              <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2a3 3 0 013 3v10a3 3 0 01-3 3H7a3 3 0 01-3-3V7a3 3 0 013-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-1.25a1.25 1.25 0 11-2.5 0 1.25 1.25 0 012.5 0z"/>
            </svg>
          </a>
          {{-- Icon lainnya --}}
        </div>
      </div>
    </div>
    <div class="text-sm text-black font-medium pt-4">
      @2025 Tudung <span class="text-orange-500 font-semibold">Saji</span> All Rights Reserved
    </div>
  </div>
</footer>

</body>
</html>