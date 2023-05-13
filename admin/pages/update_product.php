<?php require_once('../../conn.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <?php include('header.php')?>
<?php

$id = $_GET["idbhaago"];
$goo = mysqli_query($conn,"SELECT * FROM `table_product` where product_id = $id");
$array = mysqli_fetch_array($goo); 

?>

<center>

    
<form action="" method="post" enctype="multipart/form-data">
 <p>PRODUCT NAME</p>
<input type="text" name="pname" value="<?php echo $array[1];?>">
<p>PRODUCT PRICE</p>
<input type="number" name="ppr" value="<?php echo $array[2];?>">
<p>PRODUCT QUANTITY</p>
<input type="number" name="pquan" value="<?php echo $array[3];?>">
<p>PRODUCT CATOGARY</p>
<select name="cat" value="<?php echo $array[4];?>" <?php if($array[4]==true){echo "checked";}?>>
    <option value="">SELECT CATOGARY</option>
    <?php
    $fetch_cat = "SELECT * FROM `tbl_catogary`";
    $gocat = mysqli_query($conn,$fetch_cat);
      if(mysqli_num_rows($gocat)==0){
        echo "<option value=''>NO CATOGERY AVALAIBLE</option>";
      }
      else{
       while($i = mysqli_fetch_array($gocat)){
         echo "<option value='$i[0]'>$i[1]</option>";
       }
      }

       ?>



</select>

<p>PRODUCT IMAGE</p>
<input type="file" name="meriimage" value="<?php echo $array[5];?>" required accept="image/*"
onchange="document.getElementById('myimg').src=window.URL.createObjectURL(this.files[0])">
<img src="<?php echo $array[5];?>"  width = 130 height = 120 id="myimg">
<br><br>

 <button type="submit" class="btn btn-primary" name="upt">UPDATE PRODUCT</button>

</form>
</center>

<?php
if(isset($_POST["upt"])){
    $product_name = $_POST["pname"];
    $product_price = $_POST["ppr"];
    $product_quantity = $_POST["pquan"];
    $product_catogary = $_POST["cat"];

    if(isset($_SESSION["meriimage"]["name"])){

      
    $img_name= $_FILES["meriimage"]["name"];
    $img_size = $_FILES["meriimage"]["size"];
    $_tmp_loc = $_FILES["meriimage"]["tmp_name"];

    $img_location = "../../productimages/" . $img_name;
     if ($img_size <= 1000000) {
         
    $update_product = "UPDATE `table_product` SET `product_name`='$product_name',
    `product_price`=' $product_price',
    `product_quantity`='$product_quantity',
    `product_catogary`='$product_catogary',
    `product_image`='$img_location'
     WHERE product_id = $id";

      $run_up = mysqli_query($conn,$update_product);

      if($run_up==true){
        echo "<script>
        alert(' PRODUCT  UPDATED')
        window.location.href='showproduct.php'
        </script>";
      }
      else{
        echo "<script>
      alert('".mysqli_error($conn)."')
      window.location.href ='showproduct.php'
      </script>";

      }



      # code...
     } else {
      echo "<script>
      alert('invalid image')
      window.location.href='showproduct.php'
      
      
      </script>";
     }
    }
    else{
        
    $update_product = "UPDATE `table_product ` SET `product_name`='$product_name',
    `product_price`=' $product_price',
    `product_quantity`='$product_quantity',
    `product_catogary`='$product_catogary',
    `product_image`='$array[5]'
     WHERE product_id = $id";

      $run_up = mysqli_query($conn,$update_product);

      if($run_up==true){
        echo "<script>
        alert(' PRODUCT  UPDATED')
        window.location.href='showproduct.php'
        </script>";
      }
      else{
        echo "<script>
      alert('".mysqli_error($conn)."')
      window.location.href ='showproduct.php'
      </script>";
      }
    }
    $img_location = "../../productimages/" .$img_name;
}
?>
<?php
include('footer.php');
  ?>  
</body>
</html>