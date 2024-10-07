<?php
include 'db.php';

$sql = "SELECT * FROM tasks";
$stmt = $pdo->query($sql);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container mt-5">
        <form id="todoForm" class="mb-4" action="add_task.php" method="POST">
            <div class="mb-3">
                <label for="task" class="form-label">Isi Tugas</label>
                <input type="text" class="form-control" id="task" name="task" required>
            </div>
            <div class="mb-3">
                <label for="startDate" class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" id="startDate" name="startDate" required>
            </div>
            <div class="mb-3">
                <label for="endDate" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="endDate" name="endDate" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Tambah Tugas</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tugas</th>
                    <th>Tanggal Awal</th>
                    <th>Tanggal Akhir</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="taskList">
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['task']) ?></td>
                        <td><?= htmlspecialchars($task['start_date']) ?></td>
                        <td><?= htmlspecialchars($task['end_date']) ?></td>
                        <td>
                            <?php if ($task['status'] == 'pending'): ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php elseif ($task['status'] == 'in_progress'): ?>
                                <span class="badge bg-info text-dark">In Progress</span>
                            <?php else: ?>
                                <span class="badge bg-success">Completed</span>
                            <?php endif; ?>
                        </td>
                        <td>    
                            <a href="edit_task.php?id=<?= $task['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_task.php?id=<?= $task['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>