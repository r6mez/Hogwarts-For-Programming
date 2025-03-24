<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" href="styles/defaults.css">
    <style>
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .card {
            flex: 1 1 calc(300px - 20px);
            background-color: var(--secondary-background-color);
            color: var(--text-color);
            border-radius: 10px;
            /* padding: 20px; */
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .card h3 {
            margin-bottom: 10px;
        }

        .card p {
            margin: 0;
        }

        .card h2 {
            color: var(--button-hover-color);
            text-shadow: 0 0 10px var(--button-hover-color), 0 0 20px var(--button-hover-color), 0 0 30px var(--button-hover-color);
        }

        .houses-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            justify-items: center;
            align-items: center;
        }

        .house-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: var(--secondary-background-color);
            color: var(--text-color);
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            width: 100%;
            margin: 20px;
        }

        .house-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2), 0 0 20px rgba(255, 255, 255, 0.6);
        }

        .house-img {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
            border-radius: 50%;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.8);
        }

        .house-card span {
            display: block;
            margin-top: 5px;
            font-size: 20px;
        }

        .quizzes-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: var(--secondary-background-color);
            color: var(--text-color);
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 20px;
        }

        .quizzes-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .quizzes-card h2 {
            margin-bottom: 15px;
        }

        .quizzes-card button {
            padding: 10px 20px;
            background-color: var(--button-color);
            color: var(--text-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        .quizzes-card button:hover {
            background-color: var(--button-hover-color);
        }

        .quizzes-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
            max-height: 270px;
            /* Set a maximum height */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }

        .quizzes-card li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* Center children vertically */
            background-color: var(--secondary-background-color);
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .quizzes-card li span {
            display: flex;
            align-items: center;
            /* Ensure image and text are aligned vertically */
            font-weight: bold;
        }

        .quizzes-card li img {
            width: 20px;
            height: 20px;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>

    <div class="content-wrapper">
        <?php
        if (isset($user) && $user['type'] === 'Professor') {
            $points = 'Endless Points';
        } else {
            $points = $_SESSION['student']['points'] . ' Points';
        }
        ?>
        <h1>Welcome, <?= htmlspecialchars($user['name'] ?? 'Guest') ?> !</h1>
        <h2 style="display: flex; align-items: center; margin-bottom: 20px;">
            Your Points :
            <img src="/assets/point.png" alt="Points Icon" style="width: 40px; height: 40px; margin-left: 10px;">
            <?= htmlspecialchars($points) ?>
        </h2>
        <div class="cards-container">
            <div class="card">
                <div class="houses-grid">
                    <?php
                    $houseColors = [
                        'Gryffindor' => '#7D0A0A',
                        'Hufflepuff' => '#D98324',
                        'Ravenclaw' => '#2D336B',
                        'Slytherin' => '#163020'
                    ];
                    ?>
                    <?php foreach ($houses as $house): ?>
                        <div class="house-card" style="background-color: <?= htmlspecialchars($houseColors[$house['name']]) ?>80;">
                            <img class="house-img" src="/assets/<?= htmlspecialchars($house['name']) ?>.png" alt="<?= htmlspecialchars($house['name']) ?> Logo">
                            <span style="font-weight: bold;"><?= htmlspecialchars($house['name']) ?></span>
                            <span style="display: flex; align-items: center; justify-content: center;">
                                <img src="/assets/point.png" alt="Points Icon" style="width: 30px; height: 30px; margin-right: 5px;">
                                <?= htmlspecialchars($house['points']) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php if (isset($user) && $user['type'] !== 'Professor'): ?>
            <div class="card quizzes-card">
                <h2>Quizzes</h2>
                <?php if (empty($quizzes)): ?>
                    <p>You have no quizzes available at the moment.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($quizzes as $quiz): ?>
                            <li>
                                <span><?= htmlspecialchars($quiz['course_name']) ?></span>
                                <span>
                                    <?= htmlspecialchars($quiz['score']) ?> Points
                                    <img src="/assets/point.png" alt="Points Icon">
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <button onclick="location.href='/quizes'">Go to Quizzes</button>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>