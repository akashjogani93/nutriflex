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
                <div class="getSpace">
                </div>
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
                                <label for="cate">Select Flavor</label>
                                <select class="form-control onchange" id="flavor">
                                    <option value="">Select Flavor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Select Unit</label>
                                <select class="form-control onchange" id="unit">
                                    <option value="">Select Unit</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="indeseRows">
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <button class="btn btn-info" id="addPurchaseItem" style="margin-top:30px; border-radius: 0;">ADD ITEM</button>
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
                                            <th>SL.NO</th>
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
                                            <th>DELETE</th>
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
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="display:flex;">
                                <button class="btn btn-info" id="submitinvoice" style="border-radius: 0; margin-right:5px;">Invoice</button>
                                <button class="btn btn-danger" id="cancelPurchase" style="border-radius: 0;">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-content" id="viewsellData" style="display:none;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-container">
                                <table id="dataTable1"  class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Customer Name</th>
                                            <th>Invoice Date</th>
                                            <th>Payment Mode</th>
                                            <th>Total Amount</th>
                                            <th>View</th>
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