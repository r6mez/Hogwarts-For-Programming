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

        .sell-btn {
            background-color: #d9534f;
            margin-top: 10px;
            padding: 5px 15px 5px 15px;
            color: var(--text-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .sell-btn:hover {
            background-color: #c9302c;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <?php include __DIR__ . '/partials/navbar.php'; ?>
        <h1> <?= 'From: '. htmlspecialchars($data['message_name']) ?></h1>
        <h1> <?= 'To: '. htmlspecialchars($_SESSION['user']['name']) ?></h1>
        <p> <?=  htmlspecialchars($data['message_content']) ?></p>
    </div>
</body>

</html>