<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/main.js"></script>

        <style>
            .box{
                padding-top:10px;
            }
            .box1
            {
                padding:10px;
            }
            .box h5
            {
                font-size:16px;
            }
            .box span
            {
                margin-left:10px;
                font-size:14px;
            }
        </style>
    </head>
<body>
    <div class="container-fluid">
        </br>
        <div class="row">
            <div class="col-md-6">
                <div class="box1">
                    <h2>FLEX NUTRISHOP</h2>
                    <h6>SHOP NO 02, SHIVARSHNI APTS, OLD INCOME TAX ROAD,</h6>
                    <h6>NEAR NOOLVI BUILDING, VIDHYANAGAR, HUBLI - 580021</h6>
                    <h4>PH NO   : 7021659424</h4>
                    <h4>GSTIN: 29ASFPK4675E1ZI</h4>
                    <h4>STATE CODE: 29 KARNATAKA</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box">
                    <h5>GST INVOICE</h5>
                    <P>CASH / CREDIT / MEMO</P>
                </div>
                <div class="box">
                    <h5><b>NAME: M/S.</b><span id="name"></span></h5>
                    <h5><b>ADDRESS:</b><span id="adds"></span></h5>
                    <h5><b>MOBILE NO:</b><span id="mobile"></span></h5>
                    <h5><b>MODE OF PAYMENT:</b><span id="pay"></span></h5>
                    <h5><b>PARTY GST:</b><span id="gst"></span></h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box">
                    <h5><b>INVOICE NO :</b><span id="inv"></span></h5>
                    <h5><b>Date :</b><span id="date"></span></h5>
                    <p>GOODS DESPATCHED THROUGH</p>
                    </br>
                    <p>E WAY. BILL NO:</p>
                    </br>
                </div>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL.NO</th>
                            <th>PARTICULAR</th>
                            <th>TAX%</th>
                            <th>QTY</th>
                            <th>RATE</th>
                            <th>AMOUNT</th>
                            <th>SGST</th>
                            <th>CGST</th>
                            <th>IGST</th>
                            <th>AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody id="tableDataInvoice">
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="9" class="text-right">Total Amount</th>
                            <th id="totalAmt"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 text-right">
                <p>Subject to Hubali Jurisdiction<p>
            </div>
            <div class="col-md-5 text-right">
                <p><b>For.</b>Flex Nutrishop</p>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="col-md-5">
                <p><b>Note:</b><span>GOODS ONCE SOLD CANNOT TAKEN BACK.</span></p>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-3">
                <p><span>Customer's Signature</span></p>
            </div>
            <div class="col-md-2">
                <p><span>Proprietor</span></p>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function()
        {
            const invoiceFinal= new FinalInvoice();
            invoiceFinal.loadTableData();
        });
    </script>
</body>
</html>