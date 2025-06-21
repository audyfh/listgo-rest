// Kode ini udh gakepake lagi ya dev, soalnya langsung pakai tag a
// function clicked(element) {
//   if (element.classList.contains('bg-customBlue-normal')) {
//     element.classList.remove('bg-customBlue-normal');
//   } else {
//     element.classList.add('bg-customBlue-normal');
//   }
// }

const addTaskBtn = document.getElementById('addTaskBtn');
const addTaskOverlay = document.getElementById('addTaskOverlay');

addTaskBtn.addEventListener('click', () => {
  addTaskOverlay.classList.remove('hidden');
});

function toggleMenu(id) {
  const menu = document.getElementById(`menu-${id}`);
  document.querySelectorAll('[id^="menu-"]').forEach((m) => {
    if (m !== menu) m.classList.add('hidden');
  });
  menu.classList.toggle('hidden');
}

window.addEventListener('click', function (e) {
  const isMenuClick = e.target.closest("[id^='menu-']");
  const isToggleClick = e.target.closest("button[onclick^='toggleMenu']");
  const isInsideMenuAction = e.target.closest('[data-menu-ignore]');

  if (!isMenuClick && !isToggleClick && !isInsideMenuAction) {
    document.querySelectorAll('[id^="menu-"]').forEach((m) => m.classList.add('hidden'));
  }
});

function cancelAdd() {
  document.getElementById('addTaskOverlay').classList.add('hidden');
  TaskId = null;
}

let editingTaskId = null;

function openEditModal(id, title, dueDate) {
  document.getElementById('editTaskId').value = id;
  document.getElementById('editInput').value = title;
  document.getElementById('editDateInput').value = dueDate;
  document.getElementById('editTaskOverlay').classList.remove('hidden');
}

function cancelEdit() {
  document.getElementById('editTaskOverlay').classList.add('hidden');
}

let taskToDeleteId = null;

function deleteTask(id) {
  document.getElementById('deleteTaskOverlay').classList.remove('hidden');
}

function showDeleteModal(id, folderId) {
  const overlay = document.getElementById('deleteTaskOverlay');
  const confirmBtn = document.getElementById('confirmDeleteBtn');

  confirmBtn.href = `index.php?c=taskList&m=delete&id=${id}&folder_id=${folderId}`;

  overlay.classList.remove('hidden');
}

function cancelDelete() {
  taskToDeleteId = null;
  document.getElementById('deleteTaskOverlay').classList.add('hidden');
}

function confirmDelete() {
  const taskElement = document.getElementById(`task-${taskToDeleteId}`);
  if (taskElement) {
    taskElement.remove();
  }
  cancelDelete();
}
