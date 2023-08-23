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
        $checkStmt = $this->conn->prepare("SELECT COUNT(*) FROM item WHERE category = ? AND brand = ? AND product = ? AND flavor = ? AND unit = ? AND item_code = ?");
        $checkStmt->bind_param("ssssss", $category, $brand, $product, $flavor, $unit, $item_code);
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
                $insertStmt = $this->conn->prepare("INSERT INTO item (category, brand, flavor, product, unit, item_code) VALUES (?, ?, ?, ?, ?, ?)");
                $insertStmt->bind_param("ssssss", $category, $brand, $flavor, $product, $unit, $item_code);

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
        $checkStmt = $this->conn->prepare("SELECT COUNT(*) FROM item WHERE category = ? AND brand = ? AND product = ? AND flavor = ? AND unit = ? AND item_code = ? AND id != ?");
        $checkStmt->bind_param("ssssssi", $category, $brand, $product, $flavor, $unit, $item_code,$slno);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $rowCount = $checkResult->fetch_row()[0];
        if ($rowCount > 0) 
        {
            echo json_encode(['message' => 'Data already exists']);
        }else
        {
            try{
                    $updateStmt=$this->conn->prepare("UPDATE item SET category = ? , brand = ?, flavor = ?, product = ?, unit = ?, item_code = ? WHERE id= ?");
                    $updateStmt->bind_param("ssssssi", $category, $brand, $flavor, $product, $unit, $item_code,$slno);
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
?>