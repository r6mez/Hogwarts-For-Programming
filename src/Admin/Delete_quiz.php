<?php
try 
{
    if (!isset($_GET['id']) || !is_numeric($_GET['id']))throw new Exception("Invalid quiz ID");
    $quizId = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM quiz WHERE id = :id");
    $stmt->bindParam(':id', $quizId, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) header("Location: quiz.php?message=Quiz+deleted+successfully");
    else header("Location: quiz.php?error=Quiz+not+found");
    
}
 catch (PDOException $e) 
{
    header("Location: quiz.php?error=" . urlencode("Database error: ".$e->getMessage()));
}
 catch (Exception $e)
{
    header("Location: quiz.php?error=" . urlencode($e->getMessage()));
}
exit();
?>