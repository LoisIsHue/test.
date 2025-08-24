<?php
require_once "config.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM tbl_rfp WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>View RFP Entry</title>
</head>
<body>
<div class="container">
    <h2>View RFP Entry</h2>
    <div class="rfp-form">
        <div class="form-group"><strong>Position Title:</strong> <?= htmlspecialchars($row['position_title']) ?></div>
        <div class="form-group"><strong>Job Summary:</strong> <?= htmlspecialchars($row['job_summary']) ?></div>
        <div class="form-group"><strong>Group/Department:</strong> <?= htmlspecialchars($row['group_department']) ?></div>
        <div class="form-group"><strong>Gender:</strong> <?= htmlspecialchars($row['gender']) ?></div>
        <div class="form-group"><strong>Experience:</strong> <?= htmlspecialchars($row['experience']) ?></div>
        <div class="form-group"><strong>License:</strong> <?= htmlspecialchars($row['license']) ?></div>
        <div class="form-group"><strong>Specifics:</strong> <?= htmlspecialchars($row['specifics']) ?></div>
        <div class="form-group"><strong>Hire Date Wanted:</strong> <?= htmlspecialchars($row['hiredatewant']) ?></div>
        <div class="form-group"><strong>Replacement/Add:</strong> <?= htmlspecialchars($row['replace_add']) ?></div>
        <div class="form-group"><strong>Employment Type:</strong> <?= htmlspecialchars($row['employment_type']) ?></div>
        <div class="form-group"><strong>Employment Period:</strong> <?= htmlspecialchars($row['employment_period']) ?></div>
        <div class="form-group"><strong>Final Action:</strong> <?= htmlspecialchars($row['final_action']) ?></div>
        <div class="form-group"><strong>Remarks:</strong> <?= htmlspecialchars($row['remarks']) ?></div>
        <div class="form-group"><strong>Justification for Hiring:</strong> <?= htmlspecialchars($row['justification_hiring']) ?></div>
        <div class="form-actions">
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
</body>
</html>
