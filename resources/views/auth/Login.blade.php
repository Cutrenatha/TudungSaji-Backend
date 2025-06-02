<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tudung Saji Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      html, body {
        overflow: hidden;
        height: 100%;
      }

      .bg-login {
        background-color: #fefae0; /* warna krem soft */
      }

      .bg-decor {
        background-image: url('back.jpg'); /* sayuran/bumbu transparan */
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        opacity: 0.15;
        z-index: 1;
      }

      .btn-animated {
        transition: all 0.3s ease;
      }

      .btn-animated:hover {
        box-shadow: 0 4px 14px 0 rgba(248, 154, 32, 0.6);
        transform: translateY(-2px);
      }
    </style>
  </head>
  <body class="bg-login h-screen overflow-hidden flex">
    <!-- LEFT SIDE -->
    <div class="w-1/2 relative flex justify-center items-center">
      <!-- Logo -->
      <img src="Logo.png" alt="Logo" class="absolute top-8 left-8 w-32 z-20"/>

      <!-- Background rectangle untuk gambar -->
      <div class="absolute h-[900px] w-[300px] bg-[#2d2d2d] rounded-3xl shadow-xl z-10"></div>

      <!-- Stack gambar makanan -->
      <div class="relative h-[500px] w-[300px] flex flex-col items-center justify-center z-20">
        <img src="log1.png" alt="Dish 1" class="absolute top-7 left-1/3 -translate-x-1/3 w-200 rounded-full "/>
        <img src="log2.png" alt="Dish 2" class="absolute top-[115px] right-3/5 -translate-x-1/2 w-200 rounded-full"/>
        <img src="log3.png" alt="Dish 3" class="absolute top-[330px] left-1/2 -translate-x-1/2 w-55 rounded-full "/>
      </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="w-1/2 relative flex justify-center items-center overflow-hidden">
      <!-- Orange Curved Wave Background -->
      <div class="absolute top-0 left-0 w-full h-full z-0 overflow-hidden">
        <svg viewBox="0 0 1440 800" class="absolute w-full h-full" preserveAspectRatio="none">
          <path d="M1440,0 C1300,200 1200,400 900,500 C700,580 400,700 0,800 L1440,800 Z" fill="#F89A20"/>
        </svg>
      </div>

      <!-- Background dekoratif transparan -->
      <div class="absolute inset-0 bg-decor z-0"></div>

      <!-- Form login -->
      <div class="relative z-10 bg-white bg-opacity-95 rounded-2xl shadow-2xl px-10 py-10 w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">
          TUDUNG <span class="text-red-500">SAJI</span>
        </h2>

        {{-- Tampilkan pesan sukses --}}
        @if(session('success'))
          <div class="mb-4 p-3 bg-green-100 text-green-800 rounded border border-green-200">
            {{ session('success') }}
          </div>
        @endif

        {{-- Tampilkan pesan error login jika ada --}}
        @if ($errors->any())
          <div class="mb-4 p-3 bg-red-100 text-red-800 rounded border border-red-200">
            <ul class="list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}" class="space-y-4">
          @csrf
          <input
            type="text"
            name="email"
            placeholder="E-mail"
            class="w-full px-4 py-2 border border-orange-400 bg-orange-100 rounded focus:outline-none focus:ring-2 focus:ring-orange-300"
            required
          />
          <input
            type="password"
            name="password"
            placeholder="Password"
            class="w-full px-4 py-2 border border-orange-400 bg-orange-100 rounded focus:outline-none focus:ring-2 focus:ring-orange-300"
            required
          />
          
          <button
            type="submit"
            class="btn-animated block text-center w-full bg-orange-500 text-white py-2 rounded hover:bg-orange-600 transition"
          >
            LOGIN
          </button>
        </form>

        <div class="flex items-center my-6">
          <hr class="flex-grow border-gray-300" />
          <span class="mx-4 text-gray-400">OR</span>
          <hr class="flex-grow border-gray-300" />
        </div>

        <div class="flex justify-center space-x-4">
          <button class="btn-animated bg-blue-600 text-white px-5 py-2 rounded-full">
            Facebook
          </button>
          <button class="btn-animated border border-gray-300 px-5 py-2 rounded-full text-gray-700">
            Google
          </button>
        </div>

        <p class="mt-6 text-center text-sm text-gray-700">
          Don’t have account?
          <a href="{{ route('register.form') }}" class="text-orange-600 hover:underline">Sign Up</a>
        </p>
      </div>
    </div>
  </body>
</html>
