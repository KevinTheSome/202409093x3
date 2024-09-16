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

$quary = $dbconn->prepare("SELECT * FROM users WHERE id = :id");
$quary->execute(["id" => $_POST["id"]]);
$user = $quary->fetchAll();


// if($_SERVER['REQUEST_METHOD'] == "POST")
// {
//     $errors = [];
//     if(isset($_POST["id"]))
//     {
//         $id = $_POST["id"];
//         if($id <= 0) {
//             $errors[] = "izdzēšanas id jābūt pozitīvam ciparam";
//         }

//         // if(empty($errors)){
//         //     header("Location: /");
//         // }
//     }
    
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <div class="container">
        <form action="/editPost" method="POST">
            <div class="form">
                    <input type="number" name="id" value="<?= $user[0]["id"]; ?>" hidden>
                    <label for="">
                        First name
                        <input type="text" name="fname" id="fname" placeholder="Jānis" value=<?= $user[0]["name"]; ?> require>
                    </label>

                    <label for="">
                        Last name
                        <input type="text" name="lname" id="fname" placeholder="Ozols" value="<?= $user[0]["lastname"]; ?>" require>
                    </label>

                    <label for="">
                        phone number
                        <input type="phone" name="number" id="number" placeholder="+37128112123" value="<?= $user[0]["phone"]; ?>" require>
                    </label>

                    <label for="">
                        personal code
                        <input type="text" name="pcode" id="pcode" placeholder="040391-21386" value="<?= $user[0]["pcode"]; ?>" require>
                    </label>

                    <input type="submit" value="Edit">
                </div>
        </form>
    </div>
</body>
</html>

