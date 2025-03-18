<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles/defaults.css">
    <style>
        .logo {
            width: 120px;
            height: 120px;
            margin: 0 auto;
            display: block;
        }

        h1 {
            text-align: center;
            color: var(--text-color);
            margin-bottom: 0;
        }

        .title {
            margin-bottom: 20px;
            color: var(--text-color);
            text-align: center;
        }

        form {
            background-color: var(--form-background-color);
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

        input[type="checkbox"] {
            margin-right: 10px;
            accent-color: var(--button-color);
            transform: scale(1.2);
            cursor: pointer;
        }

        button {
            padding: 10px;
            background-color: var(--button-color);
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: var(--button-hover-color);
        }

        .goToLogin {
            text-align: center;
            margin-top: 20px;
            color: var(--text-color);
        }

        .link {
            color: var(--button-color);
        }
    </style>
</head>

<body>
    <form action="/register/submit" method="POST">
        <img src="/assets/slytherin.png" class="logo">
        <h1>Welcome !</h1>
        <div class="title">Register to Hogwarts School</div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label>
            <input type="checkbox" id="accept" name="accept" required>
            I accept to be a part of this magical world
        </label>

        <?php if (isset($errors) && !empty($errors)): ?>
            <ul style="color: red;">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <button type="submit">Register</button>
        <div class="goToLogin"> Already have an account? <a class="link" href="/login">Login</a></div>
    </form>
</body>

</html>