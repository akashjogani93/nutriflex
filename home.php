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
                <div class="col-md-12">
                    <div class="card-deck">
                        <a href='purchase.php'><div class="card mb-4">
                            <div class="view overlay">
                                <div class="mask rgba-white-slight"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">PURCHASE</h4>
                            </div>
                        </div></a>
                        <a href="sell.php"><div class="card mb-4">
                            <div class="view overlay">
                                <div class="mask rgba-white-slight"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">INVOICE</h4>
                            </div>
                        </div></a>
                        <a href="stock.php"><div class="card mb-4">
                            <div class="view overlay">
                                <div class="mask rgba-white-slight"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">STOCK</h4>
                            </div>
                        </div></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>
   