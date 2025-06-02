<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tips Masak - Tudung Saji</title>
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
      <a href="{{ route('resepmasakan') }}" class="text-black font-medium hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200">Resep Masakan</a>
      <a href="{{ route('tipsmasak') }}" class="text-black font-medium hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200
        {{ request()->routeIs('tipsmasak') ? 'text-orange-600 underline font-semibold' : '' }}
      ">Tips Masak</a>
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
      <a href="{{ route('tipsmasak') }}" class="font-semibold hover:underline transition"></a>
    </nav>

    <!-- Judul & Deskripsi -->
    <section class="max-w-6xl mx-auto px-4 py-4 text-center">
      <h2 class="text-2xl font-bold mb-2">
        Tips <span class="text-orange-600">Masak</span>
      </h2>
      <p class="text-gray-600">Simak Beraneka ragam tips masak dan resep-resep singkat yang akan menjadi inspirasi untuk mengembangkan kemampuan masakmu setiap harinya</p>
    </section>

    <!-- Grid Tips -->
    <section class="max-w-6xl mx-auto px-4 py-6 mb-10">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">

        <!-- Card -->
        <a href="https://kumparan.com/tips-dan-trik/5-cara-menggoreng-ayam-agar-empuk-dan-matang-sempurna-20xjOTYpphx" target="_blank" rel="noopener noreferrer" class="transform hover:scale-[1.02] transition duration-300">
          <div class="h-full rounded-xl overflow-hidden shadow-md hover:shadow-lg bg-white flex flex-col">
            <img src="{{ asset('tips1.png') }}" alt="Tips Menggoreng Ayam" class="w-full h-40 object-cover">
            <div class="p-3 flex-grow flex items-end">
              <p class="font-medium min-h-[60px]">5 Cara Menggoreng Ayam Agar Enak: Beda Resep, Beda Juga Triknya</p>
            </div>
          </div>
        </a>

        <a href="#" class="transform hover:scale-[1.02] transition duration-300"> {{-- Ganti # dengan URL yang sesuai --}}
          <div class="h-full rounded-xl overflow-hidden shadow-md hover:shadow-lg bg-white flex flex-col">
            <img src="{{ asset('tips2.png') }}" alt="Tips Teh Herbal" class="w-full h-40 object-cover">
            <div class="p-3 flex-grow flex items-end">
              <p class="font-medium min-h-[60px]">9 Teh Herbal Tingkatkan Stamina Tubuh</p>
            </div>
          </div>
        </a>

        <a href="#" class="transform hover:scale-[1.02] transition duration-300"> {{-- Ganti # dengan URL yang sesuai --}}
          <div class="h-full rounded-xl overflow-hidden shadow-md hover:shadow-lg bg-white flex flex-col">
            <img src="{{ asset('tips3.png') }}" alt="Tips Memilih Daging" class="w-full h-40 object-cover">
            <div class="p-3 flex-grow flex items-end">
              <p class="font-medium min-h-[60px]">Tips Memilih Daging Berkualitas di Pasar Tradisional</p>
            </div>
          </div>
        </a>

        <a href="#" class="transform hover:scale-[1.02] transition duration-300"> {{-- Ganti # dengan URL yang sesuai --}}
          <div class="h-full rounded-xl overflow-hidden shadow-md hover:shadow-lg bg-white flex flex-col">
            <img src="{{ asset('tips4.png') }}" alt="Tips Menyimpan Lauk Goreng" class="w-full h-40 object-cover">
            <div class="p-3 flex-grow flex items-end">
              <p class="font-medium min-h-[60px]">Cara Tepat Menyimpan Lauk Goreng Agar Tetap Renyah</p>
            </div>
          </div>
        </a>

        <a href="#" class="transform hover:scale-[1.02] transition duration-300"> {{-- Ganti # dengan URL yang sesuai --}}
          <div class="h-full rounded-xl overflow-hidden shadow-md hover:shadow-lg bg-white flex flex-col">
            <img src="{{ asset('tips5.png') }}" alt="Resep Olahan Tahu" class="w-full h-40 object-cover">
            <div class="p-3 flex-grow flex items-end">
              <p class="font-medium min-h-[60px]">Resep Simpel Olahan Tahu yang Bikin Nagih</p>
            </div>
          </div>
        </a>

        <a href="#" class="transform hover:scale-[1.02] transition duration-300"> {{-- Ganti # dengan URL yang sesuai --}}
          <div class="h-full rounded-xl overflow-hidden shadow-md hover:shadow-lg bg-white flex flex-col">
            <img src="{{ asset('tips6.png') }}" alt="Trik Memasak Nasi Goreng" class="w-full h-40 object-cover">
            <div class="p-3 flex-grow flex items-end">
              <p class="font-medium min-h-[60px]">Trik Memasak Nasi Goreng Tanpa Minyak Berlebih</p>
            </div>
          </div>
        </a>

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
                {{-- Definisi gradient sudah ada di file resepmasakan, jika ini adalah layout terpisah, pastikan ada.
                     Jika ini halaman yang sama, ID harus unik atau didefinisikan sekali.
                     Untuk kesederhanaan, kita anggap ID #igGradientFooterGeneral sudah ada atau bisa dipakai. --}}
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

</html>