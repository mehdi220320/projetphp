
<!DOCTYPE html>
<?php
global $db;
include 'config db.php';
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    // Process form submission
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $numtel = $_POST['numtel'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Note: It's advisable to hash the password before storing it.
    $date_naissance = $_POST['date_naissance'];
    $adress = $_POST['adress'];
    $role = $_POST['role'];

    // Update user information in the database
    $stmt = $db->prepare("UPDATE user SET Firstname = :name, Lastname = :lastname, Numtel = :numtel, Email = :email, Password = :password, Date_N = :date_naissance, Adresse = :adress, id_role = :role WHERE User_id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':numtel', $numtel);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':adress', $adress);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':id', $_GET['id']); // Assuming the 'id' parameter is always present in the URL
    $stmt->execute();

    // Redirect to a confirmation page or display a success message
    header("Location: main.php"); // Redirect to a success page
    exit(); // Ensure script execution stops here
} else {
    // Check if user ID is provided in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch user data based on ID
        $stmt = $db->prepare("SELECT * FROM user WHERE User_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Pre-fill form fields with user data
            $name = $user['Firstname'];
            $lastname = $user['Lastname'];
            $numtel = $user['Numtel'];
            $email = $user['Email'];
            $date_naissance = $user['Date_N'];
            $adress = $user['Adresse'];
            $role = $user['id_role'];
        }
    }
}
?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>

</head>
<body>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title></title>
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

<!-- ======= Header ======= -->
<header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="logo"><a href="../SkyBank/">Bank-Up</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto " href="index.html">Home</a></li>
                <li><a class="nav-link scrollto" href="about.php">About</a></li>
                <li><a class="nav-link scrollto " href="terms.html">Terms and Condition</a></li>
                <li><a class="nav-link scrollto" href="contact.php">Contact</a></li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs" >
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Update</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <section >
        <div class="container">


            <form autocomplete="off" method="POST">
                <div id="focus"></div>
                <h1>Update User</h1>
                <input type="text" half placeholder="First name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" autocomplete="no">
                <input type="text" half placeholder="Last name" name="lastname" value="<?php echo isset($lastname) ? $lastname : ''; ?>" autocomplete="no">
                <input type="text" placeholder="Phone Number" name="numtel" value="<?php echo isset($numtel) ? $numtel : ''; ?>" autocomplete="no">
                <input type="date" half placeholder="Date of birth" name="date_naissance" value="<?php echo isset($date_naissance) ? $date_naissance : ''; ?>" autocomplete="no">
                <input type="text" half placeholder="address" name="adress" value="<?php echo isset($adress) ? $adress : ''; ?>" autocomplete="no">
                <input disabled type="email" half placeholder="e-Mail" name="email" value="<?php echo isset($email) ? $email : ''; ?>" autocomplete="no">
                <select   disabled name="role" >
                <option>user</option>
                </select>
                <input type="submit" value="Send it">
            </form>


        </div>
    </section>

</main><!-- End #main -->



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

