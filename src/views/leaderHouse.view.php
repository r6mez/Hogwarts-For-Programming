<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <link rel="stylesheet" href="styles/defaults.css">
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
            font-family: Arial, sans-serif;
            margin: 0;
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



    </style>
</head>

<body>
    <div class="content-wrapper">
        <?php include __DIR__ . '/partials/navbar.php'; ?>
        <div class="nav">
            <ul>
                <li><a href="/students" class="<?= strpos($_SERVER['REQUEST_URI'], '/students') === 0 ? 'active' : '' ?>">Student Leaderboard</a>
                <li><a href="/houses" class="<?= strpos($_SERVER['REQUEST_URI'], '/houses') === 0 ? 'active' : '' ?>">Houses Leaderboard</a>
            </ul>
        </div>
        <?php $i = 1; ?>
        <?php foreach ($houses as $house): ?>
            
            <?php
            
            $houseColors = [
                'Gryffindor' => '#740001',
                'Hufflepuff' => '#ecb939',
                'Ravenclaw' => '#0e1a40',
                'Slytherin' => '#1a472a'
            ];
            
                $houseLogo = htmlspecialchars($house['name']) . ".png";
                $houseColor = $houseColors[$house['name']];
                $points = $house['points'] . ' Points';
                // $houseDetails = $student['house'];
            
            ?>
                <div class="profile-container content-wrapper">
                <div class="profile-info">
                    <img src="/assets/<?= $houseLogo ?>" class="house-logo" style="background-color: <?= htmlspecialchars($houseColor) ?>;">
                    <div class="user-details">
                        <h2 class="name"><?= $house['name'] ?></h2>
                        <?= 'RANK # '.$i .' ' ?>
                        
                        
                    </div>
                </div>
                <div>
                    <div class="points-container">
                        
                        
                        <span><?= $house['points'] ?></span>
                        <img src="/assets/point.png" alt="Coins Icon" class="coins-icon">
                    </div>
                    
                </div>
            </div>
            <br>
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>
</body>

</html>