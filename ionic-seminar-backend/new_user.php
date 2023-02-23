<?php
require "db.php";
$results = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : false;
    $dataArguments = [
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password']
    ];
    $queryString = "";

    if ($user_id){
        $queryString = "UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, password=:password WHERE users.id=:user_id";
        $dataArguments[':user_id'] = $user_id;
    } else 
        $queryString = "INSERT INTO users(first_name,last_name,email,password) VALUES (:first_name, :last_name, :email, :password)";
    

    try {
        $stmt = $conn->prepare($queryString);
        $stmt->execute($dataArguments);
        
        $results['user_id'] = $user_id ? $user_id : $conn->lastInsertId();
        
        $results['user'] = $conn->query("SELECT users.id, users.first_name, users.last_name, users.email FROM users WHERE users.id={$results['user_id']}")->fetchAll(PDO::FETCH_OBJ);
        
        echo json_encode($results);
    } catch (PDOException $e){
        var_dump($e);
    }
    
}
?>