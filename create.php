<?php
require_once "config.php";
$message = "";

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

    $stmt = $conn->prepare("INSERT INTO tbl_rfp (position_title, job_summary, group_department, gender, experience, license, specifics, hiredatewant, replace_add, employment_type, employment_period, final_action, remarks, justification_hiring) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssss", $position_title, $job_summary, $group_department, $gender, $experience, $license, $specifics, $hiredatewant, $replace_add, $employment_type, $employment_period, $final_action, $remarks, $justification_hiring);

    if ($stmt->execute()) {
        $message = '<div class="alert success">Entry created successfully!</div>';
    } else {
        $message = '<div class="alert error">Error: ' . $conn->error . '</div>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Create RFP Entry</title>
</head>
<body>
<div class="container">
    <h2>Create RFP Entry</h2>
    <?= $message ?>
    <form method="post" class="rfp-form">
        <div class="form-group">
            <label>Position Title:</label>
            <input type="text" name="position_title" required>
        </div>
        <div class="form-group">
            <label>Job Summary:</label>
            <textarea name="job_summary" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label>Group/Department:</label>
            <input type="text" name="group_department" required>
        </div>
        <div class="form-group">
            <label>Gender:</label>
            <select name="gender" required>
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Any">Any</option>
            </select>
        </div>
        <div class="form-group">
            <label>Experience:</label>
            <input type="text" name="experience" required>
        </div>
        <div class="form-group">
            <label>License:</label>
            <input type="text" name="license">
        </div>
        <div class="form-group">
            <label>Specifics:</label>
            <textarea name="specifics" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Hire Date Wanted:</label>
            <input type="date" name="hiredatewant">
        </div>
        <div class="form-group">
            <label>Replacement/Add:</label>
            <select name="replace_add" required>
                <option value="">Select</option>
                <option value="Replacement">Replacement</option>
                <option value="Addition">Addition</option>
            </select>
        </div>
        <div class="form-group">
            <label>Employment Type:</label>
            <input type="text" name="employment_type" required>
        </div>
        <div class="form-group">
            <label>Employment Period:</label>
            <input type="text" name="employment_period" required>
        </div>
        <div class="form-group">
            <label>Final Action:</label>
            <input type="text" name="final_action">
        </div>
        <div class="form-group">
            <label>Remarks:</label>
            <textarea name="remarks" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Justification for Hiring:</label>
            <textarea name="justification_hiring" rows="4"></textarea>
        </div>
        <div class="form-actions">
            <input type="submit" value="Submit" class="btn btn-primary">
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
</body>
</html>
