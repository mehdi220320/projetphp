<?php

if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
global$db;
include 'config db.php';

if ($_SESSION['role']== 'agent') {


$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $db->query("SELECT user.*, role.nom_role FROM user INNER JOIN role ON user.id_role = role.id_role WHERE role.nom_role='user'");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    $stmt = $db->prepare("DELETE FROM user WHERE User_id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo "User deleted successfully.";
    exit;
}
} else {
    header('Location: error.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="mainpage.css"></head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
<?php
include "sidebar.php"
?>
<div class="container">
    <div class="col-12 px-0 mb-4 ">
        <div class="pagetitle">
            <h1>
                Agent Panel: User Directory
            </h1>
            <br>
        </div>
    </div>
    <div class="col-12 px-0 mb-4">
        <div class="container-box">
            <table class="table table-hover">
                <thead >
                <tr style="background: #0a53be">
                    <th >First Name</th>
                    <th >Last Name</th>
                    <th >Num tel</th>
                    <th>Adresse</th>
                    <th >Email</th>
                    <th> Edit</th>
                    <th> Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) { ?>

                    <tr>
                        <th class="table-data"><?php echo $user['Firstname']; ?></th>
                        <th class="table-data"><?php echo $user['Lastname']; ?></th>
                        <th class="table-data"><?php echo $user['Numtel']; ?></th>
                        <th class="table-data"><?php echo $user['Adresse']; ?></th>
                        <th class="table-data"><?php echo $user['Email']; ?></th>

                        <th class="table-data">
                            <a href="updateuser.php?id=<?php echo $user['User_id']; ?>" class="btn btn-secondary">Edit</a>
                        </th>
                        <th > <button class="btn btn-danger" onclick="deleteUser(<?php echo $user['User_id']; ?>)">Delete</button></th>



                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>

</body>

</html>
