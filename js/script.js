document.addEventListener("DOMContentLoaded", () => {
    const taskContainer = document.getElementById("task-container");
    const todoBtn = document.getElementById("todo-btn");
    const doneBtn = document.getElementById("done-btn");

    window.navigateToDetail = function(dateParam){
        window.location.href = `todo-detail.php?date=${dateParam}`;
    };

    function fetchTodos(status){
        fetch("../js/task.json")
            .then(response => response.json())
            .then(tasks => {

                const today = new Date().toISOString().split("T")[0];
                const filteredTasks = tasks.filter(task => task.done === (status === "done"));

                taskContainer.innerHTML = status === "done"
                    ?   
                        `<div class="flex flex-col h-screen">
                            <h2 class="text-xl font-bold p-3">Done</h2>
                            <div class="p-3 flex flex-col gap-y-3 flex-grow overflow-y-auto">
                                ${renderTasks(filteredTasks)}
                            </div>
                            <div class="sticky bottom-4 p-3">
                                <button id="download-btn" class="w-full bg-black text-white px-4 py-3 rounded-lg ">
                                Download PDF
                                </button>
                            </div>
                        </div>`
                    : 
                        `<div class="p-3">
                            <div class="flex justify-between items-center font-bold text-xl">
                                <h2>Today</h2>
                                <button class="detail-btn text-xl" onclick="navigateToDetail('today')">></button>
                            </div>
                            <div class="p-3 flex flex-col gap-y-3">
                                ${renderTasks(filteredTasks.filter(task => task.date === today))}
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="flex justify-between items-center font-bold text-xl">
                                <h2>All</h2>
                                <button class="detail-btn text-xl" onclick="navigateToDetail('all')">></button>
                            </div>
                            <div class="p-3 flex flex-col gap-y-3">
                                ${renderTasks(filteredTasks.filter(task => task.date !== today))}
                            </div>
                        </div>`
            })
    }

    function renderTasks(tasks) {
        return tasks.map(task => `
            <div class="flex justify-between text-lg items-center">
                <div>
                    <span>⫶</span>
                    <p class="${task.done ? 'line-through text-gray-500' : ''}">${task.text}</p>
                </div>
                <img src="../images/${task.done ? 'circle-filled.png' : 'circle.png'}" class="h-6">
            </div>
        `).join("");
    }

    todoBtn.addEventListener("click", function(){
        todoBtn.classList.add("bg-black", "text-white", "font-bold");
        doneBtn.classList.remove("bg-black", "text-white", "font-bold");
        fetchTodos("todo")
    });
    doneBtn.addEventListener("click", function (){
        doneBtn.classList.add("bg-black", "text-white", "font-bold");
        todoBtn.classList.remove("bg-black", "text-white", "font-bold");
        fetchTodos("done")
    });
    
    fetchTodos("todo");
});