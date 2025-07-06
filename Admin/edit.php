<?php
session_start();
include 'conn.php';
include 'function.php';
if(isset($_GET['action'])&& $_GET['action']=='edit')
{
    $pid=$_GET['pid'];
    $query="Select * from product where productid='$pid'";
    $goquery=mysqli_query($connection,$query);
    while($row=mysqli_fetch_array($goquery))
    {
        $productid=$row['productid'];
        $productname=$row['productname'];
        $product_cat_id=$row['catid'];
        $price=$row['price'];
        $qty=$row['qty'];
        $photo=$row['photo'];
    }
}
if(isset($_POST['btnupdateproduct']))
{
    updateproduct();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'header.php' ?>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <h3>
                    Welcome 
                    <span class="text-info">
                    <?php
                        if(isset($_SESSION['admin']))
                        {
                            echo $_SESSION['admin'];
                        }
                        else
                        {
                            $_SESSION['admin']='';
                        }
                        ?>
                    </span>
                </h3>
            </div>
        </div>
        <!-- Product Entry Form Start -->
         <div class="row mt-3 justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-warning text-center text-white">
                        Update Product 
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" name="productname" id="" class="form-control" value="<?php echo $productname ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category Name</label>
                                <select name="catname" id="" class="form-control">
                                    <?php
                                    $query="Select * from category";
                                    $go_query=mysqli_query($connection,$query);
                                    while($row=mysqli_fetch_array($go_query))
                                    {
                                        $catid=$row['catid'];
                                        $catname=$row['catname'];
                                        if($product_cat_id==$catid)
                                        {
                                            echo "<option value={$catid} selected>{$catname}</option>";
                                        }
                                        else
                                        {
                                            echo "<option value={$catid}>{$catname}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="text" name="price" id="" class="form-control" value="<?php echo $price; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Quantity</label>
                                <input type="text" name="qty" id="" class="form-control" value="<?php echo $qty; ?>">
                            </div>
                            <div class="mb-3">
                                <input type="file" name="photo" id="" class="form-control">
                                <input type="hidden" name="existing-photo" class="form-control" value="<?php echo $photo ?>">
                                <img src='../Photo/<?php echo $photo ?>' width='100' height='100'>
                                <p>Current Image:<?php echo $photo; ?></p> 
                            </div>                        
                            <div class="mb-3 d-grid">
                                <input type="submit" value="Update Product" class="btn btn-outline-warning" name="btnupdateproduct">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

         </div>
         <!-- End -->
    </div>
</body>
</html>