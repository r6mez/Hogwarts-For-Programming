<?php
namespace App\Controllers;

use App\Core\Database;
use App\Core\Application;
class MessageController 
{
    public  function  showReceivedMessage()
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT m.isread , m.id, u.name , u.email , m.connent , m.sent_at from message m
                                join users u on u.id = sender_id 
                                where resiever_id = :id
                                order by isread asc , sent_at DESC ");
        $stmt->execute([':id' => $_SESSION['user']['id']]);
        $messages = $stmt->fetchAll();
        return Application::view('owlpost', ['messages' => $messages]);
    }
    public  function showMessage()
    {
        $data = $_POST;
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("UPDATE  message 
                                set isread = true
                                where id = :id ");
        $stmt->execute([':id' => $_POST['message_id']]);
        return Application::view('/message', ['data' => $data]);
        
    }
    public function sendMessage()
    {
        
        return Application::view('sendMessage');
    }
    public function SendMessageSubmit(){
        $data = $_POST;
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT id from users
                                where email = :email ");
        $stmt->execute([':email' => $data['email']]);
        $receiveruser = $stmt->fetch();
        
        $stmt = $pdo->prepare("INSERT into message (resiever_id , sender_id , connent)
                                values (:receiverId ,:userId , :content ) ");
        $stmt->execute([':receiverId' => $receiveruser['id'] , 
                        ':userId' => $_SESSION['user']['id']
                        , ':content' => $data['content']]);
        header('Location: /OwlPost');
        exit;
    }
    public function deleteMessage(){
        $data = $_POST;
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE from message
                                where id = :id ");
        $stmt->execute([':id' => $_POST['message_id']]);
        header('Location: /OwlPost');
        exit;
    }

    public function showChats()
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("
            SELECT 
                CASE 
                    WHEN sender_id = :userId THEN resiever_id
                    ELSE sender_id
                END AS participant_id,
                u.name AS participant_name,
                MAX(m.connent) AS last_message,
                MAX(m.sent_at) AS last_message_time
            FROM message m
            JOIN users u ON u.id = CASE 
                                    WHEN sender_id = :userId THEN resiever_id
                                    ELSE sender_id
                                  END
            WHERE sender_id = :userId OR resiever_id = :userId
            GROUP BY participant_id, participant_name
            ORDER BY last_message_time DESC
        ");
        $stmt->execute([':userId' => $_SESSION['user']['id']]);
        $chats = $stmt->fetchAll();
        return Application::view('chats', ['chats' => $chats]);
    }

    public function showChatMessages()
    {
        $participantId = $_GET['participant_id'];
        $pdo = Database::getInstance();

        // Fetch participant name
        $stmt = $pdo->prepare("SELECT name FROM users WHERE id = :participantId");
        $stmt->execute([':participantId' => $participantId]);
        $participant = $stmt->fetch();

        // Fetch chat messages
        $stmt = $pdo->prepare("
            SELECT 
                m.id,
                m.connent AS message_content,
                m.sent_at,
                m.isread,
                CASE 
                    WHEN m.sender_id = :userId THEN 'sender'
                    ELSE 'receiver'
                END AS message_type
            FROM message m
            WHERE (m.sender_id = :userId AND m.resiever_id = :participantId)
               OR (m.sender_id = :participantId AND m.resiever_id = :userId)
            ORDER BY m.sent_at ASC
        ");
        $stmt->execute([
            ':userId' => $_SESSION['user']['id'],
            ':participantId' => $participantId
        ]);
        $messages = $stmt->fetchAll();

        return Application::view('chatMessages', [
            'messages' => $messages,
            'participantId' => $participantId,
            'participant_name' => $participant['name'] ?? 'Unknown'
        ]);
    }

    public function sendMessageToChat()
    {
        $data = $_POST;
        $pdo = Database::getInstance();
        $errors = [];

        // Validate message content
        $data['content'] = trim($data['content']);
        if (empty($data['content'])) {
            $errors[] = 'Message cannot be empty.';
        }

        // If there are errors, redirect back with errors
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: /chat/messages?participant_id=' . $data['participant_id']);
            exit;
        }

        $stmt = $pdo->prepare("
            INSERT INTO message (resiever_id, sender_id, connent)
            VALUES (:receiverId, :userId, :content)
        ");
        $stmt->execute([
            ':receiverId' => $data['participant_id'],
            ':userId' => $_SESSION['user']['id'],
            ':content' => $data['content']
        ]);

        header('Location: /chat/messages?participant_id=' . $data['participant_id']);
        exit;
    }

    public function createChat()
    {
        $data = $_POST;
        $pdo = Database::getInstance();
        $errors = [];

        if (empty($data['email'])) {
            $errors[] = 'Email is required.';
        } else {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->execute([':email' => $data['email']]);
            $receiverUser = $stmt->fetch();
            if (!$receiverUser) {
                $errors[] = 'User not found.';
            }
        }

        // Validate message
        $data['message'] = trim($data['message']);
        if (empty(trim($data['message']))) {
            $errors[] = 'Message cannot be empty.';
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: /chat/new');
            exit;
        }

        // Insert the initial message
        $stmt = $pdo->prepare("
            INSERT INTO message (resiever_id, sender_id, connent)
            VALUES (:receiverId, :userId, :content)
        ");
        $stmt->execute([
            ':receiverId' => $receiverUser['id'],
            ':userId' => $_SESSION['user']['id'],
            ':content' => $data['message']
        ]);

        header('Location: /chat/messages?participant_id=' . $receiverUser['id']);
        exit;
    }
}