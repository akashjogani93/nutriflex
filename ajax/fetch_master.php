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

if(isset($_GET['purchase1']))
{
    $name=$_GET['purchase1'];
    $inputElement=$_GET["inputElement"];
    if($inputElement=='category')
    {
        $coloum='category';
        $fetchName='brand';
    }else if($inputElement=='brand')
    {
        $coloum='brand';
        $fetchName='product';
    }else if($inputElement=='product')
    {
        $coloum='product';
        $fetchName='flavor';
    }
    else if($inputElement=='flavor')
    {
        $coloum='flavor';
        $fetchName='unit';
    }else if($inputElement=='unit')
    {
        $coloum='unit';
        $fetchName='item_code';
    }else if($inputElement=='item_code')
    {
        $coloum='item_code';
        $fetchName='category,brand,product,flavor,unit';
    }

    $fetchStmt=$conn->prepare("SELECT DISTINCT $fetchName FROM `item` WHERE $coloum = ?");
    $fetchStmt->bind_param("s", $name); 
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
$conn->close();
?>