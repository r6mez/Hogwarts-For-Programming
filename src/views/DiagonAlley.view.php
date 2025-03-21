<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <link rel="stylesheet" href="styles/defaults.css">
    <style>
        input {
            margin-bottom: 15px;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            background-color: var(--input-background-color);
            color: var(--text-color);
        }


        button {
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

        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
        }

        button {
            margin-top: 10px;
            padding: 5px 15px 5px 15px;
            background-color: var(--button-color);
            color: var(--text-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: var(--button-hover-color);
        }

        .card-container {
            position: relative;
            color: var(--secondary-background-color);
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 10px;
            width: 100%;
            height: 100%;
        }

        .card {
            flex: 1 1 calc(33.33% - 10px);
            width: 30%;
            padding: 16px;
            background-color: var(--secondary-background-color);
            color: var(--text-color);
            border-radius: 10px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .card .logo {
            width: 100px;
            height: 100px;
            align-items: center;
        }

        .card-content {
            flex-direction: column;
        }

        .errors {
            color: rgb(201, 58, 58);
            margin: 10px 0px 0px 0px;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <?php include __DIR__ . '/partials/navbar.php'; ?>

        <?php if (!empty($items)): ?>
            <h1 style="display: flex; align-items: center;">
                <img src="/assets/Diagon.png" alt="Diagon Alley" style="width: 50px; height: 50px; margin-right: 10px;">
                Diagon Alley
            </h1>
            <h1 style="display: flex; align-items: center;">
                Your Points : 
                <img src="/assets/point.png" alt="Points Icon" style="width: 40px; height: 40px; margin-left: 10px;"> 
                <?= htmlspecialchars($_SESSION['student']['points']) ?> 
            </h1>
            <?php
            $errors = $_SESSION['errors'] ?? [];
            unset($_SESSION['errors']);
            ?>
            <div class="card-container">
                <?php foreach ($items as $item): ?>
                    <div class="card">
                        <div class="card-content">
                            <h3><?= htmlspecialchars($item['type']) ?></h3>
                            <p style="display: flex; align-items: center; margin: 0; "><?= 'Price:' ?> <img src="/assets/point.png" alt="Points Icon" style="width: 25px; height: 25px; "> <?= htmlspecialchars($item['price']) ?></p>
                            <form action="/buyItem" method="post">
                                <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['id']) ?>">
                                <input type="hidden" name="item_price" value="<?= htmlspecialchars($item['price']) ?>">
                                <button type="submit" class="enroll-btn">
                                    buy
                                </button>
                                <?php if (!empty($errors[$item['id']])): ?>
                                    <p class="errors">
                                        <?= htmlspecialchars($errors[$item['id']]) ?>
                                    </p>
                                <?php endif; ?>
                            </form>
                        </div>
                        <?php $link = "/assets" . "/" . $item['imag']; ?>
                        <img src="<?= htmlspecialchars($link) ?>" class="logo">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <h1>No items found</h1>
        <?php endif; ?>
    </div>
</body>

</html>