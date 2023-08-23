<?php 
    include("header.php");
?>
    <style>
        #item
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
                    <h4>ITEM</h4>
                </div>
            </div>
            <div class="box-header">
                <div class="getSpace">
                </div>
                <div class="cat active" id="itembox">
                    <h6 class="box-header-names">ITEM MASTER</h6>
                </div>
                <div class="getSpace">
                </div>
            </div>
            <div class="box-content">
                <div class="container-fluid adding-category">
                    <div class="row">
                        <div class="col-md-12">
                            <center></br>
                            <button class="btn btn-danger" id="toggleRows">Add Items</button></center>
                        </div>
                    </div>
                    <div class="row hidden-rows">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="slno" placeholder="Type Here...">
                                <label for="cate">Select Category</label>
                                <select class="form-control" id="category">
                                    <option value="">Select Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Select Brand</label>
                                <select class="form-control" id="brand">
                                    <option value="">Select Brand</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Product Name</label>
                                <input type="text" class="form-control" id="product" placeholder="Type Here...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Select Flavor</label>
                                <select class="form-control" id="flavor">
                                    <option value="">Select Flavor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Select Unit</label>
                                <select class="form-control" id="unit">
                                    <option value="">Select Unit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Item Code</label>
                                <input type="text" class="form-control" id="item_code" placeholder="Type Here...">
                            </div>
                        </div>
                    </div>
                    <div class="row hidden-rows">
                        <div class="col-md-12">
                            <center><button class="btn btn-info" id="addItem">ADD</button><button class="btn btn-info" id="updateItem" style="display:none;">UPDATE</button></center>
                            <div id="response"></div>
                        </div>
                    </div></br>
                </div></br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <center><h4 class="content-header">VIEW ITEM</h4></center>
                        </div>
                    </div>
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
                                            <th>Brand</th>
                                            <th>Product</th>
                                            <th>Flavor</th>
                                            <th>Unit</th>
                                            <th>Code</th>
                                            <th>EDIT/DELETE</th>
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
    </div>
    <script>
        $(document).ready(function()
        {
            const dropdownManager = new ItemTab();
            dropdownManager.fetchData();
            
        });
    </script>