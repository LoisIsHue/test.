<?php
require_once "config.php";
// Use rfp_id instead of id
$result = $conn->query("SELECT * FROM tbl_rfp ORDER BY rfp_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>View RFP Records</title>
</head>
<body>
    <div class="container">
        <h2>RFP Entries</h2>
        <div class="nav-links">
            <a href="create.php" class="btn btn-primary">Add New RFP Entry</a>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>Position Title</th>
                    <th>Group / Department</th>
                    <th>Gender</th>
                    <th>Experience</th>
                    <th>Proposed Hire Date</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['position_title']) ?></td>
                    <td><?= htmlspecialchars($row['group_department']) ?></td>
                    <td><?= htmlspecialchars($row['gender']) ?></td>
                    <td><?= htmlspecialchars($row['experience']) ?></td>
                    <td><?= htmlspecialchars($row['hiredatewant']) ?></td>
                    <td>
                        <a href="view.php?id=<?= $row['rfp_id'] ?>" class="btn btn-primary">View</a>
                        <a href="update.php?id=<?= $row['rfp_id'] ?>" class="btn btn-secondary">Edit</a>
                        <a href="delete.php?id=<?= $row['rfp_id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
