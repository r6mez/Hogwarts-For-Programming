<!DOCTYPE html>
<html>

<head>
    <title>Solve Quiz</title>
    <link rel="stylesheet" href="styles/defaults.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .content-wrapper {
            margin-top: 120px;
            width: 90%;
            max-width: 800px;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--button-hover-color);
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .question {
            background-color: var(--secondary-background-color);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .question p {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .options {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }

        label {
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid var(--button-color);
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
            margin-right: 10px;
        }

        input[type="radio"]:checked {
            background-color: var(--button-color);
            border-color: var(--button-hover-color);
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            background-color: var(--button-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: var(--button-hover-color);
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <div class="content-wrapper">
        <h1>Solve Quiz</h1>
        <form action="/submitQuiz" method="POST">
            <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quiz_id) ?>">
            <?php foreach ($questions as $question): ?>
                <div class="question">
                    <p><?= htmlspecialchars($question['body']) ?></p>
                    <div class="options">
                        <label>
                            <input type="radio" name="answers[<?= $question['id'] ?>]" value="1" required> True
                        </label>
                        <label>
                            <input type="radio" name="answers[<?= $question['id'] ?>]" value="0" required> False
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>
            <button type="submit">Submit Quiz</button>
        </form>
    </div>
</body>

</html>
