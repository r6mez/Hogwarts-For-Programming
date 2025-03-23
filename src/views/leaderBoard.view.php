<!DOCTYPE html>
<html>

<head>
    <title>leaderboard</title>
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
    </div>
</body>

</html>