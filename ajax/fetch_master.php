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

$conn->close();
?>