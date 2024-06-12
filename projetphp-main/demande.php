
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request</title>
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
                Create your Request
            </h1>
            <br>
        </div>
    </div>
    <div class="col-12 px-0 mb-4">
        <div class="container-box">
            <div class="col-xl-8" style="width: auto">
                <div class="card mb-4">
                    <div class="card-header py-3" style="background-color:rgb(44, 134, 243);">
                        <h6 style="padding-top: 9px;color: white;font-size: 30px;margin-left: 459px;">Add a new request</h6>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="type">Request type<span style="color: #D72A12">*</span></label>
                                    <select name="type"   id="type" class="form-control" >
                                        <option value="audi" selected>Account Services</option>
                                        <option value="volvo">Transaction Issues</option>
                                        <option value="saab">Customer Support</option>
                                        <option value="vw">Card Services</option>

                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="objet">Object<span style="color: #D72A12">*</span></label>
                                    <input class="form-control" id="objet" type="text"  name="objet" >
                                </div>

                                <label class="small mb-1" for="description">Description</label>
                                <textarea class="form-control"  id="description" type="text"  name="description" ></textarea>
                                <button type="submit" class="btn btn-primary" style="text-align: center;width: 250px;margin-left: 465px;margin-top: 15px;" >Request</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>