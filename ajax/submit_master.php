<?php
session_start();
include('../connect.php');
include('submit_all.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if (isset($_POST['tabId']) && isset($_POST['status']) && isset($_POST['data'])) 
    {
        $tabId = $_POST['tabId'];
        $status = $_POST['status'];
        $slno = $_POST['data']['slno'];
        $name = $_POST['data']['name'];


        $tableActions = [
            "category" => new CategoryAction($conn),
            "flavor" => new FlavorAction($conn),
            "brand" => new BrandAction($conn),
            "gst" => new GSTAction($conn),
            "unit" => new UnitAction($conn),
            "location" => new LocationAction($conn),
        ];

        if (array_key_exists($tabId, $tableActions)) 
        {
            $tableAction = $tableActions[$tabId];
            if ($status == 0) {
                $tableAction->insertData($name);
            } elseif ($status == 1) 
            {
                $tableAction->updateData($name,$slno);
            } else {
                echo json_encode(['message' => 'Invalid status']);
            }
        }
    }

    if (isset($_POST['cate']) && isset($_POST['brand']) && isset($_POST['product']) && isset($_POST['item_code'])) 
    {
        $slno = $_POST['slno'];
        $value = $_POST['value'];

        $cate = $_POST['cate'];
        $brand = $_POST['brand'];
        // $flavor = $_POST['flavor'];
        $product = $_POST['product'];
        // $unit = $_POST['unni'];
        $item_code = $_POST['item_code'];

        $flavor='';
        $unit='';
        $item = new Item($conn);
        if($value==0)
        {
            $item->insertData($cate, $brand, $flavor, $product, $unit, $item_code);
        }
        else
        {
            $item->updateData($cate, $brand, $flavor, $product, $unit, $item_code, $slno);
        }
    }

    if (isset($_POST['venName']) && isset($_POST['venGst']) && isset($_POST['venMobile']) && isset($_POST['venAdds']) && isset($_POST['slno']) && isset($_POST['value'])) 
    {
        $slno = $_POST['slno'];
        $value = $_POST['value'];

        $venName = $_POST['venName'];
        $venGst = $_POST['venGst'];
        $venMobile = $_POST['venMobile'];
        $venAdds = $_POST['venAdds'];
        $ven = new Vendor($conn);
        if($value==0)
        {
            $ven->insertData($venName, $venGst, $venMobile, $venAdds);
        }else
        {
            $ven->updateData($venName, $venGst, $venMobile, $venAdds,$slno);
        }
    }

    if (isset($_POST['ven']) && isset($_POST['purDate']) && isset($_POST['totalAmt']) && isset($_POST['itemList']) && isset($_POST['remark']))
    {
        $venName = $_POST['ven'];
        $purDate = $_POST['purDate'];
        $totalAmt = $_POST['totalAmt'];
        $itemList=$_POST['itemList'];
        $remark=$_POST['remark'];
        
        $purchase= new Purchase($conn);
        $purchase->purchaseData($venName, $purDate, $totalAmt, $itemList,$remark);
        
    }

    if (isset($_POST['custName']) && isset($_POST['saleDate']) && isset($_POST['totalAmt']) && isset($_POST['saleitemList']))
    {
        $custName = $_POST['custName'];
        $custgst = $_POST['custgst'];
        $custmobile = $_POST['custmobile'];
        $custadds = $_POST['custadds'];
        $saleDate = $_POST['saleDate'];
        $totalAmt = $_POST['totalAmt'];
        $gstsel = $_POST['gstsel'];
        $pay = $_POST['pay'];
        $saleitemList=$_POST['saleitemList'];
        // echo json_encode(['message' => 'Something Went Wrong..']);
        $purchase= new Invoice($conn);
        $purchase->invoiceData($custName, $saleDate, $totalAmt,$gstsel,$pay,$saleitemList,$custgst,$custmobile,$custadds);
        
    }


    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $user=$_POST['username'];
        $pass=$_POST['password'];

        $checkStmt=$conn->prepare("SELECT * FROM `login` WHERE `user` = ? AND `pass` = ? ");
        $checkStmt->bind_param("ss",$user,$pass);

        $checkStmt->execute();

        $result = $checkStmt->get_result();

        if ($result->num_rows == 1) 
        {
            $_SESSION['login'] = "login";
            echo 0;
        } else {
            echo 1;
        }
        $checkStmt->close();
        }
}

?>