<!DOCTYPE html>
<html>

<head>
    <title>leaderboard</title>
    <link rel="stylesheet" href="../styles/defaults.css">
    <style>
        .nav {
            padding: 20px;
            display: flex;
            justify-content: start;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        li {
            position: relative;
        }

        .nav a {
            text-decoration: none;
            color: #bbb;
            font-size: 16px;
            font-weight: bold;
            padding: 5px 10px;
            position: relative;
            margin: 10px;
        }

        a.active {
            color: var(--button-hover-color);
            font-weight: bold;
            text-shadow: 0 0 10px var(--button-hover-color);
        }

        a:hover {
            color: var(--button-hover-color);
        }

        .profile-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            margin: 0;
            border-radius: 20px;
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-container:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(173, 255, 129, 0.8), 0 0 30px rgba(122, 255, 118, 0.6);
        }

        .profile-info {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .profile-info h1 {
            margin-right: 20px;
            color: var(--button-hover-color);
            text-shadow: 0 0 10px rgba(173, 255, 129, 0.8), 0 0 20px rgba(122, 255, 118, 0.6);
        }

        p {
            margin: 0;
            padding: 0;
        }

        .house-logo {
            width: 100px;
            height: 100px;
            margin-right: 15px;
            border-radius: 50%;
            padding: 5px;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .points-container {
            display: flex;
            align-items: center;
            font-size: 28px;
            font-weight: bold;
        }

        .coins-icon {
            width: 50px;
            height: 50px;
        }

        .leaderboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <?php include __DIR__ . '/partials/navbar.php'; ?>
        <div class="nav">
            <ul>
                <li><a href="/leaderBoard/students" class="<?= strpos($_SERVER['REQUEST_URI'], '/leaderBoard/students') === 0 ? 'active' : '' ?>">Student Leaderboard</a>
                <li><a href="/leaderBoard/houses" class="<?= strpos($_SERVER['REQUEST_URI'], '/leaderBoard/houses') === 0 ? 'active' : '' ?>">Houses Leaderboard</a>
            </ul>
        </div>
        <div class="leaderboard-container">
            <?php $i = 1; ?>
            <?php foreach ($students as $student): ?>
                <?php
                $houseColors = [
                    'Gryffindor' => '#740001',
                    'Hufflepuff' => '#ecb939',
                    'Ravenclaw' => '#0e1a40',
                    'Slytherin' => '#1a472a'
                ];
                $houseLogo = htmlspecialchars($student['house']) . ".png";
                $houseColor = $houseColors[$student['house']];
                $points = $student['points'] . ' Points';
                $houseDetails = $student['house'];
                ?>
                <div class="profile-container content-wrapper">
                    <div class="profile-info">
                        <h1><?= '#' . $i ?></h1>
                        <img src="/assets/<?= $houseLogo ?>" class="house-logo" style="background-color: <?= htmlspecialchars($houseColor) ?>;">
                        <div class="user-details">
                            <h2 class="name"><?= $student['name'] ?></h2>
                            <?php if ($houseDetails): ?>
                                <p class="details"><?= $houseDetails ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <div class="points-container">
                            <span><?= $student['points'] ?></span>
                            <img src="/assets/point.png" alt="Coins Icon" class="coins-icon">
                        </div>
                    </div>
                </div>
                <br>
                <?php $i++; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>