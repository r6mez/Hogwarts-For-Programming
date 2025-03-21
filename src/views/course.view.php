
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
            width: 50px; 
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
    position: relative; /* Fixes it at the top */
    /* top : 120px; */
    left: 50%; /* Centers it horizontally */
    transform: translateX(-50%); 
    width: 50%; /* Adjust width as needed */
    
    padding: 10px 20px;
   
    display: flex;
    justify-content: center;
    /* align-items: center; */
    gap: 10px;
    border-radius: 8px;
}

/* Ensure content doesn't hide behind the fixed search */
.container {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Prevent items from stretching */
}

* {
    margin: 0;
    padding: 0;
  box-sizing: border-box;
}

body {
   /* padding-top: 4px; */
   /* margin-top: 10px; */
   position: center;
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
  margin: 0 -5px;
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


/* Responsive columns - one column layout (vertical) on small screens */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}
.card-container {
    position: relative;
    left: 0px;
    /* top:150px; */
    color: #0f0; 
    display: flex;
    flex-direction: column; /* Single column */
    align-items: center; /* Center cards */
    gap: 20px; /* Space between cards */
    
    
}

/* Dark Mode Card Styling */
.card {
    
    width: 1000px;
    padding: 16px;
    /* text-align:; */
    background-color: var(--secondary-background-color); /* Dark background */
    color: #EEF0E5;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Darker shadow */
    border-radius: 8px;
    border: 1px solid #333; /* Subtle border */
}
body {
    padding-top: 500px; /* Adjust based on your navbar height */
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
            
            <div class="card-container">
                <?php foreach ($course as $cours): ?>
                    <div class="card">
                        <h3>Course Name: <?= htmlspecialchars($cours['name']) ?></h3>
                    
                        <?='Professor: ' . htmlspecialchars($cours['professor'] ?? "N/l") ?>

                        
                            <form action="/enroll" method="post">
                                <input type="hidden" name="course_id" value="<?= htmlspecialchars($cours['id']) ?>">
                                <button type="submit" class="enroll-btn">
                                    <i class="fa fa-plus"></i> 
                                </button>
                            </form>
                            
                        
                    </div>
                <?php endforeach; ?>
                </div>
            
                
        
        </div>
    <?php else: ?>
        <h2>No courses found.</h2>
    <?php endif; ?>
    </form>
    </div>
    
</body>
</html>