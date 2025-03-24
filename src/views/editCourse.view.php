<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
    <link rel="stylesheet" href="/styles/defaults.css">
    <style>
        form {
            background-color: var(--secondary-background-color);
            padding: 30px; /* Increased padding */
            border-radius: 8px;
            max-width: 400px;
            margin: 20px auto; /* Added margin for spacing */
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
            width: 100%;
            padding: 10px;
            background-color: var(--button-color);
            color: var(--text-color);
            border: none;
            border-radius: 4px;
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
        <h1>Edit Course</h1>
        <form action="/manageCourses/edit" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($course['id']) ?>">
            <label for="name">Course Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($course['name']) ?>" required>
            <label for="id_prof">Professor:</label>
            <select id="id_prof" name="id_prof" required>
                <?php foreach ($professors as $professor): ?>
                    <option value="<?= $professor['id'] ?>" <?= $professor['id'] == $course['id_prof'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($professor['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
