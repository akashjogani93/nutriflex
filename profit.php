<?php 
    include("header.php");
?>

    <style>
        #profit
        {
            background-color: white;
            color:black;
        }
        .active
        {
            background-color: white;
        }
    </style>
    <div class="content">
        <div class="container main mt-5">
            <div class="box">
                <div class="header">
                    <h4>PROFIT</h4>
                </div>
            </div>
            <div class="box-header">
                <!-- <div class="getSpace">
                </div> -->
                <div class="cat active" id="addPur">
                    <h6 class="box-header-names">PROFIT DETAILS</h6>
                </div>
                <div class="getSpace">
                </div>
            </div>
            <div class="box-content" id="addPurchaseData">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-container">
                            <table id="dataTable"  class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL.NO</th>
                                        <th>Item Code</th>
                                        <th>Product</th>
                                        <th>Base Price</th>
                                        <th>Sale Price</th>
                                        <th>Profit</th>
                                        <th>Qty</th>
                                        <th>Total Profit</th>
                                        <th>Date</th>
                                        <th>Invoice</th>
                                    </tr>
                                </thead>
                                <tbody id="profitTable">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function()
        {
            const profitMaster = new Profit();
            profitMaster.fetchProfitTable();
        });
    </script>
