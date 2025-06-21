let currentCategoryId = null;
let currentCategoryName = "";

function closeModal(id) {
  document.getElementById(id).classList.add("hidden");
}

function openOptions(button, id, name) {
  currentCategoryId = id;
  currentCategoryName = name;
  document.getElementById("option-modal").classList.remove("hidden");
}

function openRename() {
  document.getElementById("rename-input").value = currentCategoryName;
  closeModal("option-modal");
  document.getElementById("rename-modal").classList.remove("hidden");
}

function openDelete() {
  closeModal("option-modal");
  document.getElementById("delete-modal").classList.remove("hidden");
}

function submitRename() {
  const newName = document.getElementById("rename-input").value.trim();
  if (newName !== "") {
    fetch("index.php?c=Category&m=updateCategory", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id=${currentCategoryId}&name=${encodeURIComponent(newName)}`,
    }).then(() => location.reload());
  }
}

function submitDelete() {
  fetch("index.php?c=Category&m=deleteCategory", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `id=${currentCategoryId}`,
  }).then(() => location.reload());
}
