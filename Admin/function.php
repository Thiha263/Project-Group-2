<?php 
function addCategory()
{
    global $connection;
    $catname=$_POST['catname'];

    if($catname=="")
    {
        echo "<script>window.alert('Please Enter Category Name')</script>";
    }
    elseif($catname!="")
    {
        $query="Select * from category where catname='$catname'";
        $ch_query=mysqli_query($connection,$query);
        $count=mysqli_num_rows($ch_query);
        if($count>0)
        {
            echo "<script>window.alert('This record is already exists')</script>";
        }
        else
        {
            $query="insert into category(catname)values('$catname')";
            $go_query=mysqli_query($connection,$query);
            if(!$go_query)
            {
                die("QUERY FAILED".mysqli_error($connection));
            }
            else
            {
                echo "<script>window.alert('Successfully inserted')</script>";
            }
        }
    }
}
function delcategory()
{
    global $connection;
    $catid=$_GET['cid'];
    $query="Delete from category where catid='$catid'";
    $go_query=mysqli_query($connection,$query);
    header("location:category.php");
}
function update_category()
{
    global $connection;
    $catname=$_POST['updatecatname'];
    $catid=$_GET['cid'];
    $query="update category set catname='$catname' where catid='$catid'";
    $go_query=mysqli_query($connection,$query);
    if(!$go_query)
    {
        die("QUERY FAILED".mysqli_error($connection));
    }
    header("location:category.php");
}
function adduser()
{
    global $connection;
    $username=$_POST['username'];
    $password=$_POST['password'];
    $confirmpassword=$_POST['cpassword'];

    if($password!=$confirmpassword)
    {
        echo"<script>window.alert('Password and Confirm Password are must be same')</script>";
    }
    elseif($password!="" && $username!="")
    {
        $query="Select * from usertable where username='$username' and password='$password'";
        $ch_query=mysqli_query($connection,$query);
        $count=mysqli_num_rows($ch_query);
        if($count>0)
        {
            echo "<script>window.alert('Already exists')</script>";
        }
        else
        {
            $hashvalue=md5($password);
            $user_role=$_POST['usertype'];
            $query="insert into usertable(username,password,role)";
            $query.="values('$username','$hashvalue', '$user_role')";
            $go_query=mysqli_query($connection,$query);
            if(!$go_query)
            {
                die("QUERY FAILED".mysqli_error($connection));
            }
            header("location:userlist.php");
        }
    }
}
function deluser()
    {
        global $connection;
        $userid=$_GET['uid'];
        $query="delete from usertable where userid='$userid'";
        $go_query=mysqli_query($connection,$query);
        header("location:userlist.php");
    }

    function addproduct()
    {
        global $connection;
        $productname=$_POST['productname'];
        $catid=$_POST['catname'];
        $price=$_POST['price'];
        $qty=$_POST['qty'];
        $photo=$_FILES['photo']['name'];

        if(is_numeric($price)==false)
        {
            echo "<script>window.alert('Enter Product Price is numeric value')</script>";
        }
        elseif(is_numeric($qty)==false)
        {
            echo "<script>window.alert('Enter Product Price is numeric value')</script>";
        }
        elseif($productname!="" && $photo!="")
        {
            $query="Select * from product where productname='$productname'";
            $ch_query=mysqli_query($ch_query);
            $count=mysqli_num_rows($ch_query);
            if($count>0)
            {
                echo"<script>window.alert('This product is already exists')</script>";
            }
            else
            {
                $query="insert into product(productname,catid,price,qty,photo)";
                $query.="values('$productname','$catid','$price','$qty','$photo')";
                $go_query=mysqli_query($connection,$query);
                if(!$go_query)
                {
                    die("QUERY FAILED".mysqli_error($connection));
                }
                else
                {
                    move_uploaded_file($_FILES['photo']['tmp_name'],'../Photo/'.$photo);
                    header("location:productlist.php");
                }
            }
        }
    }
    function delproduct()
    {
        global $connection;
        $pid=$_GET['pid'];
        $query="delete from product where productid='$pid'";
        $go_query=mysqli_query($connection,$query);
        header("location:productlist.php");
    }
    function adminlogin()
    {
        global $connection;
        $username=$_POST['username'];
        $password=$_POST['password'];
        $hashpw=md5($password);

        $query="Select * from usertable";
        $go_query=mysqli_query($connection,$query);
        while($out=mysqli_fetch_array($go_query))
        {
            $db_user_name=$out['username'];
            $db_password=$out['password'];
            $db_user_role=$out['role'];

            if($db_user_name==$username && $db_password==$hashpw && $db_user_role=='admin')
            {
                $_SESSION['admin']=$username;
                header('location:dashboard.php');
            }
            else
            {
                echo "<script>window.alert('Invalid Admin Name and Password')</script>";
                echo "<script>window.location.href='index.php'</script>";
            }
        }
    }
function updateproduct()
{
    global $connection;
    $productid=$_GET['pid'];
    $productname=$_POST['productname'];
    $catid=$_POST['catname'];
    $price=$_POST['price'];     
    $qty=$_POST['qty'];
    $photo=$_FILES['photo']['name'];

    if(!$photo)
    {
        $query="update product set productname='$productname',catid='$catid',price='$price',qty='$qty' where productid='$productid'";
    }
    else
    {
         $query="update product set productname='$productname',catid='$catid',price='$price',qty='$qty',photo='$photo' where productid='$productid'";
    }
    $go_query=mysqli_query($connection,$query);
    if(!go_query)
    {
        die("QUERY FAILED".mysqli_error($connection));
    }
    else
    {
        move_uploaded_file($_FILES['photo']['tmp_name'],'../Photo/'.$photo);

    }
    header("location:productlist.php");
}
?>