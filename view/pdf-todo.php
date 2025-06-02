<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo Report - <?= htmlspecialchars($statusLabel ?? 'All') ?></title>
    <style>
        body {
            font-family: sans-serif;
            margin: 40px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            border: 1px solid #888;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .done {
            color: green;
            font-weight: bold;
        }
        .undone {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Todo Report - <?= htmlspecialchars($statusLabel ?? 'All') ?></h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Due Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos as $todo): ?>
                <tr>
                    <td><?= htmlspecialchars($todo['title']) ?></td>
                    <td class="<?= $todo['is_done'] ? 'done' : 'undone' ?>">
                        <?= $todo['is_done'] ? 'Done' : 'Undone' ?>
                    </td>
                    <td><?= date('d M Y', strtotime($todo['due_date'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
