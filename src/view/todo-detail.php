<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>Document</title>
</head>

<body>
    <div class="flex flex-col h-screen">
        <header class="flex justify-between items-center p-5 text-2xl font-bold ">
            <button><</button>
            <h1>All</h1>
            <div></div>
        </header>
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
</body>

</html>