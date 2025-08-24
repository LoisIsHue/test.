<?php
require_once "config.php";

$result = $conn->query("SELECT * FROM `tbl_rfp` ORDER BY `position_title` ASC");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>RFP Entries</title>
</head>
<body>
<h2>RFP Entries</h2>
<a href="create.php">Add New Entry</a><br><br>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Position Title</th>
        <th>Group/Department</th>
        <th>Gender</th>
        <th>Experience</th>
        <th>Hire Date Wanted</th>
        <th>Actions</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['position_title']) ?></td>
        <td><?= htmlspecialchars($row['group_department']) ?></td>
        <td><?= htmlspecialchars($row['gender']) ?></td>
        <td><?= htmlspecialchars($row['experience']) ?></td>
        <td><?= $row['hiredatewant'] ?></td>
        <td>
            <a href="view.php?id=<?= $row['id'] ?>">View</a> | 
            <a href="update.php?id=<?= $row['id'] ?>">Edit</a> | 
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this record?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
