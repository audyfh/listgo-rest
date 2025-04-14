const urlParams = new URLSearchParams(window.location.search);
const dateParams = urlParams.get('date');
const taskContainer = document.getElementById("detail-container");

function fetchTodos(date){
    fetch("../js/task.json")
        .then(response => response.json())
        .then(task => {
            const today = new Date().toISOString().split("T")[0];
            const filteredTask = task.filter(task => task.date === today)
            const allTask = task.filter(task => task.done == false)
          

            taskContainer.innerHTML = date === 'today'
            ?
               `<div class="flex flex-col h-screen">
                    <header class="flex justify-between items-center p-5 text-2xl font-bold ">
                        <button><</button>
                        <h1>Today</h1>
                        <div></div>
                    </header>
                    <div class="p-3 flex flex-col gap-y-3 flex-grow overflow-y-auto">
                        ${renderTasks(filteredTask)}
                    </div>
                    <div class="sticky bottom-4 p-3">
                        <button id="download-btn" class="w-full bg-black text-white px-4 py-3 rounded-lg ">
                        Download PDF
                        </button>
                    </div>
                </div>`
            :  
               `<div class="flex flex-col h-screen">
                    <header class="flex justify-between items-center p-5 text-2xl font-bold ">
                        <button><</button>
                        <h1>All</h1>
                        <div></div>
                    </header>
                    <div class="p-3 flex flex-col gap-y-3 flex-grow overflow-y-auto">
                        ${renderTasks(allTask)}
                    </div>
                    <div class="sticky bottom-4 p-3">
                        <button id="download-btn" class="w-full bg-black text-white px-4 py-3 rounded-lg ">
                        Download PDF
                        </button>
                    </div>
                </div>`
        })
}

function renderTasks(tasks) {
return tasks.map(task => `
    <div class="flex justify-between text-lg items-center">
        <p class="${task.done ? 'line-through text-gray-500' : ''}">${task.text}</p>
        <img src="../images/${task.done ? 'circle-filled.png' : 'circle.png'}" class="h-6">
    </div>
`).join("");
}

fetchTodos(dateParams)