<!DOCTYPE html>
<html>
<head>
    <title>Manage Courses</title>
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

        form {
            margin-top: 20px;
            background-color: var(--secondary-background-color);
            padding: 30px; /* Increased padding */
            border-radius: 8px;
            box-sizing: border-box; /* Prevent overflow */
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: var(--text-color);
        }

        input, select {
            width: 100%; /* Set width to 100% */
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 4px;
            background-color: var(--input-background-color);
            color: var(--text-color);
            box-sizing: border-box; /* Prevent overflow */
        }

        button {
            padding: 10px 20px;
            background-color: var(--button-color);
            color: var(--text-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: var(--button-hover-color);
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <div class="content-wrapper">
        <h1>Manage Courses</h1>
        <a href="/manageCourses/create" class="button">Add New Course</a>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Professor</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?= htmlspecialchars($course['name']) ?></td>
                        <td><?= htmlspecialchars($course['professor']) ?></td>
                        <td>
                            <a href="/manageCourses/edit?id=<?= $course['id'] ?>">Edit</a>
                            <a href="/manageCourses/delete?id=<?= $course['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
