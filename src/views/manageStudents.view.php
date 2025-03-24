<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
    <link rel="stylesheet" href="/styles/defaults.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid var(--text-color);
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: var(--secondary-background-color);
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--button-color);
            color: var(--text-color);
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .button:hover {
            background-color: var(--button-hover-color);
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <div class="content-wrapper">
        <h1>Manage Students</h1>
        <a href="/manageStudents/create" class="button">Add New Student</a>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Points</th>
                    <th>House</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                        <td><?= htmlspecialchars($student['email']) ?></td>
                        <td><?= htmlspecialchars($student['points']) ?></td>
                        <td><?= htmlspecialchars($student['house']) ?></td>
                        <td>
                            <a href="/manageStudents/edit?id=<?= $student['id'] ?>">Edit</a>
                            <a href="/manageStudents/delete?id=<?= $student['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
