<?php
include('../connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
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
?>