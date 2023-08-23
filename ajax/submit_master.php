<?php
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

    if (isset($_POST['cate']) && isset($_POST['brand']) && isset($_POST['flavor']) && isset($_POST['product']) && isset($_POST['unni']) && isset($_POST['item_code'])) 
    {
        $slno = $_POST['slno'];
        $value = $_POST['value'];

        $cate = $_POST['cate'];
        $brand = $_POST['brand'];
        $flavor = $_POST['flavor'];
        $product = $_POST['product'];
        $unit = $_POST['unni'];
        $item_code = $_POST['item_code'];

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

    if (isset($_POST['ven']) && isset($_POST['purDate']) && isset($_POST['totalAmt']) && isset($_POST['itemList']))
    {
        $venName = $_POST['ven'];
        $purDate = $_POST['purDate'];
        $totalAmt = $_POST['totalAmt'];
        $itemList=$_POST['itemList'];
        
        $purchase= new Purchase($conn);
        $purchase->purchaseData($venName, $purDate, $totalAmt, $itemList);
        
    }
}

?>