<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>My Courses</title>
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
        <div class="nav">
            <ul>
                <li><a href="/courses" class="<?= strpos($_SERVER['REQUEST_URI'], '/courses') === 0 ? 'active' : '' ?>">Available Courses</a></li>
                <li><a href="/MyCourses" class="<?= strpos($_SERVER['REQUEST_URI'], '/MyCourses') === 0 ? 'active' : '' ?>">My Courses</a></li>
            </ul>
        </div>
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