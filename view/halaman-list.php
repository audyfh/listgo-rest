<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>ListGo!</title>
  <link rel="stylesheet" href="output.css">
</head>
<body class="font-poppins">
  <?php $selected_folder_id = isset($_GET['folder_id']) ? $_GET['folder_id'] : null;?>
    <header>
      <div class="flex flex-wrap gap-2 p-4">
        <a href="index.php?c=Category&m=index"><button class="px-4 py-2 text-xl">☰</button></a>
            <?php foreach ($folders as $folder): ?>
              <a href="index.php?c=TaskList&m=listByFolder&folder_id=<?= $folder['id'] ?>" 
               style="background-color: <?= $selected_folder_id == $folder['id'] ? '#7fb2f0' : '#d7e7fa' ?>;"
                class="font-poppins px-4 py-2 font-bold rounded-full text-black hover:brightness-90">
                <?= htmlspecialchars($folder['name']) ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </header>

  <?php foreach($todos as $todo): ?>
  <div class="flex justify-between text-lg items-center">
    <div class="flex justify-between items-center w-full mx-6 my-2">
  <!-- Kiri: Judul & due date -->
  <div class="flex items-start">
    <button onclick="toggleMenu(<?= $todo['id'] ?>)">
      <img src="./images/t3.png" alt="menu" class="w-5 h-5 object-contain"/>
    </button>

    <div class="ms-3 kotak-list">
      <p class="text-gray-700" id="task-text-<?= $todo['id'] ?>">
        <?= htmlspecialchars($todo['title']) ?>
      </p>
      <p class="text-sm text-gray-500">
        Due: <?= date('d M Y', strtotime($todo['due_date'])) ?>
      </p>
    </div>
  </div>

  <!-- Kanan: Checkbox sebagai toggle, Sekarang pakai kyk gini buttonnya-->
  <a href="index.php?c=TaskList&m=toggleDone&id=<?= $todo['id'] ?>&folder_id=<?= $todo['folder_id']?>">
    <div class="h-7 w-7 border-2 border-black rounded-lg mt-1
      <?= $todo['is_done'] ? 'bg-customBlue-normal' : '' ?>">
    </div>
  </a>
  </div>

<div id="menu-<?= $todo['id'] ?>" class="absolute inset-0 bg-black/30 flex items-center justify-center z-50 hidden py-4">
<div 
  class="flex flex-col items-center bg-white border border-[#7fb2f0] rounded-xl w-52 shadow-lg overflow-hidden py-2"
  onclick="event.stopPropagation()" 
>
        <button
          onclick="openEditModal(
            '<?= $todo['id'] ?>',
            '<?= htmlspecialchars($todo['title'], ENT_QUOTES) ?>',
            '<?= $todo['due_date'] ?>'
          )"
          class="w-11/12 text-center px-4 py-2 text-[#2563eb] border border-[#cbd5e1] rounded-md font-medium hover:bg-[#eff6ff] transition mb-10"
        >
          Edit
        </button>

        <div class="border-t border-gray-200"></div>

        <button
          onclick="showDeleteModal(<?= $todo['id'] ?>, <?= $todo['folder_id'] ?>)" 
          class="w-11/12 text-center mt-2 px-4 py-2 text-red-600 border border-[#fca5a5] rounded-md font-medium hover:bg-red-50 transition"
        >
          Delete
        </button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<button id="addTaskBtn" class="fixed bottom-20 right-6 w-20 h-20 flex items-center justify-center">
  <img src="./images/tambah-tugas.png" alt="Add Task" class="w-20 h-20"/>
</button>


<form action="?c=TaskList&m=add" method="post">
  <input type="hidden" name="folder_id" value="<?= $selected_folder_id ?>" />
  
  <div id="addTaskOverlay" class="fixed inset-0 bg-opacity-50 flex items-center justify-center z-10 hidden">
    <div class="bg-white p-6 rounded-xl border border-black w-80">
      <input id="taskInput" type="text" placeholder="Input new task here" name="title" class="w-full border border-black p-2 rounded mb-4" required />
      <input id="taskInput" type="date" name="due_date" class="w-full border border-black p-2 rounded mb-4" required />
      <div class="flex justify-end gap-2">
        <button type="button" onclick="cancelAdd()" class="px-4 py-2 border border-black rounded hover:bg-gray-100 font-semibold">Cancel</button>
        <input type="submit" id="submitTask" class="bg-black text-white px-4 py-2 rounded" value="Add Task">
      </div>
    </div>
  </div>
</form>

    
  </div>
</div>


<form action="?c=TaskList&m=edit" method="post">
  <input type="hidden" name="id" id="editTaskId" />
  <input type="hidden" name="folder_id" value="<?= $selected_folder_id ?>" />

  <div id="editTaskOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white border border-black rounded-xl p-6 w-80">
      <h3 class="text-lg font-semibold mb-4">Edit Task</h3>

      <label for="editInput" class="block mb-2 font-medium text-gray-700">Task Title</label>
      <input id="editInput" type="text" name="title" class="w-full border border-black p-2 rounded mb-4" placeholder="Edit task here" required />

      <label for="editDateInput" class="block mb-2 font-medium text-gray-700">Due Date</label>
      <input id="editDateInput" type="date" name="due_date" class="w-full border border-black p-2 rounded mb-4" required />

      <div class="flex justify-end gap-2">
        <button type="button" onclick="cancelEdit()" class="px-4 py-2 border border-black rounded hover:bg-gray-100 font-semibold">Cancel</button>
        <input type="submit" style="background-color: #7fb2f0;" class="text-white px-4 py-2 rounded font-semibold" value="Update Task">
      </div>
    </div>
  </div>
</form>


<div id="deleteTaskOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-lg shadow-lg p-6 w-80">
    <p class="text-lg font-semibold text-gray-800 mb-4">Delete task?</p>
    <div class="flex justify-end gap-2">
      <button onclick="cancelDelete()" class="px-4 py-2 border border-black rounded hover:bg-gray-100 font-semibold">Cancel</button>
      <a id="confirmDeleteBtn" href="#">
        <button onclick="confirmDelete()" style="background-color: #f87171;" class="text-white px-4 py-2 rounded font-semibold">Delete</button>
    </div>
  </div>
</div>

<script src="./js/detail.js"></script>
</body>
</html>