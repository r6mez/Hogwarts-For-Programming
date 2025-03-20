
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Register</title>
    <link rel="stylesheet" href="styles/defaults.css">
    <style>
        .logo {
            width: 120px;
            height: 120px;
            margin: 0 auto;
            display: block;
        }
        h2 {
            text-align: center;
            color: var(--text-color);
            
        }
        .title {
            margin-bottom: 20px;
            color: var(--text-color);
            text-align: center;
        }
        /* form {
            background-color: var(--secondary-background-color);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
        } */
        label {
            margin-bottom: 5px;
            color: var(--text-color);
        }
        input {
            width: 1100;
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
        table {
            width: 1100px;
            border-collapse: collapse;
            background-color: #222;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #444;
        }
        th {
            background-color: #111;
            color: #0f0; 
        }
        tr:hover {
            background-color: #333;
        }
        button {
            background-color: #28a745; 
            color: white;
            border: none;
            padding: 3px 6px; 
            font-size: 12px;  
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #218838;
        }
        .goToLogin {
            text-align: center;
            margin-top: 20px;
            color: var(--text-color);
        }
        .link {
            color: var(--button-color);
        }
        .errors {
            color:rgb(201, 58, 58);
            margin: 0;
            padding: 0;
            padding-bottom: 20px;
            padding-left: 20px;
        }
        .enroll-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 3px 6px; 
            font-size: 10px;  
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px; 
            width: 30px; 
            height: 30px; 
        }
        .enroll-btn i {
            font-size: 12px;
        }
        .enroll-btn:hover {
            background-color: #218838;
        }
        
        .container {
            width: 100%;
            text-align: center; 
        }
    </style>
</head>

<body>
    <?php
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors']);
    ?>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    
    <?php if (!empty($Mycourse)): ?> 
        <div>
        <table >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Mycourse as $Mycours): ?>
                    <tr>
                        <td><?= htmlspecialchars($Mycours['id']) ?></td>
                        <td><?= htmlspecialchars($Mycours['name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    <?php else: ?>
        <h2>No Courses Found.</h2>
    <?php endif; ?> 
</body>

</html>