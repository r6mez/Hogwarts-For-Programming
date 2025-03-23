<!DOCTYPE html>
<html>

<head>
    <title>Owl Post</title>
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
            height: 30px;
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

        button {
            margin-top: 10px;
            padding: 5px 15px 5px 15px;
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
            flex-wrap: wrap;
            gap: 10px;
            width: 100%;
            height: 100%;
        }

        .card {
            flex: 1 1 calc(33.33% - 10px);
            width: 100%;
            padding: 16px;
            background-color: var(--secondary-background-color);
            color: var(--text-color);
            border-radius: 10px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .card .logo {
            width: 100px;
            height: 100px;
            align-items: center;
        }

        .card-content {
            flex-direction: column;
        }
        .card-content .delete_button {
            margin-top: 10px;
            padding: 5px 15px 5px 15px;
            background-color: var(--delete-button-color);
            color: var(--text-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        

        .errors {
            color: rgb(201, 58, 58);
            margin: 10px 0px 0px 0px;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <?php include __DIR__ . '/partials/navbar.php'; ?>
        <div class ="card-content">
            <h1 style="display: flex; align-items: center;">
                    <?= htmlspecialchars($_SESSION['user']['name']) . "'s Messages" ?>
            </h1>
            <button type="submit" onclick="location.href='/message/send'">
                    Send Message
            </button>
        </div>
        
        <?php if (!empty($messages)): ?>
            <?php
            $errors = $_SESSION['errors'] ?? [];
            unset($_SESSION['errors']);
            $selectedMessageId = $_POST['message_id'] ?? null;
            ?>
            <div class="card-container">
                <?php foreach ($messages as $message): ?>
                    <div class="card">
                        <div class="card-content">
                            <?php if (htmlspecialchars($message['isread']) == 1): ?>
                                <h3 style ='color :dimgray'><?= htmlspecialchars($message['name']) ?></h3>
                            <?php else: ?>
                                <h3><?= htmlspecialchars($message['name']) ?></h3>    
                            <?php endif; ?>   
                            
                            <form action="/message" method="post">
                                <input type="hidden" name="message_id" value="<?= htmlspecialchars($message['id']) ?>">
                                <input type="hidden" name="message_content" value="<?= htmlspecialchars($message['connent']) ?>">
                                <input type="hidden" name="message_name" value="<?= htmlspecialchars($message['name']) ?>">
                                <button type="submit">Show Message</button>
                            </form>
                            
                        </div>
                        <div class="card-content">
                        <?php if (htmlspecialchars($message['isread']) == 1): ?>
                                <h3 style ='color :dimgray'><?= htmlspecialchars($message['sent_at'])  ?></h3>
                                <form action="/message/delete" method="post">
                                    <input type="hidden" name="message_id" value="<?= htmlspecialchars($message['id']) ?>">
                                    <button type="submit" class="delete_button" >Delete</button>
                                </form>

                        <?php else: ?>
                                <h3><?= htmlspecialchars($message['sent_at'])  ?></h3>
                                <form action="/message/delete" method="post">
                                    <input type="hidden" name="message_id" value="<?= htmlspecialchars($message['id']) ?>">
                                    <button type="submit" class="delete_button" >Delete</button>
                                </form>
                        <?php endif; ?> 

                        </div>
                        
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <h1>No message</h1>
        <?php endif; ?>
    </div>
</body>

</html>