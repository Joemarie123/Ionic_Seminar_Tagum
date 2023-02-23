<?php
require "db.php";
$results = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
   
    try {
         
        $user = $conn->prepare("SELECT * FROM users WHERE users.id=:user_id");
        $user->execute([':user_id' => $_POST['user_id']]);
        $user = $user->fetch(PDO::FETCH_OBJ);

        if ($user){
            $results['deleted_user'] = $user;

            $stmt = $conn->prepare("DELETE FROM users WHERE users.id=:user_id");
            $stmt->execute([
                ':user_id' => $_POST['user_id']
            ]);
        } else {
            $results = [
                'status' => "ERROR",
                'message' => "User id is not valid."
            ];
        }
        
       
        echo json_encode($results);
    } catch (PDOException $e){
        var_dump($e);
    }
    
}
?>