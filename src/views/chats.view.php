<!DOCTYPE html>
<html>

<head>
    <title>Chats</title>
    <link rel="stylesheet" href="styles/defaults.css">
    <style>
        body {
            background-color: var(--primary-background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px auto;
            max-width: 600px;
        }

        li {
            background-color: var(--secondary-background-color);
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        a {
            text-decoration: none;
            color: var(--link-color);
            font-size: 18px;
            flex-grow: 1;
        }

        a:hover {
            color: var(--link-hover-color);
        }

        .last-message {
            font-size: 14px;
            color: var(--text-muted-color);
            margin-top: 5px;
            color: rgb(130, 130, 130);
        }

        .arrow {
            font-size: 50px;
            color: var(--arrow-color);
            margin-left: 10px;
            color: rgb(130, 130, 130);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px auto;
            max-width: 600px;
        }

        .header-container h1 {
            margin: 0;
        }

        .header-container button {
            padding: 10px 15px;
            background-color: var(--button-color);
            color: var(--text-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .header-container button:hover {
            background-color: var(--button-hover-color);
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <div class="content-wrapper">
        <div class="header-container">
            <h1>Your Chats</h1>
            <button type="submit" onclick="location.href='/chat/new'">Start New Chat</button>
        </div>
        <ul>
            <?php foreach ($chats as $chat): ?>
                <li>
                    <a href="/chat/messages?participant_id=<?= htmlspecialchars($chat['participant_id']) ?>">
                        <?= htmlspecialchars($chat['participant_name']) ?>
                        <div class="last-message">
                            <?= htmlspecialchars($chat['last_message'] ?? 'No messages yet') ?> <br>
                            <em class="date"><?= htmlspecialchars($chat['last_message_time'] ?? '') ?></em>
                        </div>
                    </a>
                    <span class="arrow">></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>