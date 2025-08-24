<?php
require_once "config.php";
$message = "";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("DELETE FROM tbl_rfp WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: index.php?msg=deleted");
        exit();
    } else {
        $message = '<div class="alert error">Error deleting record: ' . $conn->error . '</div>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Delete RFP Entry</title>
</head>
<body>
<div class="container">
    <h2>Delete Confirmation</h2>
    <?= $message ?>
    <form method="post" class="rfp-form">
        <p>Are you sure you want to delete this entry?</p>
        <div class="form-actions">
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
