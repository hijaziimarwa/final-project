const taskInput = document.getElementById("task-input");
const addTaskBtn = document.getElementById("add-task-btn");
const taskList = document.getElementById("task-list");

function addTask() {
  if (taskInput.value === "") {
    alert("Please enter a task");
  } else {
    const taskText = taskInput.value;

    const li = document.createElement("li");

    const checkbox = document.createElement("span");
    const textSpan = document.createElement("span");
    textSpan.classList.add("task-text");
    textSpan.textContent = taskText;

    const editBtn = document.createElement("span");
    const deleteBtn = document.createElement("span");

    checkbox.classList.add("fa", "fa-circle-o", "checkbox");
    editBtn.classList.add("fa", "fa-edit", "edit-btn");
    deleteBtn.classList.add("fa", "fa-trash", "delete-btn");

    li.append(checkbox, textSpan, editBtn, deleteBtn);
    taskList.appendChild(li);
    taskInput.value = "";
  }
}
