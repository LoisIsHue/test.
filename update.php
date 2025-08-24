<?php
require_once "config.php";
$message = "";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $position_title = $_POST['position_title'];
    $job_summary = $_POST['job_summary'];
    $group_department = $_POST['group_department'];
    $gender = $_POST['gender'];
    $experience = $_POST['experience'];
    $license = $_POST['license'];
    $specifics = $_POST['specifics'];
    $hiredatewant = $_POST['hiredatewant'];
    $replace_add = $_POST['replace_add'];
    $employment_type = $_POST['employment_type'];
    $employment_period = $_POST['employment_period'];
    $final_action = $_POST['final_action'];
    $remarks = $_POST['remarks'];
    $justification_hiring = $_POST['justification_hiring'];

    // Fix: use rfp_id instead of id
    $stmt = $conn->prepare("UPDATE tbl_rfp SET position_title=?, job_summary=?, group_department=?, gender=?, experience=?, license=?, specifics=?, hiredatewant=?, replace_add=?, employment_type=?, employment_period=?, final_action=?, remarks=?, justification_hiring=? WHERE rfp_id=?");
    $stmt->bind_param("ssssssssssssssi", $position_title, $job_summary, $group_department, $gender, $experience, $license, $specifics, $hiredatewant, $replace_add, $employment_type, $employment_period, $final_action, $remarks, $justification_hiring, $id);

    if ($stmt->execute()) {
        $message = '<div class="alert success">Entry updated successfully!</div>';
    } else {
        $message = '<div class="alert error">Error: ' . $conn->error . '</div>';
    }
}

// Fix: use rfp_id instead of id
$stmt = $conn->prepare("SELECT * FROM tbl_rfp WHERE rfp_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Update RFP Entry</title>
</head>
<body>
<div class="container">
    <h2>Update RFP Entry</h2>
    <?= $message ?>
    <form method="post" class="rfp-form">
        <div class="form-group">
            <label>Position Title:</label>
            <input type="text" name="position_title" value="<?= htmlspecialchars($row['position_title']) ?>" required>
        </div>
        <div class="form-group">
            <label>Job Summary:</label>
            <textarea name="job_summary" rows="4" required><?= htmlspecialchars($row['job_summary']) ?></textarea>
        </div>
        <div class="form-group">
            <label>Group/Department:</label>
            <input type="text" name="group_department" value="<?= htmlspecialchars($row['group_department']) ?>" required>
        </div>
        <div class="form-group">
            <label>Gender:</label>
            <select name="gender" required>
                <option value="">Select</option>
                <option value="Male" <?= $row['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $row['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Any" <?= $row['gender'] == 'Any' ? 'selected' : '' ?>>Any</option>
            </select>
        </div>
        <div class="form-group">
            <label>Experience:</label>
            <input type="text" name="experience" value="<?= htmlspecialchars($row['experience']) ?>" required>
        </div>
        <div class="form-group">
            <label>License:</label>
            <input type="text" name="license" value="<?= htmlspecialchars($row['license']) ?>">
        </div>
        <div class="form-group">
            <label>Specifics:</label>
            <textarea name="specifics" rows="3"><?= htmlspecialchars($row['specifics']) ?></textarea>
        </div>
        <div class="form-group">
            <label>Hire Date Wanted:</label>
            <input type="date" name="hiredatewant" value="<?= htmlspecialchars($row['hiredatewant']) ?>">
        </div>
        <div class="form-group">
            <label>Replacement/Add:</label>
            <select name="replace_add" required>
                <option value="">Select</option>
                <option value="Replacement" <?= $row['replace_add'] == 'Replacement' ? 'selected' : '' ?>>Replacement</option>
                <option value="Addition" <?= $row['replace_add'] == 'Addition' ? 'selected' : '' ?>>Addition</option>
            </select>
        </div>
        <div class="form-group">
            <label>Employment Type:</label>
            <input type="text" name="employment_type" value="<?= htmlspecialchars($row['employment_type']) ?>" required>
        </div>
        <div class="form-group">
            <label>Employment Period:</label>
            <input type="text" name="employment_period" value="<?= htmlspecialchars($row['employment_period']) ?>" required>
        </div>
        <div class="form-group">
            <label>Final Action:</label>
            <input type="text" name="final_action" value="<?= htmlspecialchars($row['final_action']) ?>">
        </div>
        <div class="form-group">
            <label>Remarks:</label>
            <textarea name="remarks" rows="3"><?= htmlspecialchars($row['remarks']) ?></textarea>
        </div>
        <div class="form-group">
            <label>Justification for Hiring:</label>
            <textarea name="justification_hiring" rows="4"><?= htmlspecialchars($row['justification_hiring']) ?></textarea>
        </div>
        <div class="form-actions">
            <input type="submit" value="Update" class="btn btn-primary">
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
</body>
</html>
