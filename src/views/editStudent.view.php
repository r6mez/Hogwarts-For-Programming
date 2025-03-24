<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="/styles/defaults.css">
    <style>
        form {
            background-color: var(--secondary-background-color);
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: var(--text-color);
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 4px;
            background-color: var(--input-background-color);
            color: var(--text-color);
            box-sizing: border-box; /* Fix for overflow */
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
        <h1>Edit Student</h1>
        <form action="/manageStudents/edit" method="POST">
            <input type="hidden" name="id" value="<?= $student['id'] ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>
            <label for="points">Points:</label>
            <input type="number" id="points" name="points" value="<?= htmlspecialchars($student['points']) ?>" required>
            <label for="house_id">House:</label>
            <select id="house_id" name="house_id" required>
                <?php foreach ($houses as $house): ?>
                    <option value="<?= $house['id'] ?>" <?= $house['id'] == $student['house_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($house['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
