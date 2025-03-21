<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
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
            margin: 0;
            padding: 0;
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors']);
    ?>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <form action="/profile/edit/submit" method="POST">
        <h1>Edit Profile</h1>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <?php if ($user['type'] === 'Professor'): ?>
            <label for="experience">Experience</label>
            <input type="text" id="experience" name="experience" value="<?= htmlspecialchars($user['experience'] ?? '') ?>">
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <ul class="errors">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
