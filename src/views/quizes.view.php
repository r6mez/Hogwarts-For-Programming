<!DOCTYPE html>
<html>

<head>
    <title>Quizzes</title>
    <link rel="stylesheet" href="styles/defaults.css">
    <style>
        body {
            background-size: cover;
            color: var(--text-color);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .content-wrapper {
            margin-top: 120px;
            width: 90%;
            max-width: 1200px;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--button-hover-color);
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .quiz-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .quiz-card {
            background-color: var(--secondary-background-color);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .quiz-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .quiz-card h3 {
            margin: 0 0 10px;
            color: var(--text-color);
            font-size: 1.5rem;
        }

        .quiz-card p {
            margin: 0;
            color: var(--text-color-secondary);
            font-size: 1rem;
        }

        .result-button, .solve-button {
            margin-top: 15px;
            padding: 10px 15px;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .result-button {
            background-color: var(--button-color);
            color: white;
        }

        .result-button:hover {
            background-color: var(--button-hover-color);
        }

        .solve-button {
            background-color: rgb(202, 49, 49);
            color: white;
        }

        .solve-button:hover {
            background-color: rgb(255, 55, 55);
        }

        .coins-icon {
            width: 23px;
            height: 23px;
            vertical-align: middle;
        }

        p.no-quizzes {
            font-size: 1.2rem;
            color: var(--text-color-secondary);
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <div class="content-wrapper">
        <h1>Your Quizzes</h1>
        <div class="quiz-list">
            <?php if (!empty($quizzes)): ?>
                <?php foreach ($quizzes as $quiz): ?>
                    <div class="quiz-card">
                        <h3><?= htmlspecialchars($quiz['course_name']) ?></h3>
                        <p style="font-weight: normal;">
                            <img src="/assets/point.png" alt="Coins Icon" class="coins-icon">
                            <?= htmlspecialchars($quiz['score']) ?> 
                            Points 
                        </p>
                        <?php if ($quiz['taken']): ?>
                            <div>
                                <form action="/quizResult" method="GET">
                                    <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quiz['id']) ?>">
                                    <button class="result-button">View Result</button>
                                </form>
                            </div>
                        <?php else: ?>
                            <form action="/solveQuiz" method="POST">
                                <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quiz['id']) ?>">
                                <button type="submit" class="solve-button">Solve Quiz</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-quizzes">You have no quizzes, you can rest, soldier...</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>