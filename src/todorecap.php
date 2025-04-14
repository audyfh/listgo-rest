<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>Todo Recap</title>
</head>

<body>
    <header class="flex justify-between items-center p-5 font-bold ">
        <button class="text-xl">☰</button>
        <h1 class="text-2xl">Todo Recap</h1>
        <div></div>
    </header>
    <div class="flex justify-around text-lg border-2 border-black h-12 rounded-xl divide-x-2 divide-black mx-3">
        <button class="flex-1 bg-black text-white font-bold" id="todo-btn">Todo</button>
        <button class="flex-1" id="done-btn">Done</button>
    </div>
    <div id="task-container" class="p-3">
        <div class="p-3">
            <div class="flex justify-between items-center font-bold text-xl">
                <h2>Today</h2>
                <button class="detail-btn text-xl">></button>
            </div>
            <div class="p-3 flex flex-col gap-y-3">
                <div class="flex justify-between text-lg items-center">
                    <div>
                        <span>⫶</span>
                        <span>Lorem ipsum</span>
                    </div>
                    <img src="../images/circle.png" class="h-6">
                </div>
            </div>
        </div>

        <div class="p-3">
            <div class="flex justify-between items-center font-bold text-xl">
                <h2>All</h2>
                <button class="detail-btn text-xl">></button>
            </div>
            <div class="p-3 flex flex-col gap-y-3">
                <div class="flex justify-between text-lg items-center">
                    <div>
                        <span>⫶</span>
                        <span>Lorem ipsum</span>
                    </div>
                    <img src="../images/circle.png" class="h-6">
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('done-btn').addEventListener('click', function(){
            window.location.href='todo-done.php'
        })

        document.querySelectorAll('.detail-btn').forEach(button => {
            button.addEventListener('click', function() {
                window.location.href = 'todo-detail.php';
            });
        });
    </script>
</body>
</html>