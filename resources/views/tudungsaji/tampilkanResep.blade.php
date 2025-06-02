<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $resep->judul }} - Resep Masakan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Anda bisa menambahkan style kustom di sini jika Inter tidak termuat sempurna dari CDN Tailwind */
    body {
        font-family: 'Inter', sans-serif; /* Pastikan font Inter tersedia */
    }
  </style>
</head>
<body class="bg-[#f7f1df] font-inter text-[#1f1f1f]">
  <!-- Header -->
  <header class="flex items-center justify-between px-6 py-4 border-b border-orange-300 bg-[#f4c988]">
    <div class="flex items-center space-x-2">
      <a href="{{ route('beranda') }}"> {{-- Tambahkan link ke beranda jika logo bisa diklik --}}
        <img src="{{ asset('logo.png') }}" alt="Tudung Saji" class="h-[7vh] w-auto min-w-[50px]"> {{-- Ubah w-[6vw] menjadi w-auto dan tambahkan min-w untuk responsivitas --}}
      </a>
    </div>
    <h1 class="text-xl md:text-2xl font-bold text-center flex-grow"> {{-- Tambah text-center dan flex-grow --}}
      Resep <span class="text-orange-600">{{ Str::limit($resep->judul, 30) }}</span> {{-- Batasi panjang judul --}}
    </h1>
    <div class="flex items-center space-x-3"> {{-- Ubah space-x-2 menjadi space-x-3 --}}
      @auth
        <a href="{{ route('profile.edit') }}" class="hidden sm:block text-sm font-medium hover:text-orange-600"> {{-- Tampilkan di layar sm ke atas --}}
          {{ Auth::user()->first_name }}
        </a>
        <a href="{{ route('profile.edit') }}"
           class="w-9 h-9 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold hover:scale-105 transition duration-200 shadow-md">
          {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
        </a>
      @else
        <a href="{{ route('login.form') }}" class="text-sm font-semibold hover:text-orange-600">Login</a>
      @endauth
    </div>
  </header>

  <!-- Breadcrumb -->
  <nav class="px-6 py-3 mx-auto max-w-6xl mt-4 flex items-center text-sm text-black space-x-2"> {{-- Tambah mx-auto max-w-6xl --}}
    <a href="{{ route('dashboard') }}" class="font-semibold hover:underline transition">Beranda</a>
    <span class="text-gray-400">›</span>
    <a href="{{ route('resepmasakan') }}" class="font-semibold hover:underline transition">Resep Masakan</a>
    <span class="text-gray-400">›</span>
    <span class="font-semibold text-gray-700">{{ Str::limit($resep->judul, 40) }}</span> {{-- Batasi panjang judul di breadcrumb --}}
  </nav>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 px-6 py-6"> {{-- Ubah gap-4 menjadi gap-6, responsive grid --}}
    <!-- Sidebar / Left Column -->
    <aside class="col-span-1 md:border-r md:border-gray-300 md:pr-6">
      @if($resep->gambar)
        <img src="{{ Storage::url($resep->gambar) }}" alt="Foto Resep {{ $resep->judul }}" class="rounded-lg mb-6 w-full h-64 object-cover shadow-md" />
      @else
        <img src="{{ asset('placeholder-resep.png') }}" alt="Tidak ada gambar" class="rounded-lg mb-6 w-full h-64 object-cover shadow-md" /> {{-- Gambar placeholder --}}
      @endif

      <h3 class="text-lg font-semibold text-gray-800 mb-3">Bahan-bahan:</h3>
      <p class="text-sm text-gray-700 mb-2">
        Porsi: <span class="font-semibold text-gray-900">{{ $resep->porsi ?? '-' }}</span>
      </p>

      {{-- Pastikan nama properti adalah 'bahan_bahan' dan merupakan array --}}
      @if(!empty($resep->bahan_bahan) && is_array($resep->bahan_bahan))
        <ul class="list-disc list-inside text-sm text-gray-700 space-y-1 pl-1">
          @foreach ($resep->bahan_bahan as $bahan_item)
            @if(trim($bahan_item) !== '') {{-- Hindari menampilkan list item kosong --}}
              <li>{{ trim($bahan_item) }}</li>
            @endif
          @endforeach
        </ul>
      @else
        <p class="text-sm text-gray-500">Bahan-bahan tidak tersedia.</p>
      @endif
    </aside>

    <!-- Recipe Detail -->
    <section class="col-span-1 md:col-span-3 md:px-4">
      <h2 class="text-2xl font-bold mb-1 text-gray-900">{{ $resep->judul }}</h2>
      <p class="text-sm text-gray-600 mb-4">
        Oleh: <span class="font-medium">{{ $resep->user ? ($resep->user->first_name . ' ' . $resep->user->last_name) : 'Tim Tudung Saji' }}</span>
      </p>

      @if($resep->deskripsi)
      <p class="text-sm text-gray-700 text-justify leading-relaxed mb-6">
        {{ $resep->deskripsi }}
      </p>
      @endif

      <div class="mb-6">
        <p class="text-sm text-gray-700 mb-2">
            <strong>Lama Memasak:</strong>
            <span class="font-semibold text-gray-900">{{ $resep->lama_memasak ?? '-' }}</span>
        </p>
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Langkah-langkah:</h3>
      </div>

      <!-- Steps -->
      <div class="space-y-4">
        {{-- Pastikan nama properti adalah 'langkah_memasak' dan merupakan array --}}
        @if(!empty($resep->langkah_memasak) && is_array($resep->langkah_memasak))
            @foreach ($resep->langkah_memasak as $index => $langkah_item)
              @if(trim($langkah_item) !== '') {{-- Hindari menampilkan list item kosong --}}
                <div class="flex items-start space-x-3 p-3 border rounded-md bg-white shadow-sm">
                  <span class="flex-shrink-0 h-6 w-6 bg-orange-500 text-white text-sm font-semibold rounded-full flex items-center justify-center">{{ $index + 1 }}</span>
                  <p class="text-sm text-gray-700 leading-relaxed">{{ trim($langkah_item) }}</p>
                </div>
              @endif
            @endforeach
        @else
            <p class="text-sm text-gray-500">Langkah-langkah tidak tersedia.</p>
        @endif
      </div>
    </section>
  </main>

  <!-- Footer (Opsional, bisa ditambahkan jika perlu) -->
  {{-- @include('partials.footer') --}}

</body>
</html>