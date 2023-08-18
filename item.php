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
                            <center><h4 class="content-header">ADD ITEM</h4></center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Select Category</label>
                                <input type="text" class="form-control" id="category">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Select Brand</label>
                                <input type="text" class="form-control" id="brand">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Product Name</label>
                                <input type="text" class="form-control" id="product">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Select Flavor</label>
                                <input type="text" class="form-control" id="flavor">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Select Unit</label>
                                <input type="text" class="form-control" id="unit">
                            </div>
                        </div>
                    </div>
                </div></br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <center><h4 class="content-header">VIEW ITEM</h4></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>