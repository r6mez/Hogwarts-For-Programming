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
}