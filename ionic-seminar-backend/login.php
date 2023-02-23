<?php
require "db.php";
$results = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  try {
    
    $stmt = $conn->prepare("SELECT users.id, users.first_name, users.last_name, users.email FROM users WHERE users.email=:email AND users.password=:password");

    $stmt->execute([
      ':email' => $_POST['email'],
      ':password' => $_POST['password']
    ]);

    $results['users'] = $stmt->fetchAll(PDO::FETCH_OBJ);
    
    echo json_encode($results);
  } catch (PDOException $e){
    var_dump($e);
  }
    
}
?>
