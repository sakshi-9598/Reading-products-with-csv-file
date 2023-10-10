<?php

include 'index.php';

$host = "localhost";
$username = 'root';
$password = '123456';
$dbname = 'sakshidb';

$conn = mysqli_connect($host,$username,$password,$dbname);

if(!$conn){
    die("Connection failed: ". $conn->connect_error);

}
else{
    echo "Connected Sucessfully";
}

echo "<br>";
$csvFile = fopen("CAT_PRO.csv","r");


//For fetching single(first row)
// $row = fgetcsv($csvFile);
// $a = $row[0];
// echo $a;
// echo  "<br><br>";

$i =0;
while(!feof($csvFile)){
    // print_r(fgetcsv($csvFile));
    $row = fgetcsv($csvFile);
    // print_r($row);
    $string = $row[0];
    $arr = explode(";", $string);
    // print_r($arr);
// echo trim($str, '"');

    $pro_id = trim($arr[0], '"');
    $name = trim($arr[1], '"');
    $sku = trim($arr[2],'"');
    $description = trim($arr[3],'"');
    $brand = trim($arr[4], '"');
    $price = trim($arr[5], '"');
    $cat_name = trim($arr[6],'"');
    $cat_desc =  trim($arr[7],'"');
    $image = trim($arr[8],'"');
    $weight = trim($arr[9],'"');
    $dimentions = trim($arr[10],'"');

    // echo "$pro_id <br>";   //101
    // echo "$name <br>";     //"Shoes"
    // echo "$sku <br>";      //"ab3456mdo"
    // echo "$description <br>";    //"It is black"
    // echo "$brand <br>";       // "Sky"
    // echo "$price <br>";     //1200.0
    // echo "$cat_name <br>"; 
    // echo "$cat_desc <br>";
    // echo "$image <br>";    //"sky.jpg"
    // echo "$weight <br>";    //20.0
    // echo "$dimentions <br>";  //"30x20"

    if (($i > 0) && (create($conn, $pro_id, $name, $sku, $description, $brand, $price, $cat_name, $cat_desc, $image, $weight, $dimentions))){
        echo "<h1>$i st Product,  $name Created Successfully</h1>";
    }
    else{
        if ($i === 0){
            echo "<h1>First row is Header row <br>So, no need to insert header in our table</h1>";
        }
    }
    $i += 1;
    echo  "<hr>";

}
?>