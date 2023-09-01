<?php 
    include("header.php");
?>
    <style>
        #home
        {
            background-color: white;
            color:black;
        }
    </style>
    <div class="content">
        <div class="container main mt-5">
            <center><h1>Welcome to Flex Nutri</h1></center>
            </br>
            </br>
            <div class="row">
            <div class="col-sm-6">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Invoice Module</h5>
                    <p class="card-text"></p>
                    <a href="sell.php" class="btn btn-primary">Invoice</a>
                </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Purchase Module</h5>
                    <p class="card-text"></p>
                    <a href="purchase.php" class="btn btn-primary">Purchase</a>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>
   