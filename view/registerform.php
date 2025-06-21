<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>Document</title>
</head>
<body class="min-h-screen bg-customBlue-light flex flex-col items-center justify-center px-4 font-poppins">

  <h1 class="text-4xl font-bold text-customBlue-darker mb-8">
    ListGo
  </h1>

  <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">
    <h1 class="text-2xl font-semibold text-customBlue-darker mb-6">Daftar</h1>

    <?php if (!empty($error ?? '')): ?>
      <p class="mb-4 text-sm text-red-600"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="index.php?c=Auth&m=register" method="post" class="space-y-4">
      <div>
        <label class="block text-sm mb-1 text-customBlue-dark">Username</label>
        <input type="text" name="username" required
               class="w-full border rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-customBlue-normal" />
      </div>

      <div>
        <label class="block text-sm mb-1 text-customBlue-dark">Password</label>
        <input type="password" name="password" required
               class="w-full border rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-customBlue-normal" />
      </div>

      <div>
        <label class="block text-sm mb-1 text-customBlue-dark">Konfirmasi Password</label>
        <input type="password" name="password_confirm" required
               class="w-full border rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-customBlue-normal" />
      </div>

      <button type="submit"
        class="w-full bg-customBlue-normal hover:bg-customBlue-normal-hover active:bg-customBlue-normal-active text-white font-semibold py-2 rounded-lg transition">
        Register
      </button>
    </form>

    <p class="mt-6 text-sm text-center">
      Sudah punya akun?
      <a href="index.php?c=Auth&m=loginForm"
         class="text-customBlue-dark hover:text-customBlue-darker font-semibold">
        Masuk di sini
      </a>
    </p>
  </div>

</body>
</html>