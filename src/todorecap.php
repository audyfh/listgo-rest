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
        <button class="flex-1" id="done-btn">Done</button>
    </div>
    <div id="task-container" class="p-3">
       
    </div>
    <script src="../js/script.js"></script>
</body>
</html>