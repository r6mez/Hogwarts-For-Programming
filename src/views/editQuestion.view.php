<!DOCTYPE html>
<html>
<head>
    <title>Edit Question</title>
    <link rel="stylesheet" href="/styles/defaults.css">
    <style>
        form {
            background-color: var(--secondary-background-color);
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: 20px auto;
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
        <h1>Edit Question</h1>
        <form action="/manageQuestions/edit" method="POST">
            <input type="hidden" name="id" value="<?= $question['id'] ?>">
            <input type="hidden" name="quiz_id" value="<?= $question['quiz_id'] ?>">
            <label for="body">Question:</label>
            <input type="text" id="body" name="body" value="<?= htmlspecialchars($question['body']) ?>" required>
            <label for="answer">Answer:</label>
            <select id="answer" name="answer" required>
                <option value="1" <?= $question['answer'] ? 'selected' : '' ?>>True</option>
                <option value="0" <?= !$question['answer'] ? 'selected' : '' ?>>False</option>
            </select>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
