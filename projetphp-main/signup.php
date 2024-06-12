<?php
global $db;
include 'config db.php';
include "sidebar.php";
require 'D:\xamp\htdocs\vendor\phpmailer\phpmailer\src\Exception.php';
require 'D:\xamp\htdocs\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'D:\xamp\htdocs\vendor\phpmailer\phpmailer\src\SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['email'];
    $numtel = $_POST['numtel'];
    $date_naissance = $_POST['date_naissance'];
    $adress = $_POST['adress'];
    $id_role = $_POST['role'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO user (Firstname, Lastname, Email, password, Numtel, Date_N, Adresse, id_role) VALUES (:name, :lastname, :email, :password, :numtel, :date_naissance, :adress, :id_role)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':numtel', $numtel);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':adress', $adress);
    $stmt->bindParam(':id_role', $id_role);

    $stmt->execute();
    $mail = new PHPMailer(true);

    if ($stmt) {
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jaouher3009@gmail.com';
            $mail->Password   = 'degf ozkq sqvv eydt';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('your-email@example.com', 'BANK-UP');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to BANK-UP';
            $mail->Body    = "you curent password is your email adress you can login then changing you password ";

            $mail->send();
            echo '<div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>Form submission failed!</p>
                </div>
            </div>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo '<div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>Form submission failed!</p>
                </div>
            </div>';
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>

</head>
<body>

</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Bank-Up</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon-32x32.png" rel="icon">
    <link href="assets/img/apple-icon-180x180.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!--  style-->
    <link href="../signup.css" rel="stylesheet">

</head>
<style>
    #header.header-inner-pages {
        background: rgba(0, 125, 254, 255);
        padding: 12px 0;
    }
</style>
<body>


<header >



</header>

<main id="main">




    <section >
        <div class="container">


            <form id="addUserForm" autocomplete="off" method="POST">
                <div id="focus"></div>
                <h1>Add User</h1>
                <input type="text" half placeholder="First name" name="name" autocomplete="no" required>
                <input type="text" half placeholder="Last name" name="lastname" autocomplete="no" required>
                <input type="text" half placeholder="Phone number" name="numtel" autocomplete="no" required>
                <input type="text" half placeholder="Account number" name="numcompte" autocomplete="no" required>
                <input type="email"  half placeholder="e-Mail" name="email" autocomplete="no" required>
                <input type="date" half placeholder="date of birth" name="date_naissance" autocomplete="no" required>
                <input type="text" half placeholder="address" name="adress" autocomplete="no" required>


                <select name="role">

                    <option value='2'> user</option>
                </select>
                <input type="submit" value="Send it">
            </form>


        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/purecounter/purecounter.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Display the modal
    modal.style.display = "block";
</script>
</body>

</html>

