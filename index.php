<?php
function create($conn, $pro_id, $name, $sku, $description, $brand, $price, $cat_name, $cat_desc, $image, $weight, $dimentions)
{

    // echo "$pro_id <br>";   //101
    // echo "$name <br>";     //"Shoes"
    // echo "$sku <br>";      //"ab3456mdo"
    // echo "$description <br>";    //"It is black"
    // echo "$brand <br>";       // "Sky"
    // echo "$price <br>";     //1200.0
    // echo "$image <br>";    //"sky.jpg"
    // echo "$weight <br>";    //20.0
    // echo "$dimentions <br>";  //"30x20"


    $sql1 = "SELECT CAT_ID FROM CATEGORY WHERE CATEGORY_AME = '$cat_name';";

    $result1 = mysqli_query($conn, $sql1);
    $no_of_rows = mysqli_num_rows($result1);
    echo "<h3>Number of Matching rows, having $cat_name is: $no_of_rows </h3>";

    if ($no_of_rows === 0){
        echo "<h1>Category does not exist</h1>";
        $sql_insert = "INSERT INTO CATEGORY(CATEGORY_AME, CATEGORY_DESC) VALUES ('$cat_name', '$cat_desc');";

        $result2 = mysqli_query($conn, $sql_insert);
        if ($result2){
            echo "<h1>Insertion Successful in category table!</h1>";
        } 

        $sql1 = "SELECT CAT_ID FROM CATEGORY WHERE CATEGORY_AME = '$cat_name';";
        $result1 = mysqli_query($conn, $sql1);
    }
    $row = mysqli_fetch_assoc($result1);
        // print_r($row);  #Array ( [CAT_ID] => 1 )
        $cat_id = $row['CAT_ID'];
        echo  "<h3>For $cat_name category id is: $cat_id</h3>";

    $sql = "INSERT INTO PRODUCTS (PRO_ID, NAME, SKU, DESCRIPTION, BRAND, PRICE, CAT_ID, IMAGE, WEIGHT, DIMENSIONS)
    VALUES
    ('$pro_id' , '$name' , '$sku' , '$description' , '$brand' ,'$price' , '$cat_id', '$image' , '$weight' , '$dimentions');";

    
    $result = mysqli_query($conn, $sql);

    if ($result){
        return true;
    }
    else{
        return false;
    }

}

?>