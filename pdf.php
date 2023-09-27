<?php
namespace Dompdf;
require_once 'dompdf/autoload.inc.php';

$dompdf = new Dompdf();

$html = <<<HTML
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
        /* Add your CSS styles here as needed. Use inline styles for critical elements. */
        .main {
            margin-top: 15px;
            margin-right: 15px;
            margin-left: 15px;
        }
        h2 {
            font-weight: bold;
        }

        strong {
            font-size: 12px;
        }
        h6 {
            font-size: 14px;
        }
        p {
            font-size: 10px;
        }
        .table > thead, tfoot > tr > th, td {
            font-size: 12px;
        }
        .custDetails, .details {
            border: 1px solid #dee2e6;
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="main">
        <div class="row">
            <div class="col-md-5">
                <div class="box1">
                    <h2 style="font-weight: bold;">FLEX NUTRISHOP</h2>
                    <strong>SHOP NO 02, SHIVARSHNI APTS, OLD INCOME TAX ROAD,</strong>
                    <strong>NEAR NOOLVI BUILDING, VIDHYANAGAR, HUBLI - 580021</strong><br>
                    <strong>PH NO : 7021659424 | GSTIN: 29ASFPK4675E1ZI | STATE CODE: 29 KARNATAKA</strong>
                </div>
            </div>
            <div class="col-md-4">
                <div class="custDetails">
                    <h6><b>NAME : M/S. </b><span id="name">John Doe</span></h6>
                    <h6><b>ADDRESS : </b><span id="adds">123 Main Street</span></h6>
                    <h6><b>MOBILE NO : </b><span id="mobile">123-456-7890</span></h6>
                    <h6><b>MODE OF PAYMENT : </b><span id="pay">Credit Card</span></h6>
                    <h6><b>PARTY GST :</b><span id="gst">GST123456789</span></h6>
                </div>
            </div>
            <div class="col-md-3">
                <div class="details" style="margin-bottom: 4px;">
                    <h6><b>INVOICE NO : </b><span id="inv">INV-12345</span></h6>
                    <h6><b>Date : </b><span id="date">2023-09-16</span></h6>
                </div>
                <div class="details">
                    <p>GOODS DESPATCHED THROUGH : </p>
                </div>
                <div class="details" style="border-top: 0">
                    <p>E WAY. BILL NO : </p>
                </div>
            </div>
        </div>
        <br>
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
                        <!-- Add your table data here -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7" id="inwords"></th>
                            <th colspan="2" class="text-right">Total Amount</th>
                            <th id="totalAmt"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 text-right">
                <p>Subject to Hubali Jurisdiction</p>
            </div>
            <div class="col-md-5 text-right">
                <p><b>FOR. </b>Flex Nutrishop</p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <p><b>NOTE :</b><span> GOODS ONCE SOLD CANNOT BE TAKEN BACK.</span></p>
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
</div>
</body>
</html>
HTML;

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="invoice.pdf"');

// Output the PDF
echo $dompdf->output();
exit(0);
?>
