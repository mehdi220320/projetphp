<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
ob_start();
include 'config db.php';
include 'sidebar.php';

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

global $db;
$userid = $_SESSION['id'];
$totalReceived = 0;
$totalSent = 0;
$stmt = $db->prepare("SELECT * FROM bank_account WHERE id_user = :id ");
$stmt->bindParam(':id', $userid);
$stmt->execute();
$bank_account = $stmt->fetch(PDO::FETCH_ASSOC);


$searchResults = [];

if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];
    $stmt = $db->prepare("SELECT ba.id_account, CONCAT(ba.id_account, ' - ', u.User_id, ' - ', u.Firstname,' ',u.Lastname) AS user_account
                      FROM user u, bank_account ba
                      WHERE u.User_id=ba.id_user
                      AND (ba.id_account LIKE :term OR u.User_id LIKE :term OR u.Firstname LIKE :term)");
    $stmt->bindValue(':term', '%' . $searchTerm . '%');
    $stmt->execute();
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ob_end_clean();

    echo json_encode($searchResults);
    exit;
}

// Transaction processing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $receiver = $_POST['receiver'];
    $amount = $_POST['amount'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT solde, plafond_r FROM bank_account WHERE id_user = :id");
    $stmt->bindParam(':id', $userid);
    $stmt->execute();
    $bank_account = $stmt->fetch(PDO::FETCH_ASSOC);
    $balance = $bank_account['solde'];
    $plafond_r = $bank_account['plafond_r'];



    $stmt = $db->prepare("SELECT password,Firstname,Lastname FROM user WHERE User_id = :id");
    $stmt->bindParam(':id', $userid);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user !== false && !password_verify($password, $user['password'])) {


        ob_end_clean();
        echo json_encode(['error' => "The entered password is incorrect."]);

        exit;

    }else{
        if ($amount > $balance + $plafond_r) {
            ob_end_clean();
            echo json_encode(['error' => "The entered amount is higher than your balance plus your plafond_r."]);
            exit;
        }else{

            $stmt = $db->prepare("UPDATE bank_account SET solde = solde - :amount WHERE id_user = :id");
            $stmt->bindParam(':id', $userid);
            $stmt->bindParam(':amount', $amount);
            $stmt->execute();


            $stmt = $db->prepare("UPDATE bank_account SET solde = solde + :amount WHERE id_account = :id");
            $stmt->bindParam(':id', $receiver);
            $stmt->bindParam(':amount', $amount);
            $stmt->execute();
            $stmt = $db->prepare("SELECT *  FROM bank_account, user  WHERE id_account = :id and id_user = User_id");
            $stmt->bindParam(':id', $receiver);
            $stmt->execute();
            $user2 = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $db->prepare("SELECT id_account FROM bank_account WHERE id_user = :id");
            $stmt->bindParam(':id', $userid);
            $stmt->execute();
            $sender_account = $stmt->fetch(PDO::FETCH_ASSOC)['id_account'];




            $stmt = $db->prepare("INSERT INTO transaction (compte_sender, compte_receiver, montant, date) VALUES (:sender_id, :receiver_id, :amount, NOW())");
            $stmt->bindParam(':sender_id', $sender_account);
            $stmt->bindParam(':receiver_id', $receiver);
            $stmt->bindParam(':amount', $amount);
            $result = $stmt->execute();

            if ($result === false) {
                ob_end_clean();
                echo json_encode(['error' => "Failed to insert transaction. Error info: " . implode(", ", $stmt->errorInfo())]);
                exit;
            } else {
                ob_end_clean();
                echo json_encode(['success' => "Transaction successfully added."]);
                exit;
            }
        }}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="mainpage.css"></head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <style>
        .ui-autocomplete {
            position: absolute;
            z-index: 1051;
            background-color: white;
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            overflow-x: hidden;
            cursor: pointer;
        }

    </style>
<meta charset="UTF-8">
<title>Make Transaction</title>
</head>
<div>
    <?php
    include "sidebar.php"
    ?>
    <div class="container">
        <div class="col-12 px-0 mb-4 ">
            <div class="pagetitle">
                <h1>
                    Create your transaction
                </h1>
                <br>
            </div>
        </div>
        <div class="col-12 px-0 mb-4">
            <div class="container-box">
                <div class="container-fluid d-flex">
                    <div class="flex-grow-1">
                        <div class="row box-right">
                            <div class="col-md ps-0 " style="display:inline-flex;" >
                                <h1>Your sold is :</h1>
                                <p class="h1 fw-bold d-flex" style="color: green"> <?php
                                    echo $bank_account['solde']
                                    ?> <span class="  textmuted pe-1 h6 align-text-top mt-1"> DT</span> </p>
                            </div >

                        </div>

                        <div id="main-container" >
                            <div class="col-xl-8" style="width: auto;">
                                <div class="card mb-4">
                                    <div class="card-header py-3" style="background-color:rgb(44, 134, 243); ">
                                        <h6 style="color:white;font-size: 17px;margin-left: 44%;">Make a Transaction</h6>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="receiver">Receiver<span style="color: #D72A12">*</span></label>
                                                    <input class="form-control" id="receiver" type="text" name="receiver">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="amount">Amount<span style="color: #D72A12">*</span></label>
                                                    <input class="form-control" id="amount" type="text" name="amount">
                                                </div>
                                                <button type="submit" class="btn btn-primary" style="text-align:center;width:250px; margin-left: 40%;margin-top:15px;">Make Transaction</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="    margin-top: 13%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="messageModalLabel">Message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="messageModalBody">
                                <!-- Message will be inserted here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="    margin-top: 13%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="passwordModalLabel">Confirm Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="password" id="passwordInput" class="form-control" placeholder="Enter your password">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="confirmPasswordButton">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#receiver").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "", // the current page URL
                    type: "post",
                    dataType: "json",
                    data: {
                        searchTerm: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.user_account,
                                value: item.id_account + ' - ' + item.user_account
                            };
                        }));
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            },
            minLength: 1,
            select: function(event, ui) {
                $("#receiver").val(ui.item.value);
                return false;
            }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li>")
                .append("<div>" + item.label + "</div>")
                .appendTo(ul);
        };
    });

    $('form').on('submit', function(e) {
        e.preventDefault();

        var password = prompt("Please enter your password for confirmation:");
        if (password == null || password == "") {
            $('#messageModalBody').text("You must enter your password to proceed.");
            var modal = new bootstrap.Modal(document.getElementById('messageModal'));
            modal.show();
            return;
        }

        var formData = $(this).serializeArray();
        formData.push({name: 'password', value: password});


        $.ajax({
            url: "", // the current page URL
            type: "post",
            dataType: "json",
            data: formData,
            success: function(data) {
                var message = data.error ? data.error : data.success;
                $('#messageModalBody').text(message);
                var modal = new bootstrap.Modal(document.getElementById('messageModal'));
                modal.show();
            },
            error: function(xhr, status, error) {
                $('#messageModalBody').text(xhr.responseText);
                var modal = new bootstrap.Modal(document.getElementById('messageModal'));
                modal.show();

            },
            complete: function() {
                $('#passwordModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        });
    });
</script>
</body>
</html>
