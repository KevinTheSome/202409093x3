<?php

$config = [
    "host" => "localhost",
    "port" => "8889",
    "dbname" => "3x3",
    "user" => "root", 
    "password" => "root",
    "charset" => "UTF8"
];

$dbconn = new PDO ('mysql:'.http_build_query($config,"",";"));
$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbconn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $errors = [];
    if(isset($_POST["id"]))
    {
        $id = $_POST["id"];
        if($id <= 0) {
            $errors[] = "izdzēšanas id jābūt pozitīvam ciparam";
        }

        if(empty($errors)){

            $quary = $dbconn->prepare("DELETE FROM users WHERE id = :id");
            $quary->execute(["id" => $id]);

            header("Location: /");
        }else{ 
            var_dump($_POST);
            var_dump($errors);
            echo $id;
        }
    }
    echo "everything must be filled";
    
}

