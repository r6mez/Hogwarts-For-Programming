<!DOCTYPE html>
<html>
<head>
    <title>Create Quiz</title>
    <link rel="stylesheet" href="/styles/defaults.css">
    <style>
        form {
            background-color: var(--secondary-background-color);
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
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

        .content-wrapper h2 {
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <div class="content-wrapper">
        <h1>Create Quiz</h1>
        <form action="/manageQuizzes/create" method="POST">
            <label for="id_cour">Course:</label>
            <select id="id_cour" name="id_cour" required>
                <?php foreach ($courses as $course): ?>
                    <option value="<?= $course['id'] ?>"><?= htmlspecialchars($course['name']) ?></option>
                <?php endforeach; ?>
            </select>
            <label for="score">Score:</label>
            <input type="number" id="score" name="score" required>
            <button type="submit">Create Quiz</button>
        </form>

        <h2>Manage Questions</h2>
        <form action="/manageQuestions/create" method="POST">
            <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quiz_id ?? '') ?>">
            <label for="body">Question:</label>
            <input type="text" id="body" name="body" required>
            <label for="answer">Answer:</label>
            <select id="answer" name="answer" required>
                <option value="1">True</option>
                <option value="0">False</option>
            </select>
            <button type="submit">Add Question</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $question): ?>
                    <tr>
                        <td><?= htmlspecialchars($question['body']) ?></td>
                        <td><?= $question['answer'] ? 'True' : 'False' ?></td>
                        <td>
                            <a href="/manageQuestions/edit?id=<?= $question['id'] ?>">Edit</a>
                            <a href="/manageQuestions/delete?id=<?= $question['id'] ?>&quiz_id=<?= htmlspecialchars($quiz_id) ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
