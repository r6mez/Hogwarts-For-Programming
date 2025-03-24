<!DOCTYPE html>
<html>

<head>
    <title>DiagonAlley</title>
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
            background: linear-gradient(45deg, var(--button-color), var(--button-hover-color));
            color: var(--text-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(45deg, var(--button-hover-color), var(--button-color));
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start; /* Align cards to the left */
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
            margin: 0;
        }

        .card-content button {
            margin: 15px;
        }

        .errors {
            color: rgb(201, 58, 58);
            padding: 10px;
            font-size: 14px; 
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
            <h2 style="display: flex; align-items: center; margin-bottom: 20px;">
                Your Points : 
                <img src="/assets/point.png" alt="Points Icon" style="width: 40px; height: 40px; margin-left: 10px;"> 
                <?= htmlspecialchars($_SESSION['student']['points']) ?> 
            </h2>
            <?php
            $errors = $_SESSION['errors'] ?? [];
            unset($_SESSION['errors']);
            ?>
            <div class="card-container">
                <?php foreach ($items as $item): ?>
                    <div class="card">
                        <img src="<?= htmlspecialchars("/assets/" . $item['imag']) ?>" class="logo" alt="<?= htmlspecialchars($item['type']) ?>">
                        <div class="card-content">
                            <h3><?= htmlspecialchars($item['type']) ?></h3>
                            <p style="display: flex; align-items: center;">
                                <img src="/assets/point.png" alt="Points Icon" style="width: 30px; height: 30px;"> 
                                <?= htmlspecialchars($item['price']) ?>
                            </p>
                            <form action="/buyItem" method="post">
                                <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['id']) ?>">
                                <input type="hidden" name="item_price" value="<?= htmlspecialchars($item['price']) ?>">
                                <button type="submit" class="enroll-btn">buy</button>
                                <?php if (!empty($errors[$item['id']])): ?>
                                    <p class="errors"><?= htmlspecialchars($errors[$item['id']]) ?></p>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <h1>No items found</h1>
        <?php endif; ?>
    </div>
</body>

</html>