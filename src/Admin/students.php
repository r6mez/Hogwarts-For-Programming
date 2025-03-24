<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Page</title>
    <link rel="stylesheet" href="styles/defaults.css">
</head>
<body>
<div class="container">
    <h1>Manage Students</h1>
    <table>
        <thead>
        <tr>
        <th>ID</th>
        <th>Student Name</th>
        <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include 'Hogwarts';
        $conn = null;
        $stmt = $conn->query("select id , points , house_id from students");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td class='action-buttons'>
            <a href='edit_student.php?id={$row[ 'id' ]}'>Edit</a>
            <a href='delete_student.php?id={$row[ 'id' ]}'>Delete</a>
            </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>