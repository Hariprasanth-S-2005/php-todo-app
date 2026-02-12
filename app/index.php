<?php
$host = getenv("DB_HOST");
$user = getenv("DB_USER");
$pass = getenv("DB_PASS");
$db   = getenv("DB_NAME");

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed");
}

$conn->query("CREATE TABLE IF NOT EXISTS todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(255) NOT NULL
)");

if (isset($_POST['task'])) {
    $task = $_POST['task'];
    $conn->query("INSERT INTO todos(task) VALUES('$task')");
}

$result = $conn->query("SELECT * FROM todos");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Todo App</title>
</head>
<body>
<h2>PHP Todo App (ECS Production)</h2>

<form method="post">
    <input name="task" required>
    <button>Add</button>
</form>

<ul>
<?php while($row = $result->fetch_assoc()) { ?>
    <li><?php echo $row['task']; ?></li>
<?php } ?>
</ul>

</body>
</html>
