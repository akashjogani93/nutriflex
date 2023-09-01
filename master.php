<?php 
    include("header.php");
?>
    <style>
        #master
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
                    <h4>MASTER</h4>
                </div>
            </div>
            <div class="box-header">
                <!-- <div class="getSpace">
                </div> -->
                <div class="cat active" id="category">
                    <h6 class="box-header-names">Category</h6>
                </div>
                <div class="getSpace">
                </div>
                <div class="cat" id="flavor">
                    <h6 class="box-header-names">Flavour</h6>
                </div>
                <div class="getSpace">
                </div>  
                <div class="cat" id="brand">
                    <h6 class="box-header-names">Brand</h6>
                </div>
                <div class="getSpace">
                </div>
                <div class="cat" id="gst">
                    <h6 class="box-header-names">GST Slab</h6>
                </div>
                <div class="getSpace">
                </div>
                <div class="cat" id="unit">
                    <h6 class="box-header-names">Unit</h6>
                </div>
                <div class="getSpace">
                </div>
                <div class="cat" id="location">
                    <h6 class="box-header-names">Rack Location</h6>
                </div>
                <div class="getSpace">
                </div>
            </div>
            <div class="box-content">
                
            </div>

        </div>
    </div>
    <?php include('footer.php'); ?>
    <script>
        $(document).ready(function()
        {
            const tabManager = new TabManager();
            $('#category').click();
        });
    </script>