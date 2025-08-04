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
    deleteBtn.addEventListener("click", function () {
      li.remove();
    });
     editBtn.addEventListener("click", function () {
      
      if (editBtn.classList.contains("fa-edit")) {
        taskInput.value = textSpan.textContent; 
        editBtn.classList.remove("fa-edit");
        editBtn.classList.add("fa-floppy-o");
      } else {
        textSpan.textContent = taskInput.value;
        taskInput.value = ""; 
        editBtn.classList.remove("fa-floppy-o");
        editBtn.classList.add("fa-edit");
      }
    });
        checkbox.addEventListener("click", function () {
      checkbox.classList.toggle("checked");
      if (checkbox.classList.contains("fa-circle-o")) {
        checkbox.classList.remove("fa-circle-o");
        checkbox.classList.add("fa-check-circle");
        li.classList.add("completed");
        li.style.color = "green"; 
      } else {
        checkbox.classList.remove("fa-check-circle");
        checkbox.classList.add("fa-circle-o");
        li.style.color = ""; 
        li.style.textDecoration = "none";
      }
    });
  }
}

addTaskBtn.addEventListener("click", addTask);