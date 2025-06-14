<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>Todo Recap</title>
</head>

<body class="font-poppins">
    <header class=" font-poppins flex justify-between items-center p-5 font-bold ">
        <button class="text-xl">☰</button>
        <h1 class=" text-2xl text-customBlue-dark">Todo Recap</h1>
        <div></div>
    </header>
    <div class="flex justify-around text-lg border-2 border-black h-12 rounded-xl divide-x-2 divide-black mx-3">
        <button class="font-poppins flex-1 bg-customBlue-dark text-white font-bold border-1 border-customBlue-dark rounded-s-lg" id="todo-btn">Todo</button>
        <button class="flex-1 font-bold text-customBlue-dark" id="done-btn">Done</button>
    </div>
    <div id="task-container" class="p-3">
        <div class="p-3">
            <div class="flex justify-between items-center font-bold text-xl text-customBlue-dark">
                <h2>Today</h2>
                <a href="?c=Recap&m=todoDetailToday">
                    <button class="detail-btn text-xl">></button>
                </a>

            </div>
            <div class="p-3 flex flex-col gap-y-3">
                <?php foreach ($today as $todo): ?>
                    <div class="flex justify-between text-lg items-center">
                        <div class="flex items-center">
                            <span class="text-customBlue-dark font-extrabold cursor-pointer open-delete-modal" data-id="<?= $todo['id'] ?>">⫶</span>
                            <div class="ms-3">
                                <p class="font-medium"><?= $todo['title'] ?></p>
                                <p class="text-sm text-gray-500">Due: <?= date('d M Y', strtotime($todo['due_date'])) ?></p>
                            </div>
                        </div>
                        <a href="index.php?c=Recap&m=toggleDone&id=<?= $todo['id'] ?>">
                            <div class="h-7 w-7 border-2 border-black rounded-lg mt-1"></div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="p-3">
            <div class="flex justify-between items-center font-bold text-xl  text-customBlue-dark">
                <h2>All</h2>
                <a href="?c=Recap&m=todoDetailAll">
                    <button class="detail-btn text-xl">></button>
                </a>
            </div>
            <div class="p-3 flex flex-col gap-y-3">
                <?php foreach ($all as $todo): ?>
                    <div class="flex justify-between text-lg items-center">
                        <div class="flex items-center">
                            <span class="text-customBlue-dark font-extrabold cursor-pointer open-delete-modal" data-id="<?= $todo['id'] ?>">⫶</span>
                            <div class="ms-3">
                                <p class="font-medium"><?= $todo['title'] ?></p>
                                <p class="text-sm text-gray-500">Due: <?= date('d M Y', strtotime($todo['due_date'])) ?></p>
                            </div>
                        </div>
                        <a href="index.php?c=Recap&m=toggleDone&id=<?= $todo['id'] ?>">
                            <div class="h-7 w-7 border-2 border-black rounded-lg  mt-1"></div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50  items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-80">
            <p class="text-lg font-semibold text-gray-800 mb-4">Are you sure you want to delete this todo?</p>
            <div class="flex justify-end gap-2">
                <button id="cancel-delete" class="px-4 py-2 rounded bg-customBlue-light text-black hover:bg-customBlue-light-hover">Cancel</button>
                <a id="confirm-delete" href="#" class="px-4 py-2 rounded bg-customBlue-dark text-white hover:bg-customBlue-dark-hover">Delete</a>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("done-btn").addEventListener("click", function() {
            window.location.href = "?c=Recap&m=todoDone";
        });
    </script>
    <script src="./js/script.js"></script>
</body>



</html>