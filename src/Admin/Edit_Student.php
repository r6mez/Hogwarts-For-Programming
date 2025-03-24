<?php
function updateStudent($conn) 
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
    {
        return;
    }
    try 
    {
        if (!isset($_POST['id']) || !is_numeric($_POST['id']))throw new Exception("Invalid student ID");
        if (empty($_POST['name'])) throw new Exception("Student name cannot be empty");
        $studentId = $_POST['id'];
        $studentName = trim($_POST['name']);
        $stmt = $conn->prepare("UPDATE students SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $studentName, PDO::PARAM_STR);
        $stmt->bindParam(':id', $studentId, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount()>0)
         {
            header("Location: students.php?message=Student+updated+successfully");
            exit();
        }
         else throw new Exception("No changes made or student not found");
        
    } 
    catch (PDOException $e)
    {
        throw new Exception("Database error: " . $e->getMessage());
    }
}
function getStudent($conn, $id) 
{
    try 
    {
        $stmt = $conn->prepare("SELECT id, name FROM students WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } 
    catch (PDOException $e) 
    {
        throw new Exception("Database error: " . $e->getMessage());
    }
}
try 
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') updateStudent($conn);
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) 
    {
        throw new Exception("Invalid student ID");
    }
    $studentId = $_GET['id'];
    $student = getStudent($conn, $studentId);
    if (!$student)
    {
        throw new Exception("Student not found");
    }
} 
catch (Exception $e) 
{
    header("Location: students.php?error=" . urlencode($e->getMessage()));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="styles/defaults.css">
</head>
<body>
<div class="container">
    <h1>Edit Student</h1>
    
    <form method="POST" action="edit_student.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($student['id']); ?>">
        
        <div class="form-group">
            <label for="name">Student Name:</label>
            <input type="text" id="name" name="name" 
                   value="<?php echo htmlspecialchars($student['name']); ?>" required>
        </div>
        
        <button type="submit" class="btn">Update Student</button>
        <a href="students.php" class="btn cancel">Cancel</a>
    </form>
</div>
</body>
</html>