<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Resep</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f7f1df] font-inter text-[#1f1f1f]">
  <!-- Header -->
  <header class="flex items-center justify-between px-6 py-4 border-b border-orange-300 bg-[#f4c988]">
    <div class="flex items-center space-x-2">
    <img src="Logo.png" alt="Tudung Saji" class="h-[7vh] w-[6vw] ">
    </div>
    <h1 class="text-2xl font-bold">
      Resep <span class="text-orange-600">Spaghetti</span>
    </h1>
    <div class="flex items-center space-x-2">
    <!-- Navbar Profile Section -->
<div class="flex items-center space-x-3">
  @auth
    <!-- Nama user -->
    <a href="{{ route('profile.edit') }}">
      {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
    </a>


    <!-- Inisial user, klik ke halaman profile -->
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
  <a href="/dashboard" class="font-semibold hover:underline transition">Beranda</a>
  <span class="text-gray-400">›</span>
  <a href="/resepmasakan" class="font-semibold hover:underline transition">Resep Masakan</a>
  <span class="text-gray-400">›</span>
  <a href="/resepspaghetty" class="font-semibold hover:underline transition">Resep Spaghetti Bolognaise</a>

</nav>


  <!-- Main Content -->
  <main class="grid grid-cols-4 gap-4 px-6 py-6">
   <!-- Sidebar / Left Column -->
<aside class="col-span-1 border-r border-gray-300 pr-6">
  <img src="res1.png" alt="Spaghetti" class="rounded-lg mb-6 w-full object-cover" />
  
  <h3 class="text-lg font-semibold text-gray-800 mb-3">Bahan-bahan:</h3>
  
  <p class="text-sm text-gray-700 mb-2">
    Porsi: <span class="font-semibold text-gray-900">2 orang</span>
  </p>
  
  <ul class="list-disc list-inside text-sm text-gray-700 space-y-1 pl-1">
    <li>300 gr daging sapi lokal</li>
    <li>6 siung bawang merah</li>
    <li>200 gram spaghetti kering</li>
    <li>2 siung bawang putih, cincang halus</li>
    <li>3 sdm saus tomat botolan (bisa juga pakai saus spaghetti instan)</li>
    <li>Garam dan lada secukupnya</li>
    <li>2 sdm minyak untuk menumis</li>
    <li>Keju parut (opsional, topping)</li>
    <li>Air secukupnya untuk merebus pasta</li>
  </ul>

 
</aside>


    <!-- Recipe Detail -->
    <section class="col-span-3 px-4">
      <h2 class="text-xl font-bold mb-1">Spaghetti Bolognaise Simple</h2>
      <p class="text-sm text-gray-600 mb-4">oleh Nurul Izzati</p>
      <p class="text-sm text-justify leading-relaxed mb-6">
        Spaghetti simpel adalah hidangan pasta khas Italia yang dimasak dengan cara praktis namun tetap lezat, 
        terdiri dari mie spaghetti yang direbus hingga al dente lalu dicampur dengan saus tomat gurih, bawang putih harum, 
        serta bumbu sederhana seperti garam, lada, dan sedikit gula untuk menyeimbangkan rasa. 
        Cocok dinikmati kapan saja, hidangan ini bisa disajikan dengan taburan keju parut untuk sentuhan ekstra yang creamy dan nikmat.
      </p>

      <div class="mb-4">
          <p class="text-sm mb-2"> <strong>Lama Memasak:  </strong> 1 jam 20 menit </p>
        <h3 class="font-semibold mb-1">Langkah - langkah : </h3>
      </div>


<!-- Steps -->
<div class="space-y-4">
  <div class="flex items-center gap-4">
    <img src="bawang.png" alt="Iris Bawang" class="w-24 h-24 object-cover rounded-md">
    <textarea class="w-full px-4 py-2 text-sm border rounded-md" rows="2" readonly>
Iris bawang putih dan bawang merah secara kasar, lalu sisihkan.
    </textarea>
  </div>

  <div class="flex items-center gap-4">
    <img src="spagetirebus.jpeg" alt="Rebus Spaghetti" class="w-24 h-24 object-cover rounded-md">
    <textarea class="w-full px-4 py-2 text-sm border rounded-md" rows="2" readonly>
Rebus air dalam panci, tambahkan garam lalu masukkan spaghetti. Masak hingga al dente dan tiriskan.
    </textarea>
  </div>

  <div>
    <input type="text" value="Panaskan minyak, lalu tumis bawang putih dan bawang merah hingga harum." class="w-full px-4 py-2 text-sm border rounded-md" readonly>
  </div>

  <div>
    <input type="text" value="Masukkan daging sapi cincang dan masak hingga matang dan berubah warna." class="w-full px-4 py-2 text-sm border rounded-md" readonly>
  </div>

  <div>
    <input type="text" value="Tambahkan saus tomat botolan, aduk rata. Bumbui dengan garam, lada, dan gula secukupnya." class="w-full px-4 py-2 text-sm border rounded-md" readonly>
  </div>

  <div>
    <input type="text" value="Masak saus selama 15–20 menit dengan api kecil hingga mengental." class="w-full px-4 py-2 text-sm border rounded-md" readonly>
  </div>

  <div>
    <input type="text" value="Masukkan spaghetti ke dalam saus, aduk rata hingga tercampur sempurna." class="w-full px-4 py-2 text-sm border rounded-md" readonly>
  </div>

  <div>
    <input type="text" value="Sajikan di piring dan tambahkan keju parut di atasnya sesuai selera." class="w-full px-4 py-2 text-sm border rounded-md" readonly>
  </div>
</div>


    </section>
  </main>
</body>
</html>
