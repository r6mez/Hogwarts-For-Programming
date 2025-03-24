<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <link rel="stylesheet" href="styles/defaults.css">
    <style>
        .profile-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            margin: 0;
            border-radius: 20px;
            width: 100%;
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
            font-size: 18px;
        }

        .coins-icon {
            width: 40px;
            height: 40px;
            margin-left: 5px;
        }

        .edit-btn {
            padding: 10px;
            background-color: var(--button-color);
            color: var(--text-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        .edit-btn:hover {
            background-color: var(--button-hover-color);
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start; /* Align cards to the left */
            width: 100%;
        }

        .card {
            flex: 1 1 calc(250px - 20px); /* Ensure cards take up equal space */
            max-width: 300px;
            background-color: var(--secondary-background-color);
            color: var(--text-color);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .card .logo {
            width: 100%;
            margin-bottom: 10px;
            border-radius: 10px;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card-content h3 {
            margin: 0px 0;
        }

        .card-content p {
            font-size: 20px;
            margin: 0;
        }

        .card-content button {
            margin: 15px;
        }

        .sell-btn {
            background: linear-gradient(45deg, #d9534f, #c9302c);
            margin-top: 10px;
            padding: 5px 15px 5px 15px;
            color: var(--text-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .sell-btn:hover {
            background: linear-gradient(45deg, #c9302c, #a72820);
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <?php include __DIR__ . '/partials/navbar.php'; ?>
        <div>
            <h1 style="padding: 0; margin: 0;">Profile</h1>
        </div>
        <?php
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
                    <?php if ($user['type'] === 'Student' && isset($user['wand'])): ?>
                        <p class="details"><strong>Wand:</strong> <?= htmlspecialchars($user['wand']['woodtype']) ?> wood with <?= htmlspecialchars($user['wand']['coretype']) ?> core</p>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <div class="points-container">
                    <span><?= $points ?></span>
                    <img src="/assets/point.png" alt="Coins Icon" class="coins-icon">
                </div>
                <button onclick="location.href='/profile/edit'" class="edit-btn">
                    Edit Profile
                </button>
            </div>
        </div>
        <br>
        <h2>Your Magical Items</h2>
        <br>
        <?php if (!empty($magicalItems)): ?>
            <div class="card-container">
                <?php foreach ($magicalItems as $item): ?>
                    <div class="card">
                        <?php $link = "/assets/" . $item['imag']; ?>
                        <img src="<?= htmlspecialchars($link) ?>" class="logo">
                        <div class="card-content">
                            <h3><?= htmlspecialchars($item['type']) ?></h3>
                            <p style="display: flex; align-items: center; margin: 0;">
                                <?= 'Price: ' ?>
                                <img src="/assets/point.png" alt="Points Icon" style="width: 25px; height: 25px;">
                                <?= htmlspecialchars($item['price']) ?>
                            </p>
                            <form action="/sellItem" method="post">
                                <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['id']) ?>">
                                <input type="hidden" name="item_price" value="<?= htmlspecialchars($item['price']) ?>">
                                <button type="submit" class="sell-btn">Sell</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>You do not own any magical items.</p>
        <?php endif; ?>
    </div>
</body>

</html>