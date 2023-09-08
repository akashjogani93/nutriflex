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
                <!-- <div class="getSpace">
                </div> -->
                <div class="cat active" id="stockbox">
                    <h6 class="box-header-names">view stock</h6>
                </div>
                <div class="getSpace">
                </div>
                <div class="cat" id="viewExpiry">
                    <h6 class="box-header-names">View Expiry</h6>
                </div>
                <div class="getSpace">
                </div>
                <div class="cat" id="stockbyCode">
                    <h6 class="box-header-names">Stock By Item Code</h6>
                </div>
                <div class="getSpace">
                </div>
                <div class="cat" id="allStock">
                    <h6 class="box-header-names">All Stock</h6>
                </div>
                <div class="getSpace">
                </div>
            </div>
            <div class="box-content" id="stockQty">
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
                                        <th>Category</th>
                                        <th>Brand-Product-Flavor</th>
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
            <div class="box-content" id="stockExpiry" style="display:none">
                <!-- <div class="row">
                    <div class="col-md-4" style="margin-left:40px;">
                        <label for="cate">Filter Category</label>
                        <select class="form-control" id="categoryFilter">
                            <option value="">Select Category</option>
                        </select>
                    </div>
                </div> -->
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
                                        <th>Expiry</th>
                                    </tr>
                                </thead>
                                <tbody id="expiryTable">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="box-content" id="stockByCodeData" style="display:none">
                <div class="row">
                    <div class="col-md-4" style="margin-left:40px;">
                        <label for="cate">Item Code</label>
                        <input type="text" class="form-control" id="itemcode"/>
                    </div>
                    <div class="col-md-4" style="margin-left:40px; margin-top:30px;">
                        <button id="search_byCode" class="btn btn-warning">Search</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-container">
                            <table id="dataTable"  class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL.NO</th>
                                        <th>Category</th>
                                        <th>Brand-Product</th>
                                        <th>Flavor</th>
                                        <th>Unit</th>
                                        <th>Qty</th>
                                        <th>Item Code</th>
                                    </tr>
                                </thead>
                                <tbody id="itemCodeBoady">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-content" id="allStockData" style="display:none">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-container">
                            <table id="dataTable"  class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL.NO</th>
                                        <th>Category</th>
                                        <th>Brand-Product</th>
                                        <th>Unit</th>
                                        <th>Location</th>
                                        <th>Base Price</th>
                                        <th>Gst Price</th>
                                        <th>Sale Price</th>
                                        <th>Qty</th>
                                        <th>Item Code</th>
                                    </tr>
                                </thead>
                                <tbody id="allStockDataItems">
                                    
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