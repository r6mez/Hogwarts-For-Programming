<!DOCTYPE html>
<html>

<head>
    <title>Quiz Result</title>
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

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background-color: var(--secondary-background-color);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        li p {
            margin: 5px 0;
            font-size: 1rem;
        }

        li p strong {
            color: var(--button-hover-color);
        }

        .points {
            font-size: 1.5rem;
            color: var(--button-hover-color);
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .points h2, .points img {
            margin: 0 5px;
        }

        .coins-icon {
            width: 40px;
            height: 40px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <div class="content-wrapper">
        <h1>Quiz Result</h1>
        <?php if (isset($error)): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php else: ?>
            <ul>
                <?php foreach ($results as $result): ?>
                    <li>
                        <p><strong>Question:</strong> <?= htmlspecialchars($result['body']) ?></p>
                        <p><strong>Your Answer:</strong> <?= $result['student_answer'] ? 'True' : 'False' ?></p>
                        <p><strong>Correct Answer:</strong> <?= $result['correct_answer'] ? 'True' : 'False' ?></p>
                        <p style="color: <?= $result['student_answer'] == $result['correct_answer'] ? 'green' : 'red' ?>;">
                            <?= $result['student_answer'] == $result['correct_answer'] ? 'Correct' : 'Wrong' ?>
                        </p>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="points">
                <h2>You received +<?= htmlspecialchars($awardedPoints) ?> points!</h2>
                <img src="/assets/point.png" alt="Coins Icon" class="coins-icon">
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
