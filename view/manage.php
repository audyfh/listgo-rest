<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Categories</title>
  <link rel="stylesheet" href="output.css">
  <script src="./jquery.js"></script>
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
      <div id="category-list" class="space-y-2 ml-9 mr-1"></div>
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

<script>
  const userId = <?= json_encode($userId ?? null) ?>; 
  let currentCategoryId = null;
  let currentCategoryName = "";

  function closeModal(id) {
    $("#" + id).addClass("hidden");
  }

  function openOptions(button, id, name) {
    currentCategoryId = id;
    currentCategoryName = name;
    $("#option-modal").removeClass("hidden");
  }

  function openRename() {
    $("#rename-input").val(currentCategoryName);
    closeModal("option-modal");
    $("#rename-modal").removeClass("hidden");
  }

  function openDelete() {
    closeModal("option-modal");
    $("#delete-modal").removeClass("hidden");
  }

  function submitRename() {
    const newName = $("#rename-input").val().trim();
    if (newName !== "") {
      $.ajax({
        url: "http://localhost:8000/api/category/",
        method: "PUT",
        contentType: "application/json",
        data: JSON.stringify({
          user_id: userId,
          id: currentCategoryId,
          name: newName
        }),
        success: function () {
          closeModal("rename-modal");
          loadCategories();
        }
      });
    }
  }

  function submitDelete() {
    $.ajax({
      url: "http://localhost:8000/api/category/",
      method: "DELETE",
      contentType: "application/json",
      data: JSON.stringify({
        user_id: userId,
        id: currentCategoryId
      }),
      success: function () {
        closeModal("delete-modal");
        loadCategories();
      }
    });
  }

  function loadCategories() {
    $("#category-list").empty().append("<p class='text-sm text-gray-500'>Loading...</p>");
    $.get(`http://localhost:8000/api/category/${userId}`, function (data) {
      $("#category-list").empty();
      if (data.length === 0) {
        $("#category-list").append("<div class='text-sm text-gray-500'>No categories found.</div>");
        return;
      }

      data.forEach(cat => {
        const catHtml = `
          <div class="flex items-center justify-between category-item hover:bg-blue-50 hover:text-blue-700 rounded-md cursor-pointer transition px-3 py-2">
            <div class="flex items-center gap-2">
              <img src="images/dot.png" class="w-2 h-2 inline" />
              <span class="text-sm category-name" data-id="${cat.id}">${cat.name}</span>
            </div>
            <div class="flex items-center gap-2">
              <button class="text-sm open-options-btn" data-id="${cat.id}" data-name="${cat.name}">
                <img src="images/option.png" alt="Options" class="h-5 inline mr-4" />
              </button>
            </div>
          </div>
        `;
        $("#category-list").append(catHtml);
      });
    });
  }

  // Delegate click event
  $(document).on("click", ".open-options-btn", function () {
    const id = $(this).data("id");
    const name = $(this).data("name");
    openOptions(this, id, name);
  });

  $(document).ready(function () {
    loadCategories();
  });
</script>

</body>
</html>
