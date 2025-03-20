
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
        
        label {
            margin-bottom: 5px;
            color: var(--text-color);
        }
        input {
            margin-bottom: 15px;
            width: 1000px;
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
            display: inline-block;
            background-color: #28a745; 
            color: white;
            border: none;
            width: 80px;
            height: 40px;
            padding: 3px 10px; 
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
        button:hover {
            background-color: #218838;
        }
        td form {
            display: inline-block; 
            margin: 0; 
            padding: 0; 
            background: transparent; 
            border: none;
        }
        
        .search-container {
    position: sticky; /* Keeps it fixed relative to its parent */
    margin-top: 50px;
    
    padding: 10px;
    z-index: 10; /* Ensures it stays above the table */
}
* {
  box-sizing: border-box;
}

body {
    position: center;
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding in columns */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* this adds the "card" effect */
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}

/* Responsive columns - one column layout (vertical) on small screens */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}
        
        
    </style>
</head>
<body>
    <?php
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors']);
    ?>
    <div>
    <div>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    </div>
    
    
    <?php if (!empty($course)): ?> 
        <div>
            <div class="search-container" >
                <form action="/courseSearch" method="get">
                    <input name="SearchName" type="text" placeholder="SearchName" required>
                    <button type="submit">Search</button>
                </form>
                <form action="/course">
                    <button type="submit">Back</button>
                </form>
            </div>
            <div>
            <table >
            <thead>
                <tr>
                    
                    <th>Course Name</th>
                    <th>Professor</th>
                    <th>Enroll</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($course as $cours): ?>
                    
                    <tr>
                        
                        <td><?= htmlspecialchars($cours['name']) ?></td>
                        <td><?= htmlspecialchars($cours['professor'] ?? "N/l") ?></td>
                        <td>
                            <form action="/enroll" method="post">
                                <input type="hidden" name="course_id" value="<?= htmlspecialchars($cours['id']) ?>">
                                <button type="submit" class="enroll-btn">
                                    <i class="fa fa-plus"></i> 
                                </button>
                            </form>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
            </div>
        
        </div>
    <?php else: ?>
        <h2>No courses found.</h2>
    <?php endif; ?>
    </form>
    </div>
    
</body>
</html>