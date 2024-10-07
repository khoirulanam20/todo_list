<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tasks (task, start_date, end_date, status) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$task, $startDate, $endDate, $status]);

    header("Location: index.php");
    exit();
}
?>