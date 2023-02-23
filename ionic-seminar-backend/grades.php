<?php
require "db.php";
$results = [];

$req = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['a']) ? $_GET['a'] : false;
if ($req == 'GET' && !$action){
    // read
    try {
        $grades = $conn->query("SELECT * FROM grades")->fetchAll(PDO::FETCH_OBJ);

        foreach ($grades as $grade){
            $user = $conn->query("SELECT * FROM users WHERE users.id={$grade->user_id}")
                ->fetch(PDO::FETCH_OBJ);
            
            $grade = (array)$grade;
            $grade['user'] = $user;

            $results[] = $grade;
        }

        $conn = null;
    } catch (PDOException $e){
        var_dump($e);
    }
} else if ($req == 'POST' && ($action == 'new' || $action == 'update')){
    $dataArgs = [
        ':subject' => $_POST['subject'],
        ':grade' => $_POST['grade'],
        ':remarks' => $_POST['remarks']
    ];
    $queryString = '';

    $isOkay = true;
    $grade_ = '';
    $user_ = '';

    if ($action == 'new'){
        // check the validity of the user
        $user = $conn->prepare("SELECT * FROM users WHERE users.id=:user_id");
        $user->execute([':user_id' => $_POST['user_id']]);
        $user = $user->fetch(PDO::FETCH_OBJ);

        if ($user){
            // valid
            $queryString = "INSERT INTO grades (user_id, subject, grade, remarks) VALUES(:user_id, :subject,:grade,:remarks)";
            $dataArgs[':user_id'] = $user->id;
            $user_ = $user;
        } else {
            // not valid
            $results = [
                'status' => 'ERROR',
                'message' => 'User id is not valid.'
            ];
            $isOkay = false;
        }


      
    } else if ($action == 'update'){
        // check the validity of grade
        $grade = $conn->prepare("SELECT * FROM grades WHERE grades.id=:grade_id");
        $grade->execute([':grade_id' => $_POST['grade_id']]);
        $grade  = $grade->fetch(PDO::FETCH_OBJ);
        if ($grade){
            // valid
            $queryString = "UPDATE grades SET grades.subject=:subject, grades.grade=:grade, grades.remarks=:remarks WHERE grades.id=:grade_id";
            $dataArgs[':grade_id'] = $_POST['grade_id'];
            $grade_ = $grade;
        } else {
             // not valid
             $results = [
                'status' => 'ERROR',
                'message' => 'Grade id is not valid.'
            ];
            $isOkay = false;
        }

       
    }

    if ($isOkay){
        try {
            $stmt = $conn->prepare($queryString);
            $stmt->execute($dataArgs);

            $grade_id = $action == 'update' ? $grade_->id : $conn->lastInsertId();

            $grade = $conn->query("SELECT * FROM grades WHERE grades.id=$grade_id")
                ->fetch(PDO::FETCH_OBJ);

            $results = [
                'status' => '1',
                'grade' => $grade
            ];
        } catch (PDOException $e){
            var_dump($e);
        }
    }

} else if ($req == 'POST' && $action == 'delete'){
    // validate the grade id
    $grade = $conn->prepare("SELECT * FROM grades WHERE grades.id=:grade_id");
    $grade->execute([':grade_id' => $_POST['grade_id']]);
    $grade = $grade->fetch(PDO::FETCH_OBJ);
    
    if ($grade){
        // valid then delete
        $stmt = $conn->prepare("DELETE FROM grades WHERE grades.id=:grade_id");
        $stmt->execute([':grade_id' => $_POST['grade_id']]);
        
        $results['deleted_grade'] = $grade;
    } else {
        $results = [
            'status' => 'ERROR',
            'message' => 'Grade id is not valid.'
        ];
    }
} else if ($req == 'GET' && $action == 'user' && isset($_GET['id'])){
    $user_id = $_GET['id'];

    $user = $conn->prepare("SELECT * FROM users WHERE users.id=:user_id");
    $user->execute([':user_id' => $user_id]);
    $user = $user->fetch(PDO::FETCH_OBJ);

    if ($user){
        // user is valid
        $grades = $conn->query("SELECT * FROM grades WHERE grades.user_id={$user->id}")->fetchAll(PDO::FETCH_OBJ);

        foreach ($grades as $grade){
            $user = $conn->query("SELECT * FROM users WHERE users.id={$grade->user_id}")
                ->fetch(PDO::FETCH_OBJ);
            
            $grade = (array)$grade;
            $grade['user'] = $user;

            $results[] = $grade;
        }

        $conn = null;
    } else {
        $results = [
            'status' => 'ERROR',
            'message' => 'User id is not valid.'
        ];
    }
} else {
    $results = [
        'status' => 'ERROR',
        'message' => 'Action not found.'
    ];
}

echo json_encode($results);
    

?>