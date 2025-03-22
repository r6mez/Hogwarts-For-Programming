<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
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

        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
        }

        .card-container {
            position: relative;
            color: var(--secondary-background-color);
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%; 
        }

        .card {
            width: 30%;
            height: 100px;
            padding: 16px;
            background-color: var(--secondary-background-color);
            color: var(--text-color);
            border-radius: 10px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
        .card .logo {
        width: 105px;
        height: 70px;
        align-items: center;
    }
    </style>
</head>



<body>
    <div class="content-wrapper">
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <div>
        <h1>Profile</h1>
    </div>
        <div class="card-container">
            <div class="card">
                <div>
                <img src="/assets/Diagon.png" class="logo">
                    <form action="/DiagonAlley" method="get"> 
                        <button type="submit">Shopping</button>
                    </form>
                    
                </div>
                
            </div> 
        </div>
    </div>
    
</body>


</html>