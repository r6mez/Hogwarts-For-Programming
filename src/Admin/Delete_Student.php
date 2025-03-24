<?php
try 
{
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new Exception("Invalid student ID");
    }
    $studentId = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM students WHERE id = :id");
    $stmt->bindParam(':id', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) header("Location: students.php?message=Student+deleted+successfully");
    else                       header("Location: students.php?error=Student+not+found");
} 
catch (PDOException $e) 
{
    header("Location: students.php?error=" . urlencode("Database error: " . $e->getMessage()));
} 
catch (Exception $e) 
{
    header("Location: students.php?error=" . urlencode($e->getMessage()));
}

exit();
?>