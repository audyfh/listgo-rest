<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ListGo!</title>
  <link rel="stylesheet" href="output.css">
  <script src="./jquery.js"></script>
</head>

<body class="font-poppins">
  <?php $selected_folder_id = isset($_GET['folder_id']) ? $_GET['folder_id'] : null; ?>
  <header>
    <div class="flex items-center">
      <a href="index.php?c=Category&m=index"><button class="px-4 py-2 text-xl">☰</button></a>
      <div id="folder-container" class="flex flex-wrap gap-2 p-4">
      </div>
    </div>
  </header>

  <div id="task-container"></div>

  <button id="addTaskBtn" class="fixed bottom-20 right-6 w-20 h-20 flex items-center justify-center">
    <img src="./images/tambah-tugas.png" alt="Add Task" class="w-20 h-20" />
  </button>

  <div id="addTaskOverlay" class="fixed inset-0 bg-opacity-50 flex items-center justify-center z-10 hidden">
    <div class="bg-white p-6 rounded-xl border border-black w-80">
      <input id="taskInputTitle" type="text" placeholder="Input new task here" name="title" class="w-full border border-black p-2 rounded mb-4" required />
      <input id="taskInputDate" type="date" name="due_date" class="w-full border border-black p-2 rounded mb-4" required />
      <div class="flex justify-end gap-2">
        <button type="button" onclick="cancelAdd()" class="px-4 py-2 border border-black rounded hover:bg-gray-100 font-semibold">Cancel</button>
        <button type="button" onclick="submitTask()" class="bg-black text-white px-4 py-2 rounded">Add Task</button>
      </div>
    </div>
  </div>

  <div id="editTaskOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white border border-black rounded-xl p-6 w-80">
      <h3 class="text-lg font-semibold mb-4">Edit Task</h3>

      <input type="hidden" id="editTaskId" />
      <label for="editInput" class="block mb-2 font-medium text-gray-700">Task Title</label>
      <input id="editInput" type="text" name="title" class="w-full border border-black p-2 rounded mb-4" placeholder="Edit task here" required />

      <label for="editDateInput" class="block mb-2 font-medium text-gray-700">Due Date</label>
      <input id="editDateInput" type="date" name="due_date" class="w-full border border-black p-2 rounded mb-4" required />

      <div class="flex justify-end gap-2">
        <button type="button" onclick="cancelEdit()" class="px-4 py-2 border border-black rounded hover:bg-gray-100 font-semibold">Cancel</button>
        <button type="button" onclick="submitEdit()" class="text-white px-4 py-2 rounded font-semibold" style="background-color: #7fb2f0;">Update Task</button>
      </div>
    </div>
  </div>

  <div id="deleteTaskOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-80">
      <p class="text-lg font-semibold text-gray-800 mb-4">Delete task?</p>
      <div class="flex justify-end gap-2">
        <button onclick="cancelDelete()" class="px-4 py-2 border border-black rounded hover:bg-gray-100 font-semibold">Cancel</button>
        <button onclick="confirmDelete()" style="background-color: #f87171;" class="text-white px-4 py-2 rounded font-semibold">Delete</button>
      </div>
    </div>
  </div>

  <script>
    const userId = <?= json_encode($userId ?? null) ?>;
    const folderId = <?= $_GET['folder_id'] ?? 'null' ?>;
    
    // Membuat variable global untuk menyimpan data
    let todos = [];

    function loadFolders() {
      $.get(`http://localhost:8000/api/category/${userId}`, function(folders) {
        const folderContainer = $("#folder-container");
        folderContainer.empty();

        folders.forEach(folder => {
          const isSelected = folder.id == folderId;
          const bgColor = isSelected ? '#7fb2f0' : '#d7e7fa';

          folderContainer.append(`
        <a href="index.php?c=TaskList&m=listByFolder&folder_id=${folder.id}" 
          style="background-color: ${bgColor};"
          class="font-poppins px-4 py-2 font-bold rounded-full text-black hover:brightness-90">
          ${folder.name}
        </a>
      `);
        });
      });
    }

    function loadTodos() {
      if (!folderId || !userId) return;

      $.get(`http://localhost:8000/api/list/${userId}/${folderId}`, function(data) {

        // Membuat Variabel Baru
        todos = data;

        const taskContainer = $("#task-container");
        taskContainer.empty();

        todos.forEach(todo => {
          const doneClass = todo.is_done ? 'bg-customBlue-normal' : '';
          const due = new Date(todo.due_date).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
          });

          const safeTitle = todo.title.replace(/"/g, '&quot;');
          taskContainer.append(`
            <div class="flex justify-between text-lg items-center">
              <div class="flex justify-between items-center w-full mx-6 my-2">
                <div class="flex items-start">
                  <button onclick="toggleMenu(${todo.id})">
                    <img src="./images/t3.png" class="w-5 h-5 object-contain"/>
                  </button>
                  <div class="ms-3 kotak-list">
                    <p class="text-gray-700" id="task-text-${todo.id}">${todo.title}</p>
                    <p class="text-sm text-gray-500">Due: ${due}</p>
                  </div>
                </div>
                <div class="h-7 w-7 border-2 border-black rounded-lg mt-1 toggle-done ${doneClass}" data-id="${todo.id}"></div>
              </div>
            </div>
          `);
        });
      });
    }

    $(document).ready(function() {
      loadFolders();
      loadTodos();
      
      $('#addTaskBtn').on('click', function() {
        $('#addTaskOverlay').removeClass('hidden');
      });

      window.cancelAdd = function() {
        $('#addTaskOverlay').addClass('hidden');
        $('#taskInputTitle').val('');
        $('#taskInputDate').val('');
      };

      window.toggleMenu = function(id) {
        
        $('[id^="menu-"]').remove();
        

        const todoData = todos.find(t => t.id === id);
        if (!todoData) return;
        
        // Membuat menu baru untuk masing-masing task
        const taskMenu = `
          <div id="menu-${id}" class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">
            <div class="flex flex-col items-center bg-white border border-[#7fb2f0] rounded-xl w-52 shadow-lg overflow-hidden py-2" onclick="event.stopPropagation()">
              <button 
                onclick="openEditModal(${id}, '${todoData.title.replace(/'/g, "\\'")}', '${todoData.due_date}'); closeMenu(${id})"
                class="w-11/12 text-center px-4 py-2 text-[#2563eb] border border-[#cbd5e1] rounded-md font-medium hover:bg-[#eff6ff] transition mb-2">
                Edit
              </button>
              <button onclick="showDeleteModal(${id}); closeMenu(${id})" 
                class="w-11/12 text-center px-4 py-2 text-red-600 border border-[#fca5a5] rounded-md font-medium hover:bg-red-50 transition">
                Delete
              </button>
            </div>
          </div>
        `;
        
        $('body').append(taskMenu);
        
        $(`#menu-${id}`).on('click', function(e) {
          if (e.target === this) {
            closeMenu(id);
          }
        });
      };

      window.closeMenu = function(id) {
        $(`#menu-${id}`).remove();
      };

      window.cancelEdit = function() {
        $('#editTaskOverlay').addClass('hidden');
      };

      window.taskToDeleteId = null;

      window.showDeleteModal = function(id) {
        $('#deleteTaskOverlay').removeClass('hidden');
        window.taskToDeleteId = id;
      };

      window.cancelDelete = function() {
        window.taskToDeleteId = null;
        $('#deleteTaskOverlay').addClass('hidden');
      };

      window.confirmDelete = function() {
        $.ajax({
          url: "http://localhost:8000/api/list",
          type: "DELETE",
          contentType: "application/json",
          data: JSON.stringify({
            id: window.taskToDeleteId,
            user_id: userId
          }),
          success: function() {
            cancelDelete();
            loadTodos();
          },
          error: function() {
            alert("Gagal hapus task");
          }
        });
      };

      $(document).on("click", ".toggle-done", function() {
        const id = $(this).data("id");
        $.ajax({
          url: `http://localhost:8000/api/recap/toggle/${id}`,
          method: 'PATCH',
          success: function() {
            loadTodos();
          }
        });
      });
    });

    function submitTask() {
      const title = $('#taskInputTitle').val();
      const due_date = $('#taskInputDate').val();

      if (!title || !due_date) return alert("Isi semua field!");

      $.ajax({
        url: "http://localhost:8000/api/list",
        method: "POST",
        contentType: "application/json",
        data: JSON.stringify({
          folder_id: folderId,
          user_id: userId,
          title: title,
          due_date: due_date
        }),
        success: function() {
          cancelAdd();
          loadTodos();
        },
        error: function() {
          alert("Gagal tambah task");
        }
      });
    }

    function submitEdit() {
      const id = $('#editTaskId').val();
      const title = $('#editInput').val();
      const due_date = $('#editDateInput').val();

      if (!title || !due_date || !id) return alert("Field tidak boleh kosong");

      $.ajax({
        url: "http://localhost:8000/api/list",
        type: "PUT",
        contentType: "application/json",
        data: JSON.stringify({
          id: id,
          user_id: userId,
          title: title,
          due_date: due_date
        }),
        success: function() {
          cancelEdit();
          loadTodos();
        },
        error: function() {
          alert("Gagal edit task");
        }
      });
    }

    function openEditModal(id, title, dueDate) {
      $('#editTaskId').val(id);
      $('#editInput').val(title);
      $('#editDateInput').val(dueDate);
      $('#editTaskOverlay').removeClass('hidden');
    }

    $(document).on('click', '.edit-btn', function() {
      const id = $(this).data('id');
      const title = $(this).data('title');
      const dueDate = $(this).data('due');
      openEditModal(id, title, dueDate);
    });
  </script>
</body>

</html>