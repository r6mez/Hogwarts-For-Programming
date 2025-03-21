
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
        
        .disenroll-btn {
            background-color:rgb(201, 58, 58);
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
        .disenroll-btn i {
            font-size: 12px;
        }
        .disenroll-btn:hover {
            background-color: rgb(201, 58, 58);
        }
        
        
        .search-container {
    position: relative; 
    left: 50%; 
    transform: translateX(-50%); 
    width: 50%; 
    padding: 10px 20px;
    display: flex;
    justify-content: center;
     gap: 10px;
    border-radius: 8px;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

* {
    margin: 0;
    padding: 0;
  box-sizing: border-box;
}

body {
   padding-top: 4px;
   
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
    top:150px;
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
    position: center;
    background-color: var(--secondary-background-color); /* Dark background */
    color: #EEF0E5;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); 
    border-radius: 8px;
    border: 1px solid #333; 
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
        
        <div class="card-container">
                <?php foreach ($Mycourse as $Mycours): ?>
                    <div class="card">
                    
                        <h3>Course Name: <?= htmlspecialchars($Mycours['name']) ?></h3>
                    
                        <?= 'Professor: '. htmlspecialchars($Mycours['professor'] ?? "N/l") ?>
                        <form action="/deRegister" method="post">
                                <input type="hidden" name="course_id" value="<?= htmlspecialchars($Mycours['id']) ?>">
                                <button type="submit" class="disenroll-btn">
                                    <i class="fa fa-minus"></i> 
                                </button>
                            </form>
                    </div>
                <?php endforeach; ?>
                </div>
        
    <?php else: ?>
        <h2>No Courses Found.</h2>
    <?php endif; ?> 
</body>

</html>