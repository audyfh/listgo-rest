<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LISTGO Sidebar</title>
  <link rel="stylesheet" href="output.css">
</head>
<body class="font-poppins">
    <h1 class="text-6xl font-bold text-customBlue-dark text-center mb-6 bg-blue-100 py-6">LISTGO</h1>

    <!-- Recap Task -->
    <div class="flex items-center gap-3 m-4">
      <img src="images/Folder.png" alt="logo" class="w-6 h-6">
       <a href="index.php?c=Recap&m=todoRecap"><h5 class="text-lg font-bold text-customBlue-dark">Recap Task</h5></a>
    </div>

    <!-- Category Header -->
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-3 mb-5">
        <img src="images/category1.png" alt="logo" class="w-6 h-6 ml-4">
        <h5 class="text-lg font-bold text-customBlue-dark">Category</h5>
      </div>

      <a href="index.php?c=Category&m=manage_category">
          <button class="text-xl text-gray-500 hover:text-blue-700 mr-8">
            <img src="images/option.png" class="h-5" alt="Options" />
          </button>
      </a>
    </div>

    <!-- Tampilkan Daftar Kategori -->
    <?php if (!empty($categories)): ?>
      <?php foreach ($categories as $cat): ?>
        <a href="index.php?c=TaskList&m=listByFolder&folder_id=<?= $cat['id'] ?>" class="flex items-center">
        <div class="flex items-center gap-2 pl-8 pr-4 py-2 text-sm text-gray-600 mb-2
              hover:bg-blue-50 hover:text-blue-700 rounded-md cursor-pointer transition">
        <img src="images/Note.png" class="w-4 h-4 ml-4" alt="dot"><?= htmlspecialchars($cat['name']) ?>
        </div>
      </a>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="pl-8 text-sm text-gray-400 mb-2">No categories yet.</div>
    <?php endif; ?>

    <!-- Tombol Create New -->
    <div class="flex items-center gap-3 my-2">
      <img src="images/Add.png" alt="logo" class="w-6 h-6 ml-4">
      <button class="bg-customBlue-dark hover:bg-blue-600 text-white px-4 py-1.5 text-sm rounded-lg shadow"onclick="document.getElementById('popup-modal').classList.remove('hidden')">Create new</button>
    </div>

    <div class="flex items-center gap-3 mt-4 my-2">
      <img src="images/profile_img.png" alt="image" class="w-8 h-8 ml-3">
      <a href="index.php?c=Auth&m=logout">
        <button class="bg-customBlue-dark hover:bg-blue-600 text-white px-4 py-1.5 text-sm rounded-lg shadow">
          Logout
        </button>
      </a>
    </div>

    <!-- Modal Pop-up -->
    <div id="popup-modal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 hidden">
      <div class="bg-white rounded-xl px-6 py-5 w-80 shadow-xl space-y-4">
        <h5 class="text-lg font-bold text-customBlue-dark">Create new category</h5>
        <input id="create-input" type="text" placeholder="Category name" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" /> 
        <div class="flex justify-end gap-4">
          <button class="text-lg text-gray-400 font-bold"
            onclick="document.getElementById('popup-modal').classList.add('hidden')">CANCEL</button>
          <button class="text-lg font-bold text-customBlue-dark" onclick="submitCategory()">SAVE</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Script untuk Kirim Data -->
  <script src="js/sidebar.js"></script>

</body>
</html>
