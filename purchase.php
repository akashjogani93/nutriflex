<?php 
    include("header.php");
?>
    <style>
        #pur
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
                    <h4>PURCHASE</h4>
                </div>
            </div>
            <div class="box-header">
                <div class="cat active" id="addPur">
                    <h6 class="box-header-names">PURCHASE MASTER</h6>
                </div>
                <div class="getSpace">
                </div>
                <div class="cat" id="viewPur">
                    <h6 class="box-header-names">View Purchase</h6>
                </div>
            </div>
            <div class="box-content" id="addPurchaseData">
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
                                    <option value="">Select Flavor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="cate">Unit</label>
                                <select class="form-control onchange" id="unit">
                                    <option value="">Select Unit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="cate">Unit Qty</label>
                                <input class="form-control onchange" id="unitQty" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Select Location</label>
                                <select class="form-control" id="location">
                                    <option value="">Select location</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="cate">Expiry Date</label>
                                <input type="date" name="expDate" id="expDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="cate">GST%</label>
                                <select class="form-control" id="gst">
                                    <option value="">Select location</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="cate">QTY</label>
                                <input type="text" class="form-control" id="qty">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Price</label>
                                <input type="text" class="form-control" id="price">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Gst-Price</label>
                                <input type="text" class="form-control" id="gstPer" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Base-Price</label>
                                <input type="text" class="form-control" id="basePer" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Servings</label>
                                <input type="text" class="form-control" id="servings">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">mrp</label>
                                <input type="text" class="form-control" id="mrpPrice">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Sale-Price</label>
                                <input type="text" class="form-control" id="salePrice">
                            </div>
                        </div>
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
                                            <th>Category-Brand-Product-Flavor</th>
                                            <th>Servings</th>
                                            <th>Unit</th>
                                            <th>GST</th>
                                            <th>Qty</th>
                                            <th>Gst/Price</th>
                                            <th>Base/Price</th>
                                            <th>MRP</th>
                                            <th>Sale/Price</th>
                                            <th>Total</th>
                                            <th>Expiry</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemTableBoady">
                                        
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
                                <label for="cate">Select Vendor</label>
                                <select name="venName" id="venName" class="form-control">
                                    <option value="">Select Vendor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="cate">Purchase Date</label>
                                <input type="date" name="purDate" id="purDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="cate">Total Amount</label>
                                <input type="text" name="totalAmt" id="totalAmt" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="cate">Remark</label>
                                <input type="text" name="remark" id="remark" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" style="display:flex;">
                                <button class="btn btn-info" id="submitPurchase" style="margin-top:30px; margin-right:5px;">PURCHASE</button>
                                <button class="btn btn-danger" id="cancelPurchase" style="margin-top:30px;">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-content" id="viewpurchaseData" style="display:none;">
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
                                <button class="btn btn-info" id="search" style="border-radius: 0; margin-top:25px; margin-right:5px">SEARCH</button>
                                <button class="btn btn-warning" id="refresh" style="border-radius: 0; margin-top:25px;">REFRESH</button>
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
                                            <th>SL.NO</th>
                                            <th>Vendor Name</th>
                                            <th>Purchase Date</th>
                                            <th>Total Amount</th>
                                            <th>Remark</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody id="viewPurchaseDataTable">
                                        
                                    </tbody>
                                </table>
                                <table id="dataTable2"  class="table table-bordered" style="display:none">
                                    <thead>
                                        <tr><th colspan="12"><button class="btn btn-sm btn-primary back-button">Back</button></th></tr>
                                        <tr>
                                            <th>SL.NO</th>
                                            <th>Category-Brand-Product-Flavor</th>
                                            <th>Unit</th>
                                            <th>GST</th>
                                            <th>Qty</th>
                                            <th>Gst/Price</th>
                                            <th>Base/Price</th>
                                            <th>MRP</th>
                                            <th>Sale/Price</th>
                                            <th>Total</th>
                                            <th>Expiry</th>
                                        </tr>
                                    </thead>
                                    <tbody id="purchaseItems">
                                        
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
            const purchaseMaster = new Purchase();
            const vendorManager = new vendorReg();
            var check='purchase';
            vendorManager.fetchVendors(check);
            purchaseMaster.fetchItems();

            const addItem = document.getElementById('addPurchaseItem');
            addItem.addEventListener('click', () => 
            {
                purchaseMaster.Itemadd();
            });
        });
    </script>