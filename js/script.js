const modal = document.getElementById("delete-modal");
const confirmBtn = document.getElementById("confirm-delete");
const cancelBtn = document.getElementById("cancel-delete");
const triggers = document.querySelectorAll(".open-delete-modal");

triggers.forEach((trigger) => {
  trigger.addEventListener("click", function () {
    const todoId = this.dataset.id;
    confirmBtn.href = `?c=Recap&m=deleteTodo&id=${todoId}`;
    modal.classList.remove("hidden");
    modal.classList.add("flex");
  });
});

cancelBtn.addEventListener("click", function () {
  modal.classList.add("hidden");
  confirmBtn.href = "#";
});
