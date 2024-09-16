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
    if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["number"]) && isset($_POST["pcode"]))
    {

        $name = $_POST["fname"];
        $lastname = $_POST["lname"];
        $phone = $_POST["number"];
        $pcode = $_POST["pcode"];
    
        $pattern = "/^[A-Z][a-zA-Z]*/";
        if(preg_match($pattern, $_POST["fname"]) == 0){
            $errors[] = "first name is not valid";
        }

        $pattern = "/^[A-Z][a-zA-Z]*/";
        if(preg_match($pattern, $_POST["lname"]) == 0){
            $errors[] = "last name is not valid";
        }

        $pattern = "/^[+ 0-9]*/";
        if(preg_match($pattern, $_POST["number"]) == 0){
            $errors[] = "phone number not valid make sure you have a + and a space then numbers";
        }

        $pattern = "/^[0-9-0-9]*/";
        if(preg_match($pattern, $_POST["pcode"]) == 0){
            $errors[] = "personal code not valid make sure you have - and a number";
        }

        if(empty($errors))
        {
            $quary = $dbconn->prepare("UPDATE users SET name = :name, lastname = :lastname, phone = :phone, pcode = :pcode WHERE id = :id");
            $quary->execute(["name" => $name, "lastname" => $lastname, "phone" => $phone, "pcode" => $pcode , "id" => $_POST["id"] ]);

            header("Location: /");
        }else{

            echo $name;
            echo $lastname;
            echo $phone;
            echo $pcode;
    
            var_dump($errors);
        }
    }
    echo "everything must be filled";

}



