<?php 
class CategoryAction 
{
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertData($name)
    {
        $name = ucfirst($name);
        $checkStmt = $this->conn->prepare("SELECT * FROM category WHERE cateName = ?");
        $checkStmt->bind_param("s", $name);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) 
        {
            echo json_encode(['message' => 'Data already exists']);
        }else 
        {

            $insertStmt = $this->conn->prepare("INSERT INTO category (cateName) VALUES (?)");
            $insertStmt->bind_param("s", $name);
            if ($insertStmt->execute()) 
            {
                echo json_encode(['message' => 'Data submitted successfully']);
            } else {
                echo json_encode(['message' => 'Error submitting data']);
            }
        }
    }

    public function updateData($name,$slno)
    {
        $checkStmt = $this->conn->prepare("SELECT * FROM category WHERE cateName = ? AND cat_id != ?");
        $checkStmt->bind_param("si", $name,$slno);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) 
        {
            echo json_encode(['message' => 'Data already exists']);
        }else
        {

            $updateStmt = $this->conn->prepare("UPDATE category SET cateName = ? WHERE cat_id=?");

            // $updatePurchaseStmt = $conn->prepare("UPDATE purchase SET cateName = ? WHERE cat_id = ?");
            // $updateStockStmt = $conn->prepare("UPDATE stock SET cateName = ? WHERE cat_id = ?");
            // $updateItemStmt = $conn->prepare("UPDATE item SET cateName = ? WHERE cat_id = ?");
            
            $updateStmt->bind_param("si", $name, $slno);
            $updateStmt->execute();
            if ($updateStmt->execute()) 
            {
                echo json_encode(['message' => 'Data updated successfully']);
            } else {
                echo json_encode(['message' => 'Failed to update data']);
            }
        }
    }
}

class FlavorAction 
{
    protected $conn;

    public function __construct($conn) 
    {
        $this->conn = $conn;
    }

    public function insertData($name)
    {
        $name = ucfirst($name);
        $checkStmt = $this->conn->prepare("SELECT * FROM flavor WHERE flavorName = ?");
        $checkStmt->bind_param("s", $name);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) 
        {
            echo json_encode(['message' => 'Flavor already exists']);
        }else 
        {
            $insertStmt = $this->conn->prepare("INSERT INTO flavor (flavorName) VALUES (?)");
            $insertStmt->bind_param("s", $name);
            if ($insertStmt->execute()) 
            {
                echo json_encode(['message' => 'Flavor submitted successfully']);
            } else {
                echo json_encode(['message' => 'Error submitting data']);
            }
        }
    }

    public function updateData($name,$slno)
    {
        $name = ucfirst($name);
        $checkStmt = $this->conn->prepare("SELECT * FROM flavor WHERE flavorName = ? AND id != ?");
        $checkStmt->bind_param("si", $name,$slno);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) 
        {
            echo json_encode(['message' => 'Flavor already exists']);
        }else
        {
            $updateStmt = $this->conn->prepare("UPDATE flavor SET flavorName = ? WHERE id=?");
            $updateStmt->bind_param("si", $name, $slno);
            $updateStmt->execute();
            if ($updateStmt->execute()) 
            {
                echo json_encode(['message' => 'Flavor updated successfully']);
            } else {
                echo json_encode(['message' => 'Failed to update data']);
            }
        }
    }

}

class BrandAction 
{
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertData($name)
    {
        $name = ucfirst($name);
        $checkStmt = $this->conn->prepare("SELECT * FROM brand WHERE brandName = ?");
        $checkStmt->bind_param("s", $name);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) 
        {
            echo json_encode(['message' => 'Brand already exists']);
        }else 
        {
            $insertStmt = $this->conn->prepare("INSERT INTO brand (brandName) VALUES (?)");
            $insertStmt->bind_param("s", $name);
            if ($insertStmt->execute()) 
            {
                echo json_encode(['message' => 'Brand submitted successfully']);
            } else {
                echo json_encode(['message' => 'Error submitting data']);
            }
        }
    }

    public function updateData($name,$slno)
    {
        $name = ucfirst($name);
        $checkStmt = $this->conn->prepare("SELECT * FROM brand WHERE brandName = ? AND id != ?");
        $checkStmt->bind_param("si", $name,$slno);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) 
        {
            echo json_encode(['message' => 'Brand already exists']);
        }else
        {
            $updateStmt = $this->conn->prepare("UPDATE brand SET brandName = ? WHERE id=?");
            $updateStmt->bind_param("si", $name, $slno);
            $updateStmt->execute();
            if ($updateStmt->execute()) 
            {
                echo json_encode(['message' => 'Brand updated successfully']);
            } else {
                echo json_encode(['message' => 'Failed to update data']);
            }
        }
    }
}

class GSTAction 
{
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function insertData($name)
    {
        $checkStmt = $this->conn->prepare("SELECT * FROM gst WHERE slab = ?");
        $checkStmt->bind_param("s", $name);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) 
        {
            echo json_encode(['message' => 'GST already exists']);
        }else 
        {
            $insertStmt = $this->conn->prepare("INSERT INTO gst (slab) VALUES (?)");
            $insertStmt->bind_param("s", $name);
            if ($insertStmt->execute()) 
            {
                echo json_encode(['message' => 'GST submitted successfully']);
            } else {
                echo json_encode(['message' => 'Error submitting data']);
            }
        }
    }

    public function updateData($name,$slno)
    {
        $checkStmt = $this->conn->prepare("SELECT * FROM gst WHERE slab = ? AND id != ?");
        $checkStmt->bind_param("si", $name,$slno);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) 
        {
            echo json_encode(['message' => 'GST already exists']);
        }else
        {
            $updateStmt = $this->conn->prepare("UPDATE gst SET slab = ? WHERE id=?");
            $updateStmt->bind_param("si", $name, $slno);
            $updateStmt->execute();
            if ($updateStmt->execute()) 
            {
                echo json_encode(['message' => 'GST updated successfully']);
            } else {
                echo json_encode(['message' => 'Failed to update data']);
            }
        }
    }
}

class UnitAction 
{
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function insertData($name)
    {
        $name = ucfirst($name);
        $checkStmt = $this->conn->prepare("SELECT * FROM unit WHERE unitName = ?");
        $checkStmt->bind_param("s", $name);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) 
        {
            echo json_encode(['message' => 'Unit already exists']);
        }else 
        {
            $insertStmt = $this->conn->prepare("INSERT INTO unit (unitName) VALUES (?)");
            $insertStmt->bind_param("s", $name);
            if ($insertStmt->execute()) 
            {
                echo json_encode(['message' => 'Unit submitted successfully']);
            } else {
                echo json_encode(['message' => 'Error submitting data']);
            }
        }
    }

    public function updateData($name,$slno)
    {
        $name = ucfirst($name);
        $checkStmt = $this->conn->prepare("SELECT * FROM unit WHERE unitName = ? AND id != ?");
        $checkStmt->bind_param("si", $name,$slno);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) 
        {
            echo json_encode(['message' => 'Unit already exists']);
        }else
        {
            $updateStmt = $this->conn->prepare("UPDATE unit SET unitName = ? WHERE id=?");
            $updateStmt->bind_param("si", $name, $slno);
            $updateStmt->execute();
            if ($updateStmt->execute()) 
            {
                echo json_encode(['message' => 'Unit updated successfully']);
            } else {
                echo json_encode(['message' => 'Failed to update data']);
            }
        }
    }
}

class LocationAction 
{
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function insertData($name)
    {
        $name = ucfirst($name);
        $checkStmt = $this->conn->prepare("SELECT * FROM `location` WHERE `location` = ?");
        $checkStmt->bind_param("s", $name);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) 
        {
            echo json_encode(['message' => 'Location already exists']);
        }else 
        {
            $insertStmt = $this->conn->prepare("INSERT INTO `location` (`location`) VALUES (?)");
            $insertStmt->bind_param("s", $name);
            if ($insertStmt->execute()) 
            {
                echo json_encode(['message' => 'Location submitted successfully']);
            } else {
                echo json_encode(['message' => 'Error submitting data']);
            }
        }
    }

    public function updateData($name,$slno)
    {
        $name = ucfirst($name);
        $checkStmt = $this->conn->prepare("SELECT * FROM `location` WHERE `location` = ? AND id != ?");
        $checkStmt->bind_param("si", $name,$slno);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) 
        {
            echo json_encode(['message' => 'Location already exists']);
        }else
        {
            $updateStmt = $this->conn->prepare("UPDATE `location` SET `location` = ? WHERE id=?");
            $updateStmt->bind_param("si", $name, $slno);
            $updateStmt->execute();
            if ($updateStmt->execute()) 
            {
                echo json_encode(['message' => 'Location updated successfully']);
            } else {
                echo json_encode(['message' => 'Failed to update data']);
            }
        }
    }
}


class Item {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertData($category, $brand, $flavor, $product, $unit, $item_code) 
    {
        $product = ucfirst($product);
        $checkStmt = $this->conn->prepare("SELECT COUNT(*) FROM item WHERE category = ? AND brand = ? AND product = ? AND item_code = ?");
        $checkStmt->bind_param("ssss", $category, $brand, $product,$item_code);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $rowCount = $checkResult->fetch_row()[0];

        if ($rowCount > 0) 
        {
            echo json_encode(['message' => 'Data already exists']);
        } 
        else 
        {
            try {
                $insertStmt = $this->conn->prepare("INSERT INTO item (category, brand,product, item_code) VALUES (?, ?, ?, ?)");
                $insertStmt->bind_param("ssss", $category, $brand,$product, $item_code);

                if ($insertStmt->execute())
                {
                    echo json_encode(['message' => 'Item submitted successfully']);
                } 
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) {
                    // Duplicate entry error
                    echo json_encode(['message' => 'Duplicate item code']);
                } else {
                    // Other insertion error
                    echo json_encode(['message' => 'Failed to insert data']);
                }
            }
        }

        $checkStmt->close();
    }

    public function updateData($category, $brand, $flavor, $product, $unit, $item_code, $slno)
    {
        $product = ucfirst($product);
        $checkStmt = $this->conn->prepare("SELECT COUNT(*) FROM item WHERE category = ? AND brand = ? AND product = ? AND item_code = ? AND id != ?");
        $checkStmt->bind_param("ssssi", $category, $brand, $product,$item_code,$slno);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $rowCount = $checkResult->fetch_row()[0];
        if ($rowCount > 0) 
        {
            echo json_encode(['message' => 'Data already exists']);
        }else
        {
            try{
                    $updateStmt=$this->conn->prepare("UPDATE item SET category = ? , brand = ?, product = ?, item_code = ? WHERE id= ?");
                    $updateStmt->bind_param("ssssi", $category, $brand, $product,$item_code,$slno);
                    $updateStmt->execute();
                    if ($updateStmt->execute()) 
                    {
                        echo json_encode(['message' => 'Item Updated successfully']);
                    }
            }catch(mysqli_sql_exception $e)
            {
                if ($e->getCode() == 1062) {
                    // Duplicate entry error
                    echo json_encode(['message' => 'Duplicate item code']);
                } else {
                    // Other insertion error
                    echo json_encode(['message' => 'Failed to insert data']);
                }
            }
            
        }
    } 
}

class Vendor {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function insertData($venName, $venGst, $venMobile, $venAdds) 
    {
        $venName = ucfirst($venName);
        if($venGst !='')
        {
            $checkGstStmt = $this->conn->prepare("SELECT COUNT(*) FROM vendor WHERE venGst = ?");
            $checkGstStmt->bind_param("s", $venGst);
            $checkGstStmt->execute();
            $checkGstResult = $checkGstStmt->get_result();
            $rowCountGst = $checkGstResult->fetch_row()[0];
        }else
        {
            $rowCountGst=0;
        }
        // Check if venMobile already exists
        $checkMobileStmt = $this->conn->prepare("SELECT COUNT(*) FROM vendor WHERE venMobile = ?");
        $checkMobileStmt->bind_param("s", $venMobile);
        $checkMobileStmt->execute();
        $checkMobileResult = $checkMobileStmt->get_result();
        $rowCountMobile = $checkMobileResult->fetch_row()[0];
    
        if ($rowCountGst > 0)
        {
            echo json_encode(['message' => 'Vendor GST already exists']);
        } 
        elseif ($rowCountMobile > 0) 
        {
            echo json_encode(['message' => 'Vendor Mobile already exists']);
        }else
        {
            try{    
                $insertStmt = $this->conn->prepare("INSERT INTO vendor (venName, venGst, venMobile, venAdds) VALUES (?, ?, ?, ?)");
                $insertStmt->bind_param("ssss", $venName, $venGst, $venMobile, $venAdds);
                if ($insertStmt->execute())
                {
                    echo json_encode(['message' => 'Vendor inserted successfully']);
                }
                else 
                {
                    echo json_encode(['message' => 'Failed to insert data']);
                }
                $insertStmt->close();
            }catch (mysqli_sql_exception $e)
            {
                echo json_encode(['message' => 'Something Went Wrong..']);
            }
           
        }
    }

    public function updateData($venName, $venGst, $venMobile, $venAdds,$slno) 
    {
        $venName = ucfirst($venName);
        if($venGst !='')
        {
            $checkGstStmt = $this->conn->prepare("SELECT COUNT(*) FROM vendor WHERE venGst = ? AND id != ?");
            $checkGstStmt->bind_param("si", $venGst,$slno);
            $checkGstStmt->execute();
            $checkGstResult = $checkGstStmt->get_result();
            $rowCountGst = $checkGstResult->fetch_row()[0];
        }else
        {
            $rowCountGst=0;
        }
        // Check if venMobile already exists
        $checkMobileStmt = $this->conn->prepare("SELECT COUNT(*) FROM vendor WHERE venMobile = ? AND id != ?");
        $checkMobileStmt->bind_param("si", $venMobile,$slno);
        $checkMobileStmt->execute();
        $checkMobileResult = $checkMobileStmt->get_result();
        $rowCountMobile = $checkMobileResult->fetch_row()[0];
    
        if ($rowCountGst > 0)
        {
            echo json_encode(['message' => 'Vendor GST already exists']);
        } 
        elseif ($rowCountMobile > 0) 
        {
            echo json_encode(['message' => 'Vendor Mobile already exists']);
        }else
        {
            try{
                $updateStmt=$this->conn->prepare("UPDATE vendor SET venName = ? , venGst = ?, venMobile = ?, venAdds = ? WHERE id= ?");
                $updateStmt->bind_param("ssssi", $venName, $venGst, $venMobile, $venAdds,$slno);
                $updateStmt->execute();
                if ($updateStmt->execute()) 
                {
                    echo json_encode(['message' => 'Vendor Updated successfully']);
                }
            }catch (mysqli_sql_exception $e)
            {
                echo json_encode(['message' => 'Something Went Wrong..']);
            }
        }
    }
}

class Purchase
{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function purchaseData($venName, $purDate, $totalAmt, $itemList,$remark) 
    {
        try{
            $purchaseStmt=$this->conn->prepare("INSERT INTO `purchase`(`venName`, `purchase_date`, `totalamount`,`remark`) VALUES (?,?,?,?)");
            $purchaseStmt->bind_param("ssds",$venName,$purDate,$totalAmt,$remark);
            if($purchaseStmt->execute())
            {
                try{
                    $purchaseId = $purchaseStmt->insert_id;
                    $allQueriesSuccessful = "false";
                    foreach($itemList as $item)
                    {
                        $category=$item['category'];
                        $brand=$item['brand'];
                        $product=$item['product'];
                        $flavor=$item['flavor'];
                        $unit=$item['unit'];
                        $location=$item['location'];
                        $expDate=$item['expDate'];
                        $gst=$item['gst'];
                        $qty=$item['qty'];
                        $price=$item['price'];
                        $gstPer=$item['gstPer'];
                        $basePer=$item['basePer'];
                        $mrpPrice=$item['mrpPrice'];
                        $salePrice=$item['salePrice'];
                        $item_code=$item['item_code'];
                        $unitQty=$item['unitQty'];
                        $purchase_dataStmt=$this->conn->prepare("INSERT INTO `purchase_data`(`category`, `brand`, `product`, `flavor`, `unit`, `location`, `exp`, `gst`, `qty`, `totalprice`, `gstprice`, `baseprice`, `mrpprice`, `saleprice`, `item_code`, `pur_id`,`unitQty`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                        $purchase_dataStmt->bind_param("sssssssdddddddsis",$category,$brand,$product,$flavor,$unit,$location,$expDate,$gst,$qty,$price,$gstPer,$basePer,$mrpPrice,$salePrice,$item_code,$purchaseId,$unitQty);
                        if($purchase_dataStmt->execute())
                        {
                            $stock_dataStmt=$this->conn->prepare("INSERT INTO `stock`(`category`, `brand`, `product`, `flavor`, `unit`, `location`, `exp`, `gst`, `qty`, `totalprice`, `gstprice`, `baseprice`, `mrpprice`, `saleprice`, `item_code`, `pur_id`,`unitQty`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                            $stock_dataStmt->bind_param("sssssssdddddddsis",$category,$brand,$product,$flavor,$unit,$location,$expDate,$gst,$qty,$price,$gstPer,$basePer,$mrpPrice,$salePrice,$item_code,$purchaseId,$unitQty);
                            if($stock_dataStmt->execute())
                            {
                                $allQueriesSuccessful = "true";  
                            }
                        }
                    }
                    if($allQueriesSuccessful=='true') 
                    {
                        echo json_encode(['message' => 'Purchased successfully..']);
                    }
                }catch(mysqli_sql_exception $nestedException)
                {
                    echo json_encode(['message' => 'Something Went Wrong..']);
                }
            }else 
            {
                echo json_encode(['message' => 'Failed to insert data']);
            }

        }catch(mysqli_sql_exception $e)
        {
            echo json_encode(['message' => 'Something Went Wrong..']);
        }
    }
}


class Invoice
{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function invoiceData($custName, $saleDate, $totalAmt,$gstsel,$pay,$saleitemList,$custgst,$custmobile,$custadds)
    {
        // $invoiceStmt=$this->conn->prepare("INSERT INTO `invoice`(`custName`,`date`, `totalAmt`, `gstType`,`payMode`) VALUES (?,?,?,?,?)");
        $invoiceStmt=$this->conn->prepare("INSERT INTO `invoice`(`custName`,`date`, `totalAmt`, `gstType`, `payMode`,`custGst`, `custMobile`, `custAdds`)
        VALUES (?,?,?,?,?,?,?,?)");
        $invoiceStmt->bind_param("ssdsssss",$custName,$saleDate,$totalAmt,$gstsel,$pay,$custgst,$custmobile,$custadds);
        if($invoiceStmt->execute())
        {
            $allQueriesSuccessful = "false";
            $invoiceId = $invoiceStmt->insert_id;
            foreach($saleitemList as $item)
            {
                $category=$item['category'];
                $brand=$item['brand'];
                $product=$item['product'];
                $flavor=$item['flavor'];
                $unit=$item['unit'];
                $item_code=$item['item_code'];

                $gst=$item['gst'];
                $saleQty=$item['saleQty'];
                $oldqty=$item['oldqty'];
                $rate=$item['perItem'];
                $amount=$item['BAseAmount'];
                $gstAmount=$item['gstAmount'];
                $totalAmount=$item['total'];

                $unitQty=$item['unitQty'];

                $stockid=$item['stockid'];

                $igst=0;
                $cgst=0;
                $sgst=0;
                if($gstsel=='igst')
                {
                    $igst=$gstAmount;
                }else if($gstsel=='gst')
                {
                    $cgst=$gstAmount/2;
                    $sgst=$gstAmount/2;
                }   

                    //profit Calculation
                $basepur=$item['basepur'];
                $rate=$item['perItem'];

                $perPfofit=$rate-$basepur;
                $totalProfit=$perPfofit*$saleQty;

                    // ADDING INVOICE DATA
                $invoiceDataStmt=$this->conn->prepare("INSERT INTO `invoice_data`(`category`, `brand`, `product`, `flavor`, `unit`, `gst`, `qty`, `rate`, `amount`, `sgst`, `cgst`, `igst`, `totalGst`, `totalAmount`, `inv_no`, `item_code`,`unitQty`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $invoiceDataStmt->bind_param("sssssdddddddddiss",$category,$brand,$product,$flavor,$unit,$gst,$saleQty,$rate,$amount,$sgst,$cgst,$igst,$gstAmount,$totalAmount,$invoiceId,$item_code,$unitQty);
                if($invoiceDataStmt->execute())
                {
                    $invoiceDataId = $invoiceDataStmt->insert_id;
                    $updatedQty=$oldqty-$saleQty;
                    $updateStmt=$this->conn->prepare("UPDATE stock SET qty = ? WHERE id= ?");
                    $updateStmt->bind_param("di", $updatedQty, $stockid);
                    if($updateStmt->execute())
                    {
                        $pfofitInsert=$this->conn->prepare("INSERT INTO `profit`(`basePur`, `baseSale`, `profitPer`, `qty`, `totalPfofit`, `ivoice_id`, `ivoicedata_id`) VALUES (?,?,?,?,?,?,?)");
                        $pfofitInsert->bind_param("dddddii",$basepur,$rate,$perPfofit,$saleQty,$totalProfit,$invoiceId,$invoiceDataId);
                        if($pfofitInsert->execute())
                        {
                            $allQueriesSuccessful = "true";  
                        }
                    }
                }
            }

            if($allQueriesSuccessful=='true') 
            {
                echo json_encode(['message' => 'Submited successfully..']);
            }
        }else 
        {
            echo json_encode(['message' => 'Failed to insert data']);
        }
    }
}


// public function invoiceData($custName, $saleDate, $totalAmt, $gstsel, $pay, $saleitemList)
// {
//     // Start a transaction
//     $this->conn->begin_transaction();

//     $invoiceStmt = $this->conn->prepare("INSERT INTO `invoice`(`custName`,`date`, `totalAmt`, `gstType`, `payMode`) VALUES (?,?,?,?,?)");
//     $invoiceStmt->bind_param("ssdss", $custName, $saleDate, $totalAmt, $gstsel, $pay);
//     if ($invoiceStmt->execute()) {
//         $invoiceId = $invoiceStmt->insert_id;
//         $success = true;

//         foreach ($saleitemList as $item) {
//             // ... Your item details extraction code ...

//             // ... Your GST calculation code ...

//             // ... Your profit calculation code ...

//             // ADDING INVOICE DATA
//             $invoiceDataStmt = $this->conn->prepare("INSERT INTO `invoice_data`(...) VALUES (...)");
//             $invoiceDataStmt->bind_param("...", ...);
//             if ($invoiceDataStmt->execute()) {
//                 $invoiceDataId = $invoiceDataStmt->insert_id;

//                 // ... Update stock and profit tables ...

//             } else {
//                 $success = false;
//                 break; // Break the loop if an item insertion fails
//             }
//         }

//         if ($success) {
//             $this->conn->commit(); // Commit the transaction if all queries succeed
//             echo json_encode(['message' => 'Submitted successfully..']);
//         } else {
//             $this->conn->rollback(); // Rollback the transaction if any query fails
//             echo json_encode(['message' => 'Failed to insert data']);
//         }
//     } else {
//         $this->conn->rollback(); // Rollback the transaction if invoice insertion fails
//         echo json_encode(['message' => 'Failed to insert data']);
//     }

//     // Close prepared statements
//     $invoiceStmt->close();
//     $invoiceDataStmt->close();

//     // End the transaction
//     $this->conn->close();
// }

// public function invoiceData($custName, $saleDate, $totalAmt, $gstsel, $pay, $saleitemList)
// {
//     // Start a transaction
//     $this->conn->begin_transaction();

//     try {
//         // Insert invoice details
//         $invoiceStmt = $this->conn->prepare("INSERT INTO `invoice`(`custName`, `date`, `totalAmt`, `gstType`, `payMode`) VALUES (?, ?, ?, ?, ?)");
//         $invoiceStmt->bind_param("ssdss", $custName, $saleDate, $totalAmt, $gstsel, $pay);
        
//         if (!$invoiceStmt->execute()) {
//             throw new Exception("Failed to insert invoice details");
//         }

//         $invoiceId = $invoiceStmt->insert_id;

//         // Insert sale items and related data
//         foreach ($saleitemList as $item) {
//             // Extract item details
            
//             // Prepare and execute invoice data insertion query
//             $invoiceDataStmt = $this->conn->prepare("INSERT INTO `invoice_data`(...) VALUES (...)");
//             $invoiceDataStmt->bind_param("...", ...);
            
//             if (!$invoiceDataStmt->execute()) {
//                 throw new Exception("Failed to insert invoice data");
//             }

//             // Update stock and profit tables
            
//         }

//         // If everything is successful, commit the transaction
//         $this->conn->commit();
//         echo json_encode(['message' => 'Submitted successfully..']);
//     } catch (Exception $e) {
//         // If any part of the process fails, rollback the transaction
//         $this->conn->rollback();
//         echo json_encode(['message' => 'Failed to insert data']);
//     } finally {
//         // Close prepared statements
//         $invoiceStmt->close();
//         $invoiceDataStmt->close();
        
//         // Close the database connection
//         $this->conn->close();
//     }
// }

?>