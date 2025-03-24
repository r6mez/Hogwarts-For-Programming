<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizzes</title>
    <link rel="stylesheet" href="styles/defaults.css">

</head>
<body>
    <h1>Quizzes</h1>
    <form action="/quizzes/create" method="POST">
        <input type="number" name="id_cour" placeholder="Course ID" required>
        <input type="number" name="id_prof" placeholder="Professor ID" required>
        <input type="number" name="id_stud" placeholder="Student ID" required>
        <input type="number" name="score" placeholder="Score" required>
        <button type="submit">Add Quiz</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Course ID</th>
                <th>Professor ID</th>
                <th>Student ID</th>
                <th>Score</th>
                <th>Actions</th>
                </tr>
        </thead>
        <tbody>
            <?php foreach($quizzes as $quiz):?>
                <tr>
                <td><?php echo $quiz['id']; ?></td>
                <td><?php echo $quiz['id_cour']; ?></td>
                <td><?php echo $quiz['id_prof']; ?></td>
                <td><?php echo $quiz['id_stud']; ?></td>
                <td><?php echo $quiz['score']; ?></td>
                <td>
                <a href="/quizzes/delete/<?php echo $quiz['id']; ?>">Delete</a>
                </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</body>
</html>