<!DOCTYPE html>
<html>
<head>
    <title>Start New Chat</title>
    <link rel="stylesheet" href="/styles/defaults.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: var(--secondary-background-color); 
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: var(--text-color);
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

        textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            background-color: var(--input-background-color);
            color: var(--text-color);
            resize: vertical;
            min-height: 100px;
        }

        button {
            padding: 10px;
            background-color: var(--button-color);
            color: var(--text-color);
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: var(--button-hover-color);
        }

        .errors {
            color: rgb(201, 58, 58);
            margin: 0px 0px 10px 0px;
            padding: 0;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <form action="/chat/create" method="POST">
        <h1>Start New Chat</h1>

        <label for="email">User Email</label>
        <input type="email" id="email" name="email" placeholder="Enter the user's email" required>
        
        <label for="message">Message</label>
        <textarea id="message" name="message" placeholder="Type your message..." required></textarea>
        
        <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <p class="errors"><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
        <?php endif; ?>

        <button type="submit">Start Chat</button>
    </form>
</body>
</html>
