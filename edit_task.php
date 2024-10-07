<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $task = $_POST['task'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $status = $_POST['status'];

        $sql = "UPDATE tasks SET task = ?, start_date = ?, end_date = ?, status = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$task, $startDate, $endDate, $status, $id]);

        header("Location: index.php");
        exit();
    } else {
        $sql = "SELECT * FROM tasks WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
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
        <h1 class="text-center mb-4">Edit Tugas</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="task" class="form-label">Isi Tugas</label>
                <input type="text" class="form-control" id="task" name="task" value="<?= htmlspecialchars($task['task']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="startDate" class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" id="startDate" name="startDate" value="<?= htmlspecialchars($task['start_date']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="endDate" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="endDate" name="endDate" value="<?= htmlspecialchars($task['end_date']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="pending" <?= $task['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="in_progress" <?= $task['status'] == 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                    <option value="completed" <?= $task['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
