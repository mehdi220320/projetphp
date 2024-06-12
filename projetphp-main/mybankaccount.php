<html>
<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include 'config db.php';

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header('Location: login.php');
}

global $db;
$userid = $_SESSION['id'];
$totalReceived = 0;
$totalSent = 0;
// Fetch user data based on ID
$stmt = $db->prepare("SELECT * FROM bank_account AS b
                      INNER JOIN transaction AS t
                      ON t.compte_sender = b.id_account OR b.id_account = t.compte_receiver
                      WHERE id_user = :id
                      ORDER BY t.date desc ");
$stmt->bindParam(':id', $userid);
$stmt->execute();
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$transactions) {
    die("No transactions found.");
}




$stmt = $db->prepare("SELECT *
        FROM bank_account
        JOIN user ON bank_account.id_user = user.User_id
        WHERE user.User_id = :id");
$stmt->bindParam(':id', $userid);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}
foreach ($transactions as $transaction) {
if ($transaction['compte_sender'] == $user['id_account']) {
    $totalSent += $transaction['montant'];
} else {
    $totalReceived += $transaction['montant'];
}}
?>
<head>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="mainpage.css"></head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<body>
<?php
include "sidebar.php"
?>

    <div class="container">

            <div class="col-12 px-0 mb-4" style="width: 87%; margin-left: 9%">
                <div class="row" >

                    <div class="col-12 mb-4" ">
                        <div class="row box-right">
                            <div class="col-md ps-0">
                                <strong ><h1></strong><?php echo $user['Lastname'].
                                 ' '. $user['Firstname'] ?> </h1></strong>
                                <h6>Account's id: <b> <?php echo $user['id_account'] ?> </b> </h6>
                            </div>
                            <div class="col-md ps-0  " style="    margin-top: 30px;margin-left: 50px;">
                                <p class="ps-3 textmuted fw-bold h6 mb-0">TOTAL CREDS</p>
                                <p class="h1 fw-bold d-flex"> <?php
                                    echo $user['solde']
                                    ?> <span class="  textmuted pe-1 h6 align-text-top mt-1"> DT</span> </p>
                                <p class="ms-3 px-2 bg-green">+10% since last month</p>
                            </div >
                            <div class="col-md ps-0">
                                <p class="p-blue"> <span class="fas fa-circle pe-2"></span>RECIEVED </p>
                                <p class="fw-bold mb-3"><span class="fas fa-dollar-sign pe-1"></span><?php echo $totalReceived?> <span class="textmuted">.50</span> </p>
                                <p class="p-org"><span class="fas fa-circle pe-2"></span>SEND</p>
                                <p class="fw-bold"><span class="fas fa-dollar-sign pe-1"></span><?php echo $totalSent?><span class="textmuted">.00</span></p>
                            </div>
                            <div class="col-md">
                                <H1> Make a transaction</H1>
                                <div class="btn btn-primary  h8" style="display: grid">
                                    <a href="maketransaction.php" style="color: white;margin-top: -6px;">
                                        Transaction's Page  <span class="ms-3 fas fa-arrow-right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-0 mb-4">
                                    <section>
                                        <h1>Latest Transactions</h1>
                                        <br>
                                        <?php
                                        foreach ($transactions as $transaction) {

                                            ?>
                                            <details>
                                                <summary>
                                                    <div>

                                                        <h3>
                                                            <strong > <?php
                                                                if ($transaction['compte_sender'] == $transaction['id_account']) {
                                                                    $stmt2 = $db->prepare("SELECT * FROM user , bank_account WHERE id_user=User_id and id_account = :id");
                                                                    $stmt2->bindParam(':id', $transaction['compte_receiver']);
                                                                    if ($stmt2->execute()) {
                                                                        $user2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                                                                        if ($user2) {
                                                                            ?><div style="color: red;">
                                                                            <i class="fa-solid fa-arrow-up" style="margin-right: 5px;"></i>
                                                                            <?php echo $user2['Firstname'] . ' ' . $user2['Lastname']; ?>
                                                                            </div>
                                                                            <?php
                                                                        } else {
                                                                            echo "User not found";
                                                                        }
                                                                    } else {
                                                                        echo "Error executing query";
                                                                    }
                                                                } else {
                                                                    $stmt2 = $db->prepare("SELECT * FROM user , bank_account WHERE id_user=User_id and id_account = :id");
                                                                    $stmt2->bindParam(':id', $transaction['compte_sender']);
                                                                    if ($stmt2->execute()) {
                                                                        $user2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                                                                        if ($user2) {
                                                                            ?><div style="color: #1e7e34;">
                                                                            <i class="fa-solid fa-arrow-down" style="margin-right: 5px;"></i>
                                                                            <?php echo $user2['Firstname'] . ' ' . $user2['Lastname']; ?>
                                                                            </div>
                                                                        <?php } else {
                                                                            echo "User not found";
                                                                        }
                                                                    } else {
                                                                        echo "Error executing query";
                                                                    }
                                                                }
                                                                ?></strong>
                                                            <small><?php $transaction['date']  ?></small>
                                                        </h3>
                                                        <span><?php echo ($transaction['compte_sender'] == $user['id_account']) ? '-' : '+'; ?><?php echo $transaction['montant']; ?></span>
                                                    </div>
                                                </summary>
                                                <div>
                                                    <dl>
                                                        <div>
                                                            <dt><?php echo $transaction['date']; ?></dt>
                                                        </div>
                                                        <div>
                                                            <dt>Card used</dt>
                                                            <dd>•••• 6890</dd>
                                                        </div>
                                                        <div>
                                                            <dt>Reference ID</dt>
                                                            <?php echo $transaction['id_transaction']; ?>
                                                        </div>
                                                    </dl>
                                                </div>
                                            </details>
                                            <?php
                                        }
                                        ?>
                                    </section>
                                </div>
                </div>
            </div>
    </div>
</div>

</body>
</html>