<?php 
    include("header.php");
?>
    <style>
        #sell
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
                    <h4>Invoice</h4>
                </div>
            </div>
            <div class="box-header">
                <!-- <div class="getSpace">
                </div> -->
                <div class="cat active" id="addSell">
                    <h6 class="box-header-names">INVOICE MASTER Editing</h6>
                </div>
                <div class="getSpace">
                </div>
                <!-- <div class="cat" id="viewInv">
                    <h6 class="box-header-names">View INVOICE</h6>
                </div> -->
            </div>
            <div class="box-content" id="addsellData">
                <div class="container-fluid adding-category">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Item Code</label>
                                <input type="text" class="form-control" id="item_code" placeholder="Type Here...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" id="slno" placeholder="Type Here...">
                                <label for="cate">Select Category</label>
                                <select class="form-control onchange" id="category">
                                    <option value="">Select Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Select Brand</label>
                                <select class="form-control onchange" id="brand">
                                    <option value="">Select Brand</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Product Name</label>
                                <select class="form-control onchange" id="product">
                                    <option value="">Select Product</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Select Flavour</label>
                                <select class="form-control onchange" id="flavor">
                                    <option value="">Select Flavour</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="cate">Unit</label>
                                <select class="form-control onchange" id="unit">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="cate">U-Qty</label>
                                <select class="form-control onchange" id="unitQty">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="indeseRows">
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <button class="btn btn-info" id="addPurchaseItem" style="margin-top:30px;">ADD ITEM</button>
                                <button class="btn btn-info" id="updatePurchaseItem" style="display:none; margin-top:25px;">UPDATE</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center><div id="response"></div></center>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-container">
                                <table id="dataTable"  class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Category-Brand-Product-Flavor-Unit</th>
                                            <th>GST</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th>SGST</th>
                                            <th>CGST</th>
                                            <th>IGST</th>
                                            <th>Total</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="saleTableBoady">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function()
        {
            const billChange= new BillEdit();
        });
    </script>