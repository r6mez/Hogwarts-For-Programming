<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Courses</title>
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
            background-color: var(--button-color);
            color: var(--text-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: var(--button-hover-color);
        }

        .card-container {
            position: relative;
            color: var(--secondary-background-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            width: 100%; /* Adjust container width to 100% */
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
        
        h3 {
            margin: 0;
            padding: 0;
            color: var(--text-color) ;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">        
        <?php include __DIR__ . '/partials/navbar.php'; ?>
        

        <?php if (!empty($course)): ?>
                <h1>Available Courses</h1>
                
                <div class="search-container">
                    <form action="/courseSearch" method="get">
                        <input name="SearchName" type="text" placeholder="Enter course name">
                        <button type="submit">Search</button>
                    </form>
                </div>

                <div class="card-container">
                    <?php foreach ($course as $cours): ?>
                        <div class="card">
                            <div>
                                <h3><?= htmlspecialchars($cours['name']) ?></h3>
                                <?= 'Prof. ' . htmlspecialchars($cours['professor'] ?? "N/l") ?>
                            </div>
                            <form action="/enroll" method="post">
                                <input type="hidden" name="course_id" value="<?= htmlspecialchars($cours['id']) ?>">
                                <button type="submit" class="enroll-btn">
                                    Enroll
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
        <?php else: ?>
            <h3>Nothing to see here.</h3>
        <?php endif; ?>
    </div>
</body>

</html>