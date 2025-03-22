<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
</head>
<body>
    <h1>Courses</h1>
    <form action="/courses/create" method="POST">
            <input type="text" name="name" placeholder="Course Name" required>
            <input type="number" name="id_prof" placeholder="Professor ID" required>
            <button type="submit">Add Course</button>
    </form>
    <table>
        <thead>
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Professor ID</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($courses as $course):?>
            <tr>
            <td><?php echo $course['id']; ?></td>
            <td><?php echo $course['name']; ?></td>
            <td><?php echo $course['id_prof']; ?></td>
            <td>
            <a href="/courses/delete/<?php echo $course['id']; ?>">Delete</a>
            </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</body>
</html>