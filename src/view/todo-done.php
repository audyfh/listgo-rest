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
        <button class="flex-1" id="todo-btn">Todo</button>
        <button class="flex-1 bg-black text-white font-bold" id="done-btn">Done</button>
    </div>
    <div class="p-3">
        <div class="flex justify-between items-center font-bold text-xl">
            <h2>Done</h2>
        </div>
        <div class="flex flex-col min-h-screen">
            <div class="p-3 flex flex-col gap-y-3 flex-grow overflow-y-auto">
                <div class="flex justify-between text-lg items-center">
                    <div>
                        <span>⫶</span>
                        <span class="line-through text-gray-500">Lorem ipsum</span>
                    </div>
                    <img src="../images/circle-filled.png" class="h-6">
                </div>
            </div>
            <div class="sticky bottom-4 p-3">
                <button class="w-full bg-black text-white px-4 py-3 rounded-lg ">Download PDF</button>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('todo-btn').addEventListener('click', function(){
            window.location.href='todorecap.php'
        })
    </script>
</body>
</html>