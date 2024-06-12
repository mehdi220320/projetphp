
<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
global $db;
include 'config db.php';
include 'sidebar.php';
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
    $stmt->bindParam(':id', $_SESSION['id']); // Assuming the 'id' parameter is always present in the URL
    $stmt->execute();

    header("Location: main.php");
    exit();
} else {
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];

        $stmt = $db->prepare("SELECT * FROM user WHERE User_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="mainpage.css"></head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>
<div class="container">
    <div class="col-12 px-0 mb-4 ">
        <div class="pagetitle">
            <h1>
                My Profile
            </h1>
            <br>
        </div>
    </div>
    <div class="col-12 px-0 mb-4">
        <div class="container-box">
            <div class="container-fluid d-flex">

                <div class="flex-grow-1">

                    <div class=" bootstrap snippets bootdey" >

                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <img class="avatar img-circle img-thumbnail" alt="avatar" src='bank-account-icon-in-trendy-outline-style-isolated-on-white-background-bank-account-silhouette-symbol-for-your-website-design-logo-app-ui-illustration-eps10-free-vector.jpg' >
                                    <button ><input type="image" value="Photo"></button>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <form>
                                            <div class="row gutters">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <h6 class="mb-3 text-primary">Personal informations</h6>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="lastname">Last Name</label>
                                                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo isset($lastname) ? $lastname : ''; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="lastname">first Name</label>
                                                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo isset($name) ? $name : ''; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="email">Email</label>
                                                        <input class="form-control" id="email" type="email" name='email' value="<?php echo isset($email) ? $email : ''; ?>">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row gutters">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <h6 class="mt-3 mb-2 text-primary"></h6>
                                                </div>




                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="numtel">Phone number</label>
                                                        <input class="form-control" id="numtel"  type="text" name='numtel' value="<?php echo isset($numtel) ? $numtel : ''; ?>" >
                                                    </div>
                                                </div>




                                                <div class="row gutters">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="text-right">
                                                            <button type="submit" name="button" class="btn btn-primary">Save</button>
                                                        </div>

                                                    </div>
                                                </div>      </div>

                                        </form>


                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>


