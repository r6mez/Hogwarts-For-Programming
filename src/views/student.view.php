<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="styles/defaults.css">

</head>
<body>
    <h1>Students</h1>
    <form action="/students/create" method="POST">
        <input type="number" name="id" placeholder="Student ID" required>
        <input type="number" name="points" placeholder="Points" required>
        <input type="number" name="house_id" placeholder="House ID" required>
        <button type="submit">Add Student</button>
    </form>
    <table>
        <thead>
            <tr>
            <th>ID</th>
            <th>Points</th>
            <th>House ID</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student):?>
                <tr>
                <td><?php echo $student['id'];?></td>
                <td><?php echo $student['points'];?></td>
                <td><?php echo $student['house_id'];?></td>
                <td>
                <a href="/students/delete/<?php echo $student['id'];?>">Delete</a>
                </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>