<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Categories</title>
  <link rel="stylesheet" href="output.css">
</head>
<body class="font-poppins">

    <!-- Header -->
    <div class="flex items-center justify-between m-4">
      <div class="flex items-center gap-2 ">
        <a href="index.php?c=Category&m=index">
          <img src="images/Vector.png" />
        </a>
        <h2 class="text-lg font-bold text-customBlue-dark ml-3">Manage Categories</h2>
      </div>
    </div>

    <hr class="border-t border-gray-300 w-full mb-4" />

    <!-- Category List -->
    <div id="category-list" class="space-y-2 ml-9 mr-1">
      <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $cat): ?>
        <div class="flex items-center justify-between category-item hover:bg-blue-50 hover:text-blue-700 rounded-md cursor-pointer transition px-3 py-2">
          <div class="flex items-center gap-2">
            <img src="images/dot.png" class="w-2 h-2 inline" />
            <span class="text-sm category-name" data-id="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></span>
          </div>
          <div class="flex items-center gap-2">
            <button class="text-sm" onclick="openOptions(this, <?= $cat['id'] ?>, '<?= addslashes($cat['name']) ?>')">
              <img src="images/option.png" alt="Options" class="h-5 inline mr-4" />
            </button>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="text-sm text-gray-500">No categories found.</div>
      <?php endif; ?>
    </div>

    <!-- OPTIONS MODAL -->
    <div id="option-modal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 hidden">
      <div class="bg-white rounded-xl px-6 py-5 w-80 shadow-xl space-y-4">
        <h5 class="text-lg font-bold text-customBlue-dark">Choose one option</h5>
        <div class="flex flex-col items-center space-y-2">
          <button onclick="openRename()" class="text-lg font-bold text-customBlue-dark">RENAME</button>
          <button onclick="openDelete()" class="text-lg font-bold text-customBlue-dark">DELETE</button>
          <button onclick="closeModal('option-modal')" class="text-lg font-bold text-gray-400">CANCEL</button>
        </div>
      </div>
    </div>

    <!-- RENAME MODAL -->
    <div id="rename-modal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 hidden">
      <div class="bg-white rounded-xl px-6 py-5 w-80 shadow-xl space-y-4">
        <h5 class="text-lg font-bold text-customBlue-dark">Rename Category</h5>
        <input id="rename-input" type="text" placeholder="Input here" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" />
        <div class="flex justify-end gap-4">
          <button onclick="closeModal('rename-modal')" class="text-lg text-gray-400 font-bold">CANCEL</button>
          <button onclick="submitRename()" class="text-lg font-bold text-customBlue-dark">SAVE</button>
        </div>
      </div>
    </div>

    <!-- DELETE MODAL -->
    <div id="delete-modal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 hidden">
      <div class="bg-white rounded-xl px-6 py-5 w-80 shadow-xl space-y-2">
        <h5 class="text-base font-bold text-gray-800">Delete the category?</h5>
        <p class="text-sm text-gray-600">All lists in this folder will be deleted</p>
        <div class="flex justify-end gap-4 pt-2">
          <button onclick="closeModal('delete-modal')" class="text-sm text-gray-400 font-semibold">CANCEL</button>
          <button onclick="submitDelete()" class="text-sm font-bold text-red-500">DELETE</button>
        </div>
      </div>
  </div>

<script src="js/manage.js"></script>
</body>
</html>
