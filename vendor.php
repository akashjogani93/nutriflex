<?php 
    include("header.php");
?>
    <style>
        #vendor
        {
            background-color: white;
            color:black;
        }
        .active
        {
            /* background-color: #393E46; */
            background-color: white;
        }
    </style>
    <div class="content">
        <div class="container main mt-5">
            <div class="box">
                <div class="header">
                    <h4>VENDOR</h4>
                </div>
            </div>
            <div class="box-header">
                <!-- <div class="getSpace">
                </div> -->
                <div class="cat active" id="itembox">
                    <h6 class="box-header-names">VENDOR MASTER</h6>
                </div>
                <div class="getSpace">
                </div>
            </div>
            <div class="box-content">
                <div class="container-fluid adding-category">
                    <div class="row">
                        <div class="col-md-12">
                            <center><h4 class="content-header">ADD VENDOR</h4></center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cate">Vendor Name</label>
                                <input type="text" class="form-control" id="venName">
                                <input type="hidden" class="form-control" id="slno">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Vendor GST</label>
                                <input type="text" class="form-control" id="venGst">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cate">Vendor Mobile</label>
                                <input type="text" class="form-control" id="venMobile">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cate">Vendor Address</label>
                                <input type="text" class="form-control" id="venAdds">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <center><button class="btn btn-info" id="addvendor" style="margin-top:25px;">ADD</button><button class="btn btn-info" id="updatevendor" style="display:none; margin-top:25px;">UPDATE</button></center>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center><div id="response"></div></center>
                        </div>
                    </div>
                </div></br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <center><h4 class="content-header">VIEW VENDOR</h4></center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-container">
                                <table id="dataTable"  class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Vendor Name</th>
                                            <th>GST</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Edit</th>
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
            const vendorManager = new vendorReg();
            var check='vendor';
            vendorManager.fetchVendors(check);
            // const vm=this;
            const submitButton = document.getElementById('addvendor');
            const updateButton = document.getElementById('updatevendor');
            submitButton.addEventListener('click', () => 
            {
                vendorManager.submitData(0)
            });
            updateButton.addEventListener('click', () => 
            {
                vendorManager.submitData(1)
            }); 
        });
    </script>