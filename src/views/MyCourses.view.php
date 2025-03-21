<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>My Courses</title>
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
            background-color: var(--delete-button-color);
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

        .card-container {
            position: relative;
            color: var(--secondary-background-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            width: 100%; 
        }

        .card {
            width: 100%;
            padding: 16px;
            background-color: var(--secondary-background-color);
            color: var(--text-color);
            border-radius: 10px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <div class="content-wrapper">
        <?php if (!empty($Mycourse)): ?>
            <h1><?= htmlspecialchars($_SESSION['user']['name']) ?>'s Courses</h1>
            <div class="card-container">
                <?php foreach ($Mycourse as $Mycours): ?>
                    <div class="card">
                        <div>
                            <h3><?= htmlspecialchars($Mycours['name']) ?></h3>
                            <?= 'Prof. ' . htmlspecialchars($Mycours['professor'] ?? "N/l") ?>
                        </div>
                        <form action="/deRegister" method="post">
                            <input type="hidden" name="course_id" value="<?= htmlspecialchars($Mycours['id']) ?>">
                            <button type="submit" class="disenroll-btn">
                                Disenroll
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <h3>You're not enrolled in any courses.</h3>
        <?php endif; ?>
    </div>
</body>

</html>