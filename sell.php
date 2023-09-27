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
                    <h6 class="box-header-names">INVOICE MASTER</h6>
                </div>
                <div class="getSpace">
                </div>
                <div class="cat" id="viewInv">
                    <h6 class="box-header-names">View INVOICE</h6>
                </div>
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
                                            <th>GST Amount</th>
                                            <!-- <th>SGST</th>
                                            <th>CGST</th>
                                            <th>IGST</th> -->
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
                <div class="container-fluid adding-category">
                    </br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cate">Customer Name</label>
                                <input type="text" name="custName" id="custName" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cate">Customer GST</label>
                                <input type="text" name="custgst" id="custgst" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cate">Customer Mobile</label>
                                <input type="text" name="custmobile" id="custmobile" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cate">Customer Address</label>
                                <input type="text" name="custadds" id="custadds" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="cate">Invoice Date</label>
                                <input type="date" name="saleDate" id="saleDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="cate">Total Amount</label>
                                <input type="text" name="totalAmt" id="totalAmt" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">GST SELECT</label>
                                <select class="form-control" id="gstsel">
                                    <option value="">Select Gst</option>
                                    <option value="igst">IGST</option>
                                    <option value="gst">GST</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Payment Mode</label>
                                <select class="form-control" id="pay">
                                    <option value="">Select Mode</option>
                                    <option value="cash">Cash</option>
                                    <option value="online">Online</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="display:flex;">
                                <button class="btn btn-info" id="submitinvoice" style="margin-top:25px;  margin-right:5px;">INVOICE</button>
                                <button class="btn btn-danger" id="cancelsell" style=" margin-top:25px;">CANCEL</button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="display:flex;">
                                <button class="btn btn-info" id="submitinvoice" style="margin-right:5px;">Invoice</button>
                                <button class="btn btn-danger" id="cancelPurchase" style=">CANCEL</button>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="box-content" id="viewsellData" style="display:none;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="cate">Date From:</label>
                                <input type="date" name="datefrom" id="datefrom" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="cate">Date To:</label>
                                <input type="date" name="dateto" id="dateto" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="dispaly:flex;">
                                <button class="btn btn-info" id="search" style="margin-top:25px; margin-right:5px">SEARCH</button>
                                <button class="btn btn-warning" id="refresh" style="margin-top:25px;">REFRESH</button>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-container">
                                <table id="dataTable1"  class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Customer Name</th>
                                            <th>GST</th>
                                            <th>Mobile</th>
                                            <th>Adds</th>
                                            <th>Invoice Date</th>
                                            <th>Payment Mode</th>
                                            <th>Total Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="viewSaleDataTable">
                                        
                                    </tbody>
                                </table>
                                <table id="dataTable2"  class="table table-bordered" style="display:none">
                                    <thead>
                                        <tr><th colspan="12"><button class="btn btn-sm btn-primary back-button">Back</button></th></tr>
                                        <tr>
                                            <th>SL.NO</th>
                                            <th>Category-Brand-Product-Flavor-unit</th>
                                            <th>GST</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th>CGST</th>
                                            <th>SGST</th>
                                            <th>IGST</th>
                                            <th>TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody id="saleItems">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="10" id="totalSaleAmount" class="text-center">TOTAL AMOUNT- </th>
                                        </tr>
                                    </tfoot>
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
            const invoiceManager= new Invoice();
        });
    </script>
<?php include('footer.php'); ?>