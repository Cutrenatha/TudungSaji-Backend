<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resep Masakan - Tudung Saji</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh; /* Minimal setinggi viewport */
      font-family: 'Inter', sans-serif; /* Pastikan font Inter diterapkan */
    }
    .content-wrapper {
      flex-grow: 1; /* Konten akan tumbuh mengisi ruang */
    }
  </style>
</head>
<body class="bg-[#ECE7D4]"> {{-- Menggunakan bg-beige dari kode pertama --}}

  <!-- Navbar (Diambil dari kode HTML Beranda) -->
  <nav class="p-4 flex justify-between items-center" style="background-color: #f6ca89;">
    <div class="flex items-center space-x-4">
      <img src="{{ asset('logo.png') }}" alt="Tudung Saji" class="h-[7vh] w-[6vw] ">
    </div>

    <div class="flex space-x-6">
      <a href="{{ route('dashboard') }}" class="text-black font-semibold hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200">Beranda</a>
      <a href="{{ route('resepmasakan') }}" class="text-black font-medium hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200
        {{ request()->routeIs('resepmasakan') ? 'text-orange-600 underline font-semibold' : '' }}
      ">Resep Masakan</a>
      <a href="{{ route('tipsmasak') }}" class="text-black font-medium hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200">Tips Masak</a>
      <a href="{{ route('favorit.index') }}" class="text-black font-medium hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200">Favorit</a>
    </div>

    <div class="flex items-center space-x-3">
      @auth
        <a href="{{ route('profile.edit') }}" class="text-black hover:text-orange-700 transition-colors">
          {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        </a>
        <a href="{{ route('profile.edit') }}"
           class="w-9 h-9 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold hover:scale-105 transition duration-200 shadow-md">
          {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
        </a>
      @else
        <a href="{{ route('login.form') }}" class="text-black font-medium hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200">Login</a>
        <a href="{{ route('register.form') }}" class="text-black font-medium hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200">Register</a>
      @endguest
    </div>
  </nav>

  {{-- Wrapper untuk konten utama --}}
  <div class="content-wrapper">
    <!-- Breadcrumb -->
    <nav class="px-6 py-3 mx-6 mt-4 flex items-center text-sm text-black space-x-2">
      <a href="{{ route('dashboard') }}" class="font-semibold hover:underline transition"></a>
      <span class="text-gray-400"></span>
      <a href="{{ route('resepmasakan') }}" class="font-semibold hover:underline transition"></a>
    </nav>

    <!-- Judul & Deskripsi -->
    <section class="max-w-6xl mx-auto px-4 py-4 text-center">
      <h2 class="text-2xl font-bold mb-2">
        Resep <span class="text-orange-600">Masakan</span>
      </h2>
      <p class="text-gray-600">Temukan berbagai resep masakan lezat dan praktis untuk setiap kesempatan.
          Dari hidangan tradisional Indonesia hingga kreasi modern yang menggugah selera, semua resep disajikan lengkap dengan langkah-langkah mudah dan bahan yang mudah didapat.
          Cocok untuk pemula hingga koki rumahan!</p>
    </section>

    @if (session('status'))
        <div class="max-w-6xl mx-auto px-4 py-2 mb-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

    <!-- Grid Resep (Clickable) -->
    <section class="max-w-6xl mx-auto px-4 py-6 mb-10">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">

      @if(isset($reseps) && $reseps->isEmpty())
          <p class="col-span-full text-center text-gray-500">Belum ada resep yang tersedia.</p>
      @elseif(isset($reseps))
          @foreach($reseps as $resep)
          <div class="block bg-white rounded-xl p-3 shadow hover:shadow-lg relative transition-transform duration-200 hover:scale-105 active:scale-95">
            <a href="{{ route('resep.show.public', $resep->id) }}">
              <img src="{{ $resep->gambar ? Storage::url($resep->gambar) : asset('placeholder-resep.png') }}" alt="{{ $resep->judul }}" class="rounded-lg w-full h-40 object-cover mb-3" />
            </a>
            <div class="absolute top-4 right-4 flex space-x-2 z-10">
              @auth
              <form method="POST" action="{{ route('favorit.toggle', $resep->id) }}">
                  @csrf
                  <button type="submit" class="p-1.5 rounded-full bg-white/70 hover:bg-white shadow-sm transition-colors duration-200" title="{{ Auth::user()->hasFavorited($resep) ? 'Hapus dari favorit' : 'Tambah ke favorit' }}">
                      @if(Auth::user()->hasFavorited($resep))
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-500">
                          <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                      </svg>
                      @else
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500 hover:text-red-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                      </svg>
                      @endif
                  </button>
              </form>
              @endauth
            </div>
            <a href="{{ route('resep.show.public', $resep->id) }}">
              <h3 class="text-sm font-semibold mb-1 leading-snug">{{ $resep->judul }}</h3>
              <p class="text-xs text-gray-700">Oleh {{ $resep->user ? $resep->user->first_name . ' ' . $resep->user->last_name : 'Anonim' }}</p>
            </a>
          </div>
          @endforeach
      @else
          <p class="col-span-full text-center text-gray-500">Data resep tidak tersedia.</p>
      @endif
      </div>
    </section>
  </div> {{-- Akhir dari .content-wrapper --}}

 <!-- Footer -->
 <footer class="bg-[#f2e9db] border-t border-gray-300 pt-10 pb-6 relative overflow-hidden">
  <img src="{{ asset('rempahfoter1.png') }}" alt="Spices Left" class="absolute left-0 bottom-0 h-full object-cover opacity-80 hidden md:block" />
  <img src="{{ asset('rempatfot2.png') }}" alt="Spices Right" class="absolute right-0 bottom-0 h-full object-cover opacity-80 hidden md:block" />
  <div class="relative z-10 container mx-auto px-4 flex flex-col items-center text-center text-black space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
      <div>
        <h3 class="font-bold mb-2">Menu</h3>
        <ul class="space-y-1">
          <li><a href="{{ route('dashboard') }}" class="hover:underline">Beranda</a></li>
          <li><a href="{{ route('tipsmasak') }}" class="hover:underline">Tips Masak</a></li>
          <li><a href="#" class="hover:underline">Tentang Kita</a></li>
          <li><a href="{{ route('favorit.index') }}" class="hover:underline">Favorit</a></li>
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
            <svg fill="url(#igGradientFooterGeneral)" viewBox="0 0 24 24" class="w-8 h-8"> {{-- Menggunakan ID general --}}
              <defs>
                <linearGradient id="igGradientFooterGeneral" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#feda75" />
                  <stop offset="50%" stop-color="#d62976" />
                  <stop offset="100%" stop-color="#4f5bd5" />
                </linearGradient>
              </defs>
              <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2a3 3 0 013 3v10a3 3 0 01-3 3H7a3 3 0 01-3-3V7a3 3 0 013-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-1.25a1.25 1.25 0 11-2.5 0 1.25 1.25 0 012.5 0z"/>
            </svg>
          </a>
          <a href="#" class="hover:scale-110 transition">
            <svg fill="#FF0000" viewBox="0 0 24 24" class="w-8 h-8">
              <path d="M23.498 6.186a2.898 2.898 0 00-2.04-2.04C19.768 3.5 12 3.5 12 3.5s-7.768 0-9.458.646a2.898 2.898 0 00-2.04 2.04A30.187 30.187 0 000 12a30.187 30.187 0 00.502 5.814 2.898 2.898 0 002.04 2.04C4.232 20.5 12 20.5 12 20.5s7.768 0 9.458-.646a2.898 2.898 0 002.04-2.04A30.187 30.187 0 0024 12a30.187 30.187 0 00-.502-5.814zM9.75 15.02V8.98L15.5 12l-5.75 3.02z"/>
            </svg>
          </a>
          <a href="#" class="hover:scale-110 transition">
            <svg fill="#25D366" viewBox="0 0 24 24" class="w-8 h-8">
              <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.62-6.003C.122 5.312 5.388 0 12.061 0c3.179 0 6.167 1.237 8.413 3.488a11.78 11.78 0 013.48 8.404c-.003 6.673-5.376 12.093-12.05 12.093a12.42 12.42 0 01-5.594-1.357L.057 24zM6.403 20.388c1.676.995 3.276 1.591 5.658 1.592 5.448 0 9.89-4.442 9.894-9.89.002-2.636-1.026-5.112-2.891-6.974C16.2 2.255 13.793 1.229 11.067 1.229 5.614 1.229 1.175 5.671 1.172 11.121c0 2.024.538 3.624 1.527 5.3l-.999 3.662 3.703-.995zm11.387-5.465c-.176-.088-1.037-.512-1.198-.57-.161-.059-.278-.088-.395.088-.117.176-.454.57-.557.688-.102.117-.205.132-.38.044-.176-.088-.743-.274-1.416-.873a5.36 5.36 0 01-.995-1.17c-.102-.176-.011-.271.077-.359.079-.078.176-.205.264-.308.088-.103.117-.176.176-.293.058-.117.029-.22-.015-.308-.044-.088-.395-.95-.54-1.3-.141-.34-.285-.293-.395-.293h-.338c-.117 0-.308.044-.47.22-.161.176-.617.603-.617 1.465s.633 1.7.72 1.818c.088.117 1.24 1.89 3.003 2.646.42.181.748.288 1.003.37.42.133.802.114 1.104.069.337-.05 1.037-.423 1.183-.832.146-.41.146-.762.103-.832-.044-.07-.161-.117-.338-.205z"/>
            </svg>
          </a>
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