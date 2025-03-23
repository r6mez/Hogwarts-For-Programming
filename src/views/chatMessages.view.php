<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../styles/defaults.css">

<head>
    <title>Chat Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: var(--primary-background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 90%;
            /* Changed from fixed max-width to percentage */
            max-width: 600px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: var(--heading-color);
            margin-bottom: 15px;
            margin-top: 50px;
        }

        .messages-box {
            flex: 1;
            width: 100%;
            max-height: 60vh;
            overflow-y: auto;
            border: 1px solid var(--button-color);
            padding: 10px;
            border-radius: 15px;
            background-color: var(--message-background-color);
            margin-bottom: 20px;
        }

        .message {
            /* padding: 5px; */
            border-bottom: 1px solid var(--border-color);
        }

        .message:last-child {
            border-bottom: none;
        }

        .sender {
            color: rgb(216, 54, 54);
            font-weight: bold;
        }

        .receiver {
            color: rgb(220, 154, 62);
            font-weight: bold;
        }

        form {
            width: 100%;
            display: flex;
            gap: 10px;
        }

        textarea {
            flex: 1;
            resize: none;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 14px;
            background-color: var(--input-background-color);
            color: var(--text-color);
        }

        button {
            width: 15%;
            /* Changed from fixed width to percentage */
            max-width: 70px;
            /* Added max-width for smaller screens */
            height: auto;
            /* Adjust height automatically */
            aspect-ratio: 1;
            /* Maintain square shape */
            background-color: var(--button-color);
            color: var(--text-color);
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        button:hover {
            background-color: var(--button-hover-color);
        }

        .date {
            color: rgb(130, 130, 130);
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 6vw;
                /* Adjust font size for smaller screens */
            }

            .container {
                padding: 10px;
                /* Reduce padding on smaller screens */
            }

            button {
                font-size: 14px;
                /* Adjust button font size */
            }
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <div class="container">
        <h1><?= htmlspecialchars($participant_name) ?></h1>
        <div class="messages-box">
            <?php foreach ($messages as $message): ?>
                <p class="message">
                    <strong class="<?= $message['message_type'] ?>">
                        <?= $message['message_type'] === 'sender' ? 'You' : htmlspecialchars($participant_name) ?>:
                    </strong>
                    <?= htmlspecialchars($message['message_content']) ?>
                    <em class="date">(<?= htmlspecialchars($message['sent_at']) ?>)</em>
                </p>
            <?php endforeach; ?>
        </div>
        <?php
        $errors = $_SESSION['errors'] ?? [];
        unset($_SESSION['errors']);
        ?>
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p style="color: rgb(201, 58, 58);"><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="/chat/send" method="POST">
            <input type="hidden" name="participant_id" value="<?= htmlspecialchars($_GET['participant_id']) ?>">
            <textarea name="content" placeholder="Type your message..." required></textarea>
            <button type="submit">➤</button>
        </form>
    </div>
</body>

</html>