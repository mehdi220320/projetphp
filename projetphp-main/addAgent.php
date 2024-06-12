<?php
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="mainpage.css"></head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Template Main CSS File -->
<link href="assets/css/style.css" rel="stylesheet">
<!--  style-->
<link href="../signup.css" rel="stylesheet">

</head>

<body>
<?php
include "sidebar.php"
?>
    <div class="container">
        <div class="col-12 px-0 mb-4 ">
            <div class="pagetitle">
                <h1>
                    Admin Panel: Agent Management
                </h1>
                <br>
            </div>
        </div>
        <div class="col-12 px-0 mb-4">
            <div class="container-box">
                <section >
                        <form id="addUserForm" autocomplete="off" method="POST" style="width: auto;max-width: fit-content;margin: auto">
                            <div id="focus"></div>
                            <h1 style="    margin-left: 42%;">Add Agent</h1>
                            <input type="text" half placeholder="First name" name="name" autocomplete="no" required>
                            <input type="text" half placeholder="Last name" name="lastname" autocomplete="no" required>
                            <input type="text" half placeholder="Phone number" name="numtel" autocomplete="no" required>
                            <input type="text" half placeholder="Account number" name="numcompte" autocomplete="no" required>
                            <input type="email"  half placeholder="e-Mail" name="email" autocomplete="no" required>
                            <input type="password" half placeholder="Password" name="password" autocomplete="no" required>
                            <input type="date" half placeholder="date of birth" name="date_naissance" autocomplete="no" required>
                            <input type="text" half placeholder="address" name="adress" autocomplete="no" required>
                            <select name="role">
                                <option value="agent">agent</option>
                            </select>
                            <input type="submit" value="Register">
                        </form>
                </section>


            </div>
        </div>
    </div>
</div>

</body>

</html>