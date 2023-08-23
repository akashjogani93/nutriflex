<?php 
    include("header.php");
?>
    <style>
        #stock
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
                    <h4>STOCK</h4>
                </div>
            </div>
            <div class="box-header">
                <div class="getSpace">
                </div>
                <div class="cat active" id="itembox">
                    <h6 class="box-header-names">view stock</h6>
                </div>
                <div class="getSpace">
                </div>
                <div class="cat" id="itembox">
                    <h6 class="box-header-names">View Expiry</h6>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-md-4" style="margin-left:40px;">
                        <label for="cate">Filter Category</label>
                        <select class="form-control" id="categoryFilter">
                            <option value="">Select Category</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-container">
                            <table id="dataTable"  class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL.NO</th>
                                        <th>Category-Brand-Product-Flavor</th>
                                        <th>Unit</th>
                                        <th>Qty</th>
                                        <th>Item Code</th>
                                    </tr>
                                </thead>
                                <tbody id="itemTableBoady">
                                    
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
            const stockMaster = new Stock();
        });
    </script>