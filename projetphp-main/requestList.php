<?php
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

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
                <div class="pagetitle">
                    <h1>
                        Admin Panel: Request Management
                    </h1>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-12 px-0 mb-4">
            <section>
                    <details>
                        <summary style="display: flex">
                            <div>

                                <h3>
                                    <strong >USER NAME HNA  </strong>
                                    <small> traité wala la lina </small>
                                </h3>
                            </div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="height: 10%;
                                                                                                                                margin-left: 55%;
                                                                                                                                margin-top: 1%;
                                                                                                                                margin-right: 10px;">
                                Open Message
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <button class="btn btn-danger" style=" height: 48.9px;margin-top: 1%;">Delete</button>
                        </summary>
                        <div>
                            <dl>
                                <div>
                                    <dt> Date</dt>
                                    <dd>date eli b3ath fih</dd>
                                </div>
                                <div>
                                    <dt>Request ID </dt>
                                    <dd>el id t7oto lina </dd>
                                </div>
                                <div>
                                    <dt>User ID</dt>
                                    <dd>id el user lina </dd>
                                </div>
                            </dl>
                        </div>
                    </details>

            </section>
        </div>

    </div>
</div>
</div>
</div>
    <script>$('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })</script>
</body>
</html>