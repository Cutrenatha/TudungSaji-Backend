<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tudung Saji</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      html {
        scroll-behavior: smooth;
      }
      /* Tambahan untuk memastikan recipe card bisa diklik */
      .recipe-card-trigger {
        cursor: pointer;
      }
    </style>
  </head>
  <body class="bg-orange-100 font-inter">

    <!-- Navbar -->
    <nav class="bg-orange-200 p-4 flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <img src="logo.png" alt="Tudung Saji" class="h-[7vh] w-[6vw]"> <!-- Ganti dengan path logo Anda -->
      </div>

      <div class="flex space-x-6 items-center">
        <a href="#" id="berandaBtn" class="text-black font-medium hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200">Beranda</a>
        <a href="#" id="resepMasakanBtn" class="text-black font-medium hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200">Resep Masakan</a>
        <a href="#" id="tipsMasakBtn" class="text-black font-medium hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200">Tips Masak</a>
        <a href="#about-us" class="text-black font-medium hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200">Tentang Kami</a>
        <a href="#" id="favoritBtn" class="text-black font-medium hover:text-orange-600 hover:underline underline-offset-4 transition-all duration-200">Favorit</a>
      </div>

      <a href="/login" class="inline-block"> <!-- Tombol ini akan mengarah ke halaman /login, tidak memicu popup -->
        <button class="bg-white text-black px-4 py-2 rounded-full font-semibold text-sm ml-6 hover:bg-gray-100 transition">
          Login / Register
        </button>
      </a>
    </nav>

    <!-- Popup Login -->
    <div id="popupLogin" class="fixed inset-0 backdrop-blur-sm bg-orange-100/30 items-center justify-center z-50 hidden">
      <div class="bg-white rounded-lg shadow-lg p-6 w-[90%] max-w-md relative">
          <button id="closePopup" class="absolute top-2 right-2 text-orange-500 text-2xl font-bold">×</button>
          <h2 class="text-center font-semibold text-lg mb-6">Masuk Untuk Melihat Fitur Ini</h2>

          <div class="space-y-3">
            <!-- Google -->
            <button class="w-full border rounded-full py-2 flex items-center justify-center space-x-2 hover:bg-gray-100">
              <svg class="w-5 h-5" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3c-1.6 4.4-5.7 7.5-10.7 7.5-6.3 0-11.5-5.2-11.5-11.5S18.3 12.5 24.5 12.5c2.8 0 5.4 1 7.4 2.8l6-6C34.6 5.5 29.8 3.5 24.5 3.5 12.7 3.5 3.5 12.7 3.5 24.5S12.7 45.5 24.5 45.5c11.8 0 21.5-9.7 21.5-21.5 0-1.7-.2-3.3-.4-4.5z"/>
                <path fill="#FF3D00" d="M6.3 14.1l6.6 4.8c1.8-4.3 5.9-7.4 10.6-7.4 2.8 0 5.4 1 7.4 2.8l6-6C34.6 5.5 29.8 3.5 24.5 3.5 15.9 3.5 8.6 8.6 6.3 14.1z"/>
                <path fill="#4CAF50" d="M24.5 45.5c5.3 0 10.1-2 13.7-5.3l-6.4-5.4c-2.3 1.6-5.1 2.5-8.3 2.5-5 0-9.3-3.1-11-7.4l-6.6 5.1C8.6 40.4 15.9 45.5 24.5 45.5z"/>
                <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-0.9 2.4-2.6 4.3-4.8 5.6l0.1 0.1 6.4 5.4c-0.4 0.4 6.5-4.8 6.5-13.6 0-1.7-.2-3.3-.4-4.5z"/>
              </svg>
              <span>Login dengan Google</span>
            </button>

            <!-- Facebook -->
            <button class="w-full border rounded-full py-2 flex items-center justify-center space-x-2 hover:bg-gray-100">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="#1877F2" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.675 0h-21.35C.6 0 0 .6 0 1.342v21.317C0 23.4.6 24 1.342 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.658-4.788 1.324 0 2.463.099 2.794.143v3.24l-1.918.001c-1.504 0-1.794.715-1.794 1.763v2.312h3.587l-.467 3.622h-3.12V24h6.116C23.4 24 24 23.4 24 22.658V1.342C24 .6 23.4 0 22.675 0z"/>
              </svg>
              <span>Login dengan Facebook</span>
            </button>

            <!-- Email -->
            <button class="w-full border rounded-full py-2 flex items-center justify-center space-x-2 hover:bg-gray-100">
              <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.761 0 5-2.239 5-5S14.761 2 12 2 7 4.239 7 7s2.239 5 5 5zm0 2c-3.866 0-7 3.134-7 7a1 1 0 102 0c0-2.757 2.243-5 5-5s5 2.243 5 5a1 1 0 102 0c0-3.866-3.134-7-7-7z"/>
              </svg>
              <span>Login dengan Email</span>
            </button>
          </div>

          <div class="mt-6">
            <a href="/login"> <!-- Tombol ini juga akan mengarah ke halaman /login -->
              <button class="bg-orange-400 text-white w-full py-2 rounded font-semibold hover:bg-orange-500 transition">Daftar </button>
            </a>
          </div>
      </div>
    </div>

    <!-- Hero Section -->
    <section class="flex flex-col items-center justify-center px-4 md:px-10 py-10 bg-orange-200 text-center">
      <!-- Konten Hero Section yang relevan mungkin hilang sebagian dari snippet Anda, 
           saya asumsikan bagian ini sudah benar sesuai desain Anda -->
      <!-- Garis Pemisah (jika ini bagian dari hero) -->
      <!-- <div class="w-px h-6 bg-gray-300 mx-3"></div> -->
      
      <!-- Hero Content -->
      <div class="flex flex-col-reverse md:flex-row items-center gap-8 md:gap-12 mt-6 w-full max-w-6xl">
        <!-- Teks -->
        <div class="w-full md:w-1/2 text-center md:text-left">
          <h1 class="text-black text-3xl md:text-5xl font-bold leading-tight mb-4">
            Temui Cara Mudah<br />
            Untuk Membuat<br />
            Makanan Favorit Anda
          </h1>
          <p class="text-black text-base md:text-lg mb-6 leading-relaxed">
            Menyediakan berbagai resep yang paling teruji.<br class="hidden md:inline" />
            Membantu kamu menemukan cara mudah memasak.
          </p>
          <button class="bg-[#F68300] text-white font-semibold text-sm md:text-base px-6 py-3 rounded-full transition duration-300 hover:bg-orange-600 active:scale-95 active:shadow-inner">
            Pelajari Selengkapnya
          </button>
        </div>

        <!-- Gambar Bertumpuk -->
        <div class="relative w-full md:w-1/2 h-[300px] md:h-[400px] flex justify-center items-center">
          <!-- Pastikan path gambar benar -->
          <img src="dis1.png" alt="Makanan 1" class="absolute w-30 h-28 md:w-55 md:h-40 rounded-full bottom-60 left-60" />
          <img src="dis2.png" alt="Makanan 2" class="absolute w-36 h-20 md:w-55 md:h-60 rounded-full top-10 right-20" />
          <img src="dis3.png" alt="Makanan 3" class="absolute w-32 h-32 md:w-40 md:h-40 rounded-full bottom-35 right-66 " />
          <img src="komen1.png" alt="Makanan 4" class="absolute w-20 h-20 md:w-36 md:h-27 bottom-20 left-80" />
          <img src="komen2.png" alt="Makanan 5" class="absolute w-24 h-16 md:w-32 md:h-20 top-60 left-30" />
        </div>
      </div>
    </section>

    <!-- Resep Terkini -->
    <section class="px-6 py-12 bg-[#F9F5F0]">
      <h2 class="text-3xl font-bold text-black mb-2">Resep Populer Minggu Ini</h2>
      <p class="text-gray-600 text-sm mb-8">Coba Resep Favorit Minggu Ini!</p>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- 1 -->
        <div class="bg-[#F4F0E5] rounded-xl p-3 shadow hover:shadow-md relative transition-transform duration-200 hover:scale-105 active:scale-95 recipe-card-trigger">
          <img src="beranda1.png" alt="Dimsum" class="rounded-lg w-full h-40 object-cover mb-3" /> <!-- Ganti dengan path gambar Anda -->
          <h3 class="text-sm font-semibold mb-1 leading-snug mt-2">Resep Dimsum Mentai Enak Yang Cocok Untuk Jualan</h3>
          <p class="text-xs text-gray-700">Oleh Cut Renatha</p>
        </div>

        <!-- 2 -->
        <div class="bg-[#F4F0E5] rounded-xl p-3 shadow hover:shadow-md relative transition-transform duration-200 hover:scale-105 active:scale-95 recipe-card-trigger">
          <img src="beranda2.png" alt="Rendang" class="rounded-lg w-full h-40 object-cover mb-3" /> <!-- Ganti dengan path gambar Anda -->
          <h3 class="text-sm font-semibold mb-1 leading-snug mt-2">Resep Rendang Daging Sapi Empuk dan Kaya Bumbu</h3>
          <p class="text-xs text-gray-700">Oleh Raysha Tazkiya</p>
        </div>

        <!-- 3 -->
        <div class="bg-[#F4F0E5] rounded-xl p-3 shadow hover:shadow-md relative transition-transform duration-200 hover:scale-105 active:scale-95 recipe-card-trigger">
          <img src="beranda3.png" alt="Soto Betawi" class="rounded-lg w-full h-40 object-cover mb-3" /> <!-- Ganti dengan path gambar Anda -->
          <h3 class="text-sm font-semibold mb-1 leading-snug mt-2">Resep Soto Betawi Enak, Gurih, dan Super Gampang Buat Idul Fitri</h3>
          <p class="text-xs text-gray-700">Oleh Firah Maulida</p>
        </div>

        <!-- 4 -->
        <div class="bg-[#F4F0E5] rounded-xl p-3 shadow hover:shadow-md relative transition-transform duration-200 hover:scale-105 active:scale-95 recipe-card-trigger">
          <img src="beranda4.png" alt="Sate Taichan" class="rounded-lg w-full h-40 object-cover mb-3" /> <!-- Ganti dengan path gambar Anda -->
          <h3 class="text-sm font-semibold mb-1 leading-snug mt-2">Resep Sate Taichan, Pedas Gurih dan Bikin Ketagihan!</h3>
          <p class="text-xs text-gray-700">Oleh Khalisa Adzrani</p>
        </div>

        <!-- 5 -->
        <div class="bg-[#F4F0E5] rounded-xl p-3 shadow hover:shadow-md relative transition-transform duration-200 hover:scale-105 active:scale-95 recipe-card-trigger">
          <img src="beranda5.png" alt="Soto Pekalongan" class="rounded-lg w-full h-40 object-cover mb-3" /> <!-- Ganti dengan path gambar Anda -->
          <h3 class="text-sm font-semibold mb-1 leading-snug mt-2">Resep Soto Pekalongan Enak Yang Cocok Untuk Berbuka</h3>
          <p class="text-xs text-gray-700">Oleh Tinsari Rauhana</p>
        </div>

        <!-- 6 -->
        <div class="bg-[#F4F0E5] rounded-xl p-3 shadow hover:shadow-md relative transition-transform duration-200 hover:scale-105 active:scale-95 recipe-card-trigger">
          <img src="beranda6.png" alt="Ikan Bakar" class="rounded-lg w-full h-40 object-cover mb-3" /> <!-- Ganti dengan path gambar Anda -->
          <h3 class="text-sm font-semibold mb-1 leading-snug mt-2">Resep Ikan Nila Bakar yang Gurih dan Kaya Bumbu</h3>
          <p class="text-xs text-gray-700">Oleh Zalvia Nasya</p>
        </div>

        <!-- 7 -->
        <div class="bg-[#F4F0E5] rounded-xl p-3 shadow hover:shadow-md relative transition-transform duration-200 hover:scale-105 active:scale-95 recipe-card-trigger">
          <img src="beranda7.png" alt="Sambal Matah" class="rounded-lg w-full h-40 object-cover mb-3" /> <!-- Ganti dengan path gambar Anda -->
          <h3 class="text-sm font-semibold mb-1 leading-snug mt-2">Resep Sambal Matah Enak yang Wanginya Sampai Satu Rumah</h3>
          <p class="text-xs text-gray-700">Oleh Nadia Maghda</p>
        </div>

        <!-- 8 -->
        <div class="bg-[#F4F0E5] rounded-xl p-3 shadow hover:shadow-md relative transition-transform duration-200 hover:scale-105 active:scale-95 recipe-card-trigger">
          <img src="beranda8.png" alt="Es Campur" class="rounded-lg w-full h-40 object-cover mb-3" /> <!-- Ganti dengan path gambar Anda -->
          <h3 class="text-sm font-semibold mb-1 leading-snug mt-2">Resep Es Campur Mutiara Kuah Santan Bikin Ketagihan!</h3>
          <p class="text-xs text-gray-700">Oleh Yuyun Nailufar</p>
        </div>
      </div>

      <div class="text-center mt-10">
        <button class="px-6 py-2 bg-[#E3DBCC] text-black rounded-full font-medium hover:bg-[#d4c9b7] transition">
          Lebih Banyak
        </button>
      </div>
    </section>

    <!-- About Us -->
    <section id="about-us" class="bg-[#E3DBCC] py-10 px-4 text-center">
      <h2 class="text-2xl font-semibold mb-4">Tentang Kami</h2>
      <p class="max-w-xl mx-auto text-gray-700 mb-6 leading-relaxed">
      Website ini hadir sebagai ruang inspiratif bagi siapa saja yang ingin mencari, mencoba, dan membagikan resep masakan. 
        Kami menyediakan beragam resep praktis hingga tradisional yang bisa menjadi referensi harian, 
        sekaligus memberi fasilitas bagi pengguna untuk membagikan kreasi masakan mereka sendiri. 
        Masak jadi lebih mudah, seru, dan saling terhubung!
      </p>
    </section>

    <!-- Footer -->
    <footer class="bg-[#f2e9db] border-t border-gray-300 pt-10 pb-6 relative overflow-hidden">
      <!-- Background Kiri dan Kanan -->
      <img src="rempahfoter1.png" alt="Spices Left" class="absolute left-0 bottom-0 h-full object-cover opacity-80 hidden md:block" /> <!-- Ganti dengan path gambar Anda -->
      <img src="rempatfot2.png" alt="Spices Right" class="absolute right-0 bottom-0 h-full object-cover opacity-80 hidden md:block" /> <!-- Ganti dengan path gambar Anda -->

      <div class="relative z-10 container mx-auto px-4 flex flex-col items-center text-center text-black space-y-6">

        <!-- Semua kolom dibungkus agar sejajar & tengah -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">

          <!-- Menu -->
          <div>
            <h3 class="font-bold mb-2">Menu</h3>
            <ul class="space-y-1">
              <li><a href="#" id="berandaBtnFooter" class="hover:underline">Beranda</a></li> <!-- ID berbeda jika fungsinya sama -->
              <li><a href="#" id="tipsMasakBtnFooter" class="hover:underline">Tips Masak</a></li> <!-- ID berbeda jika fungsinya sama -->
              <li><a href="#about-us" class="hover:underline">Tentang Kita</a></li>
              <li><a href="#" id="favoritBtnFooter" class="hover:underline">Favorit</a></li> <!-- ID berbeda jika fungsinya sama -->
              <li><a href="#" id="resepMasakanBtnFooter" class="hover:underline">Resep</a></li> <!-- ID berbeda jika fungsinya sama -->
            </ul>
          </div>

          <!-- Kontak -->
          <div>
            <h3 class="font-bold mb-2">Kontak</h3>
            <ul class="space-y-1">
              <li><a href="#about-us" class="hover:underline">Tentang Kami</a></li>
              <li><a href="#" class="hover:underline">Chat Langsung</a></li> <!-- Mungkin perlu popup/logic lain -->
            </ul>
          </div>

          <!-- Hubungi Kami -->
          <div>
            <h3 class="font-bold mb-2">Hubungi Kami</h3>
            <div class="flex justify-center space-x-4 mt-2">
              <!-- Instagram -->
              <a href="#" class="hover:scale-110 transition">
                <svg fill="url(#igGradient)" viewBox="0 0 24 24" class="w-8 h-8">
                  <defs>
                    <linearGradient id="igGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                      <stop offset="0%" stop-color="#feda75" />
                      <stop offset="50%" stop-color="#d62976" />
                      <stop offset="100%" stop-color="#4f5bd5" />
                    </linearGradient>
                  </defs>
                  <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2a3 3 0 013 3v10a3 3 0 01-3 3H7a3 3 0 01-3-3V7a3 3 0 013-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-1.25a1.25 1.25 0 11-2.5 0 1.25 1.25 0 012.5 0z"/>
                </svg>
              </a>

              <!-- YouTube -->
              <a href="#" class="hover:scale-110 transition">
                <svg fill="#FF0000" viewBox="0 0 24 24" class="w-8 h-8">
                  <path d="M23.498 6.186a2.898 2.898 0 00-2.04-2.04C19.768 3.5 12 3.5 12 3.5s-7.768 0-9.458.646a2.898 2.898 0 00-2.04 2.04A30.187 30.187 0 000 12a30.187 30.187 0 00.502 5.814 2.898 2.898 0 002.04 2.04C4.232 20.5 12 20.5 12 20.5s7.768 0 9.458-.646a2.898 2.898 0 002.04-2.04A30.187 30.187 0 0024 12a30.187 30.187 0 00-.502-5.814zM9.75 15.02V8.98L15.5 12l-5.75 3.02z"/>
                </svg>
              </a>

              <!-- WhatsApp -->
              <a href="#" class="hover:scale-110 transition">
                <svg fill="#25D366" viewBox="0 0 24 24" class="w-8 h-8">
                  <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.62-6.003C.122 5.312 5.388 0 12.061 0c3.179 0 6.167 1.237 8.413 3.488a11.78 11.78 0 013.48 8.404c-.003 6.673-5.376 12.093-12.05 12.093a12.42 12.42 0 01-5.594-1.357L.057 24zM6.403 20.388c1.676.995 3.276 1.591 5.658 1.592 5.448 0 9.89-4.442 9.894-9.89.002-2.636-1.026-5.112-2.891-6.974C16.2 2.255 13.793 1.229 11.067 1.229 5.614 1.229 1.175 5.671 1.172 11.121c0 2.024.538 3.624 1.527 5.3l-.999 3.662 3.703-.995zm11.387-5.465c-.176-.088-1.037-.512-1.198-.57-.161-.059-.278-.088-.395.088-.117.176-.454.57-.557.688-.102.117-.205.132-.38.044-.176-.088-.743-.274-1.416-.873a5.36 5.36 0 01-.995-1.17c-.102-.176-.011-.271.077-.359.079-.078.176-.205.264-.308.088-.103.117-.176.176-.293.058-.117.029-.22-.015-.308-.044-.088-.395-.95-.54-1.3-.141-.34-.285-.293-.395-.293h-.338c-.117 0-.308.044-.47.22-.161.176-.617.603-.617 1.465s.633 1.7.72 1.818c.088.117 1.24 1.89 3.003 2.646.42.181.748.288 1.003.37.42.133.802.114 1.104.069.337-.05 1.037-.423 1.183-.832.146-.41.146-.762.103-.832-.044-.07-.161-.117-.338-.205z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>

        <!-- Copyright -->
        <div class="text-sm text-black font-medium pt-4">
          @2025 Tudung <span class="text-orange-500 font-semibold">Saji</span> All Rights Reserved
        </div>
      </div>
    </footer>

    <!-- JS Popup Logic -->
    <script>
      const favoritBtn = document.getElementById('favoritBtn');
      const popup = document.getElementById('popupLogin');
      const closeBtn = document.getElementById('closePopup');

      const berandaBtn = document.getElementById('berandaBtn');
      const resepMasakanBtn = document.getElementById('resepMasakanBtn');
      const tipsMasakBtn = document.getElementById('tipsMasakBtn');
      
      // Juga ambil tombol dari footer jika ingin mereka memicu popup yang sama
      const berandaBtnFooter = document.getElementById('berandaBtnFooter');
      const resepMasakanBtnFooter = document.getElementById('resepMasakanBtnFooter');
      const tipsMasakBtnFooter = document.getElementById('tipsMasakBtnFooter');
      const favoritBtnFooter = document.getElementById('favoritBtnFooter');

      const recipeCardTriggers = document.querySelectorAll('.recipe-card-trigger');

      const showLoginPopup = (event) => {
        event.preventDefault(); // Prevent default action for links
        popup.classList.remove('hidden');
        popup.classList.add('flex');
      };

      // Navbar buttons
      if (favoritBtn) {
        favoritBtn.addEventListener('click', showLoginPopup);
      }
      if (berandaBtn) {
        berandaBtn.addEventListener('click', showLoginPopup);
      }
      if (resepMasakanBtn) {
        resepMasakanBtn.addEventListener('click', showLoginPopup);
      }
      if (tipsMasakBtn) {
        tipsMasakBtn.addEventListener('click', showLoginPopup);
      }

      // Footer buttons (jika ingin fungsionalitas yang sama)
      if (berandaBtnFooter) {
        berandaBtnFooter.addEventListener('click', showLoginPopup);
      }
      if (resepMasakanBtnFooter) {
        resepMasakanBtnFooter.addEventListener('click', showLoginPopup);
      }
      if (tipsMasakBtnFooter) {
        tipsMasakBtnFooter.addEventListener('click', showLoginPopup);
      }
      if (favoritBtnFooter) {
        favoritBtnFooter.addEventListener('click', showLoginPopup);
      }


      recipeCardTriggers.forEach(card => {
        card.addEventListener('click', showLoginPopup);
      });

      if (closeBtn) {
        closeBtn.addEventListener('click', () => {
          popup.classList.add('hidden');
          popup.classList.remove('flex');
        });
      }

      window.addEventListener('click', (event) => {
        if (event.target === popup) {
          popup.classList.add('hidden');
          popup.classList.remove('flex');
        }
      });
    </script>
    
  </body>
</html>