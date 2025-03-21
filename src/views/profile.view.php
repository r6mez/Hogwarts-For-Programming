<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="styles/defaults.css">
    <style>
        .profile-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .profile-info {
            display: flex;
            align-items: center;
        }
        
        p {
            margin: 0;
            padding: 0;
        }
        .house-logo {
            width: 70px;
            height: 70px;
            margin-right: 15px;
            border-radius: 50%;
            padding: 20px;
        }
        .user-details {
            display: flex;
            flex-direction: column;
        }
        .points-container {
            display: flex;
            align-items: center;
            font-size: 18px;
        }
        .coins-icon {
            width: 40px;
            height: 40px;
            margin-left: 5px;
        }

        button {
            padding: 10px;
            background-color: var(--button-color);
            color: var(--text-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        button:hover {
            background-color: var(--button-hover-color);
        }
    </style>
</head>
<body>
    <?php 
        include __DIR__ . '/partials/navbar.php'; 
        $houseColors = [
            'Gryffindor' => '#740001',
            'Hufflepuff' => '#ecb939',
            'Ravenclaw' => '#0e1a40',
            'Slytherin' => '#1a472a'
        ];
        if ($user['type'] === 'Professor') {
            $houseLogo = 'Hogwarts.png';
            $houseColor = '#000000';
            $points = 'Endless Points';
            $houseDetails = 'Professor - ' . htmlspecialchars($user['experience']);
        } else {
            $houseLogo = htmlspecialchars($user['house']) . ".png";
            $houseColor = $houseColors[$user['house']];
            $points = $user['points'] . ' Points';
            $houseDetails = $user['type'] . ' - ' . $user['house'];
        }
    ?>
    <div class="profile-container content-wrapper">
        <div class="profile-info">
            <img src="/assets/<?= $houseLogo ?>" class="house-logo" style="background-color: <?= htmlspecialchars($houseColor) ?>;">
            <div class="user-details">
                <h2 class="name"><?= $user['name'] ?></h2>
                <p class="email"><?= $user['email'] ?></p>
                <?php if ($houseDetails): ?>
                    <p class="details"><?= $houseDetails ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <div class="points-container">
                <span><?= $points ?></span>
                <img src="/assets/point.png" alt="Coins Icon" class="coins-icon">
            </div>
            <button onclick="location.href='/profile/edit'">
                Edit Profile
            </button> 
        </div>
    </div>
</body>
</html>

