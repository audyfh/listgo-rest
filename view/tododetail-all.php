<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>Todo detail</title>
</head>

<body class="font-poppins">
    <div class="flex flex-col h-screen">
        <header class="flex justify-between items-center p-5 text-2xl font-bold  text-customBlue-dark ">
            <a href="?c=Recap&m=todoRecap">
                <button>< </button>
            </a>
            <h1>All</h1>
            <div></div>
        </header>
        <div class="p-3 flex flex-col gap-y-3 flex-grow overflow-y-auto mx-3">
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
        <a class="sticky bottom-4 p-3" href="?c=Recap&m=downloadPDF&filter=all">
            <button class="w-full bg-customBlue-dark border-2 border-black font-bold text-white px-4 py-3 rounded-lg ">Download PDF</button>
        </a>
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
    <script src="./js/script.js"></script>
</body>

</html>