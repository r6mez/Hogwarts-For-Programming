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
            height: 150px;
            padding: 16px;
            background-color: var(--secondary-background-color);
            color: var(--text-color);
            border-radius: 10px;
            display: flex;
            flex-direction: row ;
            justify-content: space-between;
        }
        .card .logo {
        width: 50px;
        height: 50px;
        align-items: center;
    }
    .card-content {
        flex-direction: column ;
    }
    .errors {
            color: rgb(201, 58, 58);
            margin: 0;
            padding: 0;
            padding-bottom: 20px;
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <?php include __DIR__ . '/partials/navbar.php'; ?>
        
        <?php if (!empty($items)): ?>
            <h1>Diagon Alley </h1>
            <h1>Your Points : <?= htmlspecialchars($_SESSION['student']['points'])?> </h1>
            <?php
            $errors = $_SESSION['errors'] ?? [];
            unset($_SESSION['errors']);
            ?>
            <div class="card-container">
                <?php foreach ($items as $item): ?>
                    <div class="card">
                        <div class="card-content">
                                <h3><?= htmlspecialchars($item['type']) ?></h3>
                                <p><?='Price: '. htmlspecialchars($item['price']) ?></p>
                                <form action="/buyItem" method="post">
                                    <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['id']) ?>">
                                    <input type="hidden" name="item_price" value="<?= htmlspecialchars($item['price']) ?>">
                                    <button type="submit" class="enroll-btn">
                                        buy
                                    </button>
                                    <?php if (!empty($errors[$item['id']])): ?>
                                        <ul class="errors">
                                        <li><?= htmlspecialchars($errors[$item['id']]) ?></li>
                                        </ul>
                                    <?php endif; ?>
                                </form>
                        </div>
                        <?php $link = "/assets"."/" . $item['imag'] ; ?>
                        <img src="<?= htmlspecialchars($link) ?>" class="logo" >
                    </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
                <h1>No items found</h1>
        <?php endif;?>
    </div>
</body>
</html>