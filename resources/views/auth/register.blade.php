<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Account</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f2e9da]">
  <!-- Background Illustration -->
  <div class="absolute inset-0 bg-cover bg-center opacity-30 z-0" style="background-image: url('your-image-url.jpg');"></div>

  <!-- Main Container -->
  <div class="flex items-center justify-center min-h-screen relative z-10">
    <div class="bg-white bg-opacity-80 p-8 rounded-xl shadow-md w-full max-w-2xl">
      
      <!-- Back Button -->
      <div class="mb-4">
        <a href="/login" class="text-orange-500 hover:underline text-sm">&larr; Kembali ke Login</a>
      </div>

      <!-- Logo -->
      <div class="text-center mb-6">
        <img src="Logo.png" alt="Logo" class="mx-auto w-16 mb-2" />
        <h2 class="text-xl font-semibold tracking-wide">CREATE <span class="text-red-500">ACCOUNT</span></h2>
      </div>

      <form action="{{ route('register.process') }}" method="POST" class="space-y-4">
        @csrf

        <!-- First & Last Name -->
        <div class="flex gap-4">
          <div class="w-1/2">
            <label class="block text-sm font-medium mb-1">First Name</label>
            <input type="text" name="first_name" class="w-full px-4 py-2 bg-orange-100 rounded-md" required />
          </div>
          <div class="w-1/2">
            <label class="block text-sm font-medium mb-1">Last Name</label>
            <input type="text" name="last_name" class="w-full px-4 py-2 bg-orange-100 rounded-md" required />
          </div>
        </div>

        <!-- Username -->
        <div>
          <label class="block text-sm font-medium mb-1">Username</label>
          <input type="text" name="username" class="w-full px-4 py-2 bg-orange-100 rounded-md" required />
        </div>

        <!-- Email -->
        <div>
          <label class="block text-sm font-medium mb-1">E-Mail</label>
          <input type="email" name="email" class="w-full px-4 py-2 bg-orange-100 rounded-md" required />
        </div>

        <!-- Password -->
        <div>
          <label class="block text-sm font-medium mb-1">Password</label>
          <input type="password" name="password" class="w-full px-4 py-2 bg-orange-100 rounded-md" required />
        </div>

        <!-- Confirm Password -->
        <div>
          <label class="block text-sm font-medium mb-1">Confirm Password</label>
          <input type="password" name="password_confirmation" class="w-full px-4 py-2 bg-orange-100 rounded-md" required />
        </div>

        <!-- Submit -->
        <div class="text-center pt-4">
          <button type="submit" class="w-full bg-orange-500 text-white py-2 px-4 rounded-md">REGISTER</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>