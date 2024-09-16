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

    //Half assed CRUD lets goooooo!!!!1!!!
    function getUsers($dbconn){
        $quary = $dbconn->prepare("SELECT * FROM users");
        $quary->execute();
        return $quary->fetchAll();
    }

    function addUser($dbconn , $name, $lastname, $phone, $pcode){
        $quary = $dbconn->prepare("INSERT INTO users (name, lastname, phone, pcode) VALUES (:name, :lastname, :phone, :pcode)");
        $quary->execute(["name" => $name, "lastname" => $lastname, "phone" => $phone, "pcode" => $pcode]);
        return $quary->fetchAll();
    }

    function delUser($dbconn , $id){
        $quary = $dbconn->prepare("DELETE FROM users WHERE id = :id");
        $quary->execute(["id" => $id]);
        return $quary->fetchAll();
    }

    function editUser($dbconn , $id, $name, $lastname, $phone, $pcode){
        $quary = $dbconn->prepare("UPDATE users SET name = :name, lastname = :lastname, phone = :phone, pcode = :pcode WHERE id = :id");
        $quary->execute(["id" => $id , "name" => $name, "lastname" => $lastname, "phone" => $phone, "pcode" => $pcode]);
        return $quary->fetchAll();
    }

    getUsers($dbconn);
    
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2024 - 09 - 09 3x3</title>
</head>

<body id="body">

<div class="container">

    <div class="holder">
        <div class="imgContainer">
            <img src="img/vtdt.jpg"alt="vtdt" class="image">
            <div class="overlay"></div>
        </div>
    </div>

    <div class="holderspecial">
        <div class="confettiHolder">
            <div class="confetti1"></div>
            <div class="confetti2"></div>
            <div class="confetti3"></div>
            <div class="confetti4"></div>
            <div class="confetti5"></div>
            <div class="confetti6"></div>
            <div class="confetti7"></div>
            <div class="confetti8"></div>
            <div class="confetti9"></div>
            <div class="confetti10"></div>
        </div>

    </div>

    <div class="holder">
    <input type="button" value="Uspied priekš pārsteiguma" onclick="spin()" >
    </div>

    <div class="holder">
        <div class="ball"></div>
    </div>

    <div class="holder">
        <a  href="https://youtu.be/5v51sF6j6_I?si=yvWP4cucA70cR6T1" target="_blank"><span>YouTube</span></a>
        <a href="https://www.e-klase.lv/" target="_blank"><span>E-klase</span></a>
        <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank"><span>Gmail</span></a>
        <a href="https://www.vtdt.lv/" target="_blank"><span>VTDT</span></a>
        <a href="https://www.1a.lv/p/akumulatora-betona-dzilumvibrators-makita-dvr450z-18-v/ostv?mtd=search&pos=regular&src=searchnode" target="_blank"><span>1A</span></a>
    </div>

    <div class="holder">
        <p id="wether"></p>
    </div>

    <div class="holder">
        <form action="/add" method="post">
                <div class="form">
                    <label for="">
                        First name
                        <input type="text" name="fname" id="fname" placeholder="Jānis" require>
                    </label>

                    <label for="">
                        Last name
                        <input type="text" name="lname" id="fname" placeholder="Ozols" require>
                    </label>

                    <label for="">
                        phone number
                        <input type="phone" name="number" id="number" placeholder="+37128112123" require>
                    </label>

                    <label for="">
                        personal code
                        <input type="text" name="pcode" id="pcode" placeholder="040391-21386" require>
                    </label>

                    <input type="submit" value="Add user">
                </div>
            </form>
    </div>

    <div class="holder">
        <form action="/edit" method="POST">
                <select name="id" id="id">
                    <?php
                    echo "<option value=''>Select</option>";
                    foreach(getUsers($dbconn) as $user){
                        echo "<option value='" . $user['id'] . "'>" . $user['name'] . " " . $user['lastname'] . "</option>";
                    }
                    ?>
                </select>

                <input type="submit" value="Edit">
            </form>
    </div>

    <div class="holder">
    <form action="/remove" method="POST">
                <select name="id" id="id">
                    <?php
                    echo "<option value=''>Select</option>";
                    foreach(getUsers($dbconn) as $user){
                        echo "<option value='" . $user['id'] . "'>" . $user['name'] . " " . $user['lastname'] . "</option>";
                    }
                    ?>
                </select>

                <input type="submit" value="Remove">
            </form>
    </div>

</div>


</body>
</html>