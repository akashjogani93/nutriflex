<?php 
    include('../connect.php');



$tableName = "";
$maxtableName = "";
if(isset($_GET['tabId']))
{
    $tabId = $_GET['tabId'];
    if ($tabId === "category") {
        $tableName = "category";
    } elseif ($tabId === "flavor") {
        $tableName = "flavor";
    } elseif ($tabId === "brand") {
        $tableName = "brand";
    }elseif ($tabId === "gst") {
        $tableName = "gst";
    }elseif ($tabId === "unit") {
        $tableName = "unit";
    }elseif ($tabId === "location") {
        $tableName = "location";
    }
}

if(isset($_GET['maxslno']))
{
    $maxslno = $_GET['maxslno'];
    if ($maxslno === "category") 
    {
        $maxtableName = "category";
        $id='cat_id';
    } elseif ($maxslno === "flavor") 
    {
        $maxtableName = "flavor";
        $id='id';
    } elseif ($maxslno === "brand") 
    {
        $maxtableName = "brand";
        $id='id';
    }elseif ($maxslno === "gst") 
    {
        $maxtableName = "gst";
        $id='id';
    }elseif ($maxslno === "unit") 
    {
        $maxtableName = "unit";
        $id='id';
    }elseif ($maxslno === "location") 
    {
        $maxtableName = "location";
        $id='id';
    }
}

if (!empty($tableName)) 
{
    $data = array();
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
}



if (!empty($maxtableName)) 
{
    $sql = "SELECT MAX($id) AS maxSlno FROM $maxtableName";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $maxSlno = $row['maxSlno']+1;
        echo json_encode(['maxSlno' => $maxSlno]);
    } else {
        echo json_encode(['maxSlno' => 0]); // Default value if no rows found
    }
}


if(isset($_GET['item']))
{
    $item=$_GET["item"];
    if($item=='fetch_items')
    {
        $tabno='item';
    }else if($item=='fetch_vendors')
    {
        $tabno='vendor';
    }

    $fetchStmt=$conn->prepare("SELECT * FROM $tabno");
    $fetchStmt->execute();
    $result=$fetchStmt->get_result();

    $rows=array();
    while($row=$result->fetch_assoc())
    {
        $rows[] =$row;
    }
    echo json_encode($rows);
    $fetchStmt->close();
}

//purchase

if(isset($_GET['purchase']))
{
    $purchaseno=$_GET["purchase"];
    if($purchaseno=='category')
    {
        $fetchStmt=$conn->prepare("SELECT DISTINCT `category` FROM `item`");
    }else if($purchaseno=='location')
    {
        $fetchStmt=$conn->prepare("SELECT * FROM `location`");
    }else if($purchaseno=='gst')
    {
        $fetchStmt=$conn->prepare("SELECT * FROM `gst`");
    }
    
    $fetchStmt->execute();
    $result=$fetchStmt->get_result();

    $rows=array();
    while($row=$result->fetch_assoc())
    {
        $rows[] =$row;
    }
    echo json_encode($rows);
    $fetchStmt->close();
}

if(isset($_POST['id1']))
{
    $inputId=$_POST['id1'];
    if($inputId=='category')
    {
        $category=$_POST['category1'];

        $fetchStmt=$conn->prepare("SELECT DISTINCT `brand` AS `name` FROM `item` WHERE category = ?");
        $fetchStmt->bind_param("s", $category); 
    }
    else if($inputId=='brand')
    {
        $category=$_POST['category1'];
        $brand=$_POST['brand1'];

        $fetchStmt=$conn->prepare("SELECT DISTINCT `product` AS `name` FROM `item` WHERE `category` = ? AND `brand` = ?");
        $fetchStmt->bind_param("ss", $category,$brand); 
    }
    else if($inputId=='product')
    {
        $category=$_POST['category1'];
        $brand=$_POST['brand1'];
        $product=$_POST['product1'];

        $fetchStmt=$conn->prepare("SELECT DISTINCT `flavor` AS `name` FROM `item` WHERE `category` = ? AND `brand` = ? AND `product` = ?");
        $fetchStmt->bind_param("sss", $category,$brand,$product); 
    }
    else if($inputId=='flavor')
    {
        $category=$_POST['category1'];
        $brand=$_POST['brand1'];
        $product=$_POST['product1'];
        $flavor=$_POST['flavor1'];

        $fetchStmt=$conn->prepare("SELECT DISTINCT `unit` AS `name` FROM `item` WHERE `category` = ? AND `brand` = ? AND `product` = ? AND `flavor` = ?");
        $fetchStmt->bind_param("ssss", $category,$brand,$product,$flavor); 

    }else if($inputId=='unit')
    {
        $category=$_POST['category1'];
        $brand=$_POST['brand1'];
        $product=$_POST['product1'];
        $flavor=$_POST['flavor1'];
        $unit=$_POST['unit1'];

        $fetchStmt=$conn->prepare("SELECT DISTINCT `item_code` AS `name` FROM `item` WHERE `category` = ? AND `brand` = ? AND `product` = ? AND `flavor` = ? AND `unit` = ?");
        $fetchStmt->bind_param("sssss", $category,$brand,$product,$flavor,$unit);

    }else if($inputId=='item_code')
    {
        $item_code1=$_POST['item_code1'];

        $fetchStmt=$conn->prepare("SELECT * FROM `item` WHERE `item_code` = ?");
        $fetchStmt->bind_param("s", $item_code1);
    }

    
    $fetchStmt->execute();
    $result=$fetchStmt->get_result();
    $rows=array();
    while($row=$result->fetch_assoc())
    {
        $rows[] =$row;
    }
    echo json_encode($rows);
    $fetchStmt->close();
}

if(isset($_GET['purViewRecord']))
{
    $fetchStmt=$conn->prepare("SELECT * FROM `purchase`");
    $fetchStmt->execute();
    $result=$fetchStmt->get_result();

    $rows=array();
    while($row=$result->fetch_assoc())
    {
        $rows[] =$row;
    }
    echo json_encode($rows);
    $fetchStmt->close();
}


if(isset($_GET['purViewRecordItem']))
{
    $pur_id=$_GET['pur_id'];
    $fetchStmt=$conn->prepare("SELECT * FROM `purchase_data` WHERE `pur_id`= ?");
    $fetchStmt->bind_param("i",$pur_id);
    $fetchStmt->execute();
    $result=$fetchStmt->get_result();

    $rows=array();
    while($row=$result->fetch_assoc())
    {
        $rows[] =$row;
    }
    echo json_encode($rows);
    $fetchStmt->close();
}

if(isset($_GET['stock']))
{
    $fetchStmt = $conn->prepare("SELECT *, SUM(qty) AS total_qty FROM `stock` GROUP BY item_code");
    $fetchStmt->execute();

    $result = $fetchStmt->get_result();

    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    echo json_encode($rows);

    $fetchStmt->close();

}



// Purchase Master
if(isset($_POST['sellMaster']))
{
    $item_code=$_POST['sellMaster'];
    $sellStmt=$conn->prepare("SELECT * FROM `stock` WHERE `item_code`= ?");
    $sellStmt->bind_param("s",$item_code);
    $sellStmt->execute();
    $result= $sellStmt->get_result();

    $stock = array();
    while($row = $result->fetch_assoc())
    {
        $stock[] = $row;
    }
    
    $sellStmt->close();

    echo json_encode($stock);
}

if(isset($_POST['InvoiceCate']))
{
    $category=$conn->prepare("SELECT DISTINCT `category` FROM `stock`");
    $category->execute();
    $resultCat=$category->get_result();
    $cate = array();
    while($row1=$resultCat->fetch_assoc())
    {
        $cate[] = $row1;
    }
    $category->close();
    echo json_encode($cate);
}




if(isset($_POST['id']))
{
    $select_Id=$_POST['id'];

    if($select_Id=='category')
    {
        $category=$_POST['category'];

        $fetchStmt=$conn->prepare("SELECT DISTINCT `brand` AS `name` FROM `stock` WHERE `category` = ?");
        $fetchStmt->bind_param("s",$category);

    }else if($select_Id=='brand')
    {
        $category=$_POST['category'];
        $brand=$_POST['brand'];

        $fetchStmt=$conn->prepare("SELECT DISTINCT `product` AS `name` FROM `stock` WHERE `category` = ? AND `brand` = ?");
        $fetchStmt->bind_param("ss",$category,$brand);
    }
    else if($select_Id=='product')
    {
        $category=$_POST['category'];
        $brand=$_POST['brand'];
        $product=$_POST['product'];

        $fetchStmt=$conn->prepare("SELECT DISTINCT `flavor` AS `name` FROM `stock` WHERE `category` = ? AND `brand` = ? AND `product` = ?");
        $fetchStmt->bind_param("sss",$category,$brand,$product);
    }
    else if($select_Id=='flavor')
    {
        $category=$_POST['category'];
        $brand=$_POST['brand'];
        $product=$_POST['product'];
        $flavor=$_POST['flavor'];
        $fetchStmt=$conn->prepare("SELECT DISTINCT `unit` AS `name` FROM `stock` WHERE `category` = ? AND `brand` = ? AND `product` = ? AND `flavor` = ?");
        $fetchStmt->bind_param("ssss",$category,$brand,$product,$flavor);
    }else if($select_Id=='unit')
    {
        $category=$_POST['category'];
        $brand=$_POST['brand'];
        $product=$_POST['product'];
        $flavor=$_POST['flavor'];
        $unit=$_POST['unit'];
        $fetchStmt=$conn->prepare("SELECT DISTINCT `item_code` AS `name` FROM `stock` WHERE `category` = ? AND `brand` = ? AND `product` = ? AND `flavor` = ? AND `unit` = ?");
        $fetchStmt->bind_param("sssss",$category,$brand,$product,$flavor,$unit);
    }

    
    $fetchStmt->execute();
    $resultCat=$fetchStmt->get_result();
    $data = array();
    while($row1=$resultCat->fetch_assoc())
    {
        $data[] = $row1;
    }
    $fetchStmt->close();
    echo json_encode($data);
}


//invoices
if(isset($_GET['invoiceRecord']))
{
    $fetchStmt=$conn->prepare("SELECT * FROM `invoice`");
    $fetchStmt->execute();
    $result=$fetchStmt->get_result();

    $rows=array();
    while($row=$result->fetch_assoc())
    {
        $rows[] =$row;
    }
    echo json_encode($rows);
    $fetchStmt->close();
}



if(isset($_GET['invoiceRecordItem']))
{
    $inv_id=$_GET['inv_id'];
    $fetchStmt=$conn->prepare("SELECT * FROM `invoice_data` WHERE `inv_no`= ?");
    $fetchStmt->bind_param("i",$inv_id);
    $fetchStmt->execute();
    $result=$fetchStmt->get_result();

    $rows=array();
    while($row=$result->fetch_assoc())
    {
        $rows[] =$row;
    }
    echo json_encode($rows);
    $fetchStmt->close();
}


if(isset($_GET['profit']))
{
    $fetchStmt=$conn->prepare("SELECT `profit`.*,`invoice_data`.`item_code`,`invoice_data`.`product` FROM `profit`,`invoice_data` WHERE `profit`.`ivoicedata_id`=`invoice_data`.`id`");
    $fetchStmt->execute();
    $result=$fetchStmt->get_result();

    $rows=array();
    while($row=$result->fetch_assoc())
    {
        $rows[] =$row;
    }
    echo json_encode($rows);
    $fetchStmt->close();
}

$conn->close();
?>