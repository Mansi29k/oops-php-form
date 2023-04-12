<?php
include('config.php');

$obj = new Model();

if(isset($_POST['submit'])){
    $obj->insertRecord($_POST);
}

if(isset($_POST['update'])){
    $obj->updateRecord($_POST);
}

if(isset($_GET['deleteid'])){
    $delid = $_GET['deleteid'];
    $obj->deleteRecord($delid);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student registration form</title>
    
    <script> </script> 
</head>
<body>

<div class="register">
    <?php 
        if(isset($_GET['editid'])){
            $editid =$_GET['editid'];
            $myrecord = $obj->displayRecordById($editid);
        ?>
    
        <form action="index.php" method="post">
        <h2>Registration Form </h2>
            <label for="name"> Student Name:  </label>
                <input type="text" name="name" value="<?php echo $myrecord['name'];?>"><br>
            <label for="email"> Student Email:  </label>
                 <input type="text" name="email" value="<?php echo $myrecord['email'];?>"><br>
            <label for="pwd">Password:</label>
                 <input type="password" id="password" name="password" value="<?php echo $myrecord['password'];?>"><br>
            <label for="phone"> Student phone number:</label>
                 <input type="tel" id="phone" name="phone" value="<?php echo $myrecord['phone'];?>" ><br>
            <label for="name"> Student Address:  </label>
                 <input type="text" name="address" value="<?php echo $myrecord['address'];?>"><br>
    
                 <input type="hidden" name="hid" value="<?php echo $myrecord['id'];?>">
                 <input type="submit" value="update" name="update">
        </form>
    <?php
        }else{
    ?>    
    <form action="index.php" method="post" name ="reg"onsubmit="return validate()">
    <h2>Registration Form </h2>
        <label for="name"> Student Name:  </label>
            <input type="text" name="name" ><span class="formerror" id= "div1"style="color:red"> </span><br>
        <label for="email"> Student Email:  </label>
            <input type="email" name="email" ><span class="formerror" style="color:red"> </span><br>
        <label for="pwd">Password:</label>
            <input type="password" id="password" name="password" ><span class="formerror" style="color:red;"> </span><br>
        <label for="phone"> Student phone number:</label>
            <input type="phone" id="phone" name="phone" ><span class="formerror" style="color:red;"> </span><br>
        <label for="name"> Student Address:  </label>
            <input type="text" name="address"><span style="color:red;"> </span><br>
 
   
            <input type="submit" value="submit" name="submit">
    </form><br><?php } ?>
    <h4 class="table">Display</h4>
    <table class="table">
        <tr>
            <th>S.no</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>

        <?php 
        $data = $obj->displayRecord();
        $sno=1;
        foreach ($data as $value){
            ?>
            <tr class="text-center">
                <td><?php echo $sno++; ?></td>
                <td><?php echo $value['name']?>;</td>
                <td><?php echo $value['email']?>;</td>
                <td><?php echo $value['password']?>;</td>
                <td><?php echo $value['phone']?>;</td>
                <td><?php echo $value['address']?>;</td>
                <td><a href="index.php?editid=<?php echo $value['id']; ?>" class="btn btn-info">Edit</a>
                <a href="index.php?deleteid=<?php echo $value['id'];?>" class="btn btn-danger">Delete</a></td>
                
        </tr>
        <?php
        }
        ?>
    </table>
</div>
    
</body>
<script>
function validate() {
    let x = document.forms["reg"]["name"].value;
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }
  let email = document.forms["reg"]["email"].value;
  if (email == "") {
    alert("Email must be filled out");
    return false;
  }
  let password = document.forms["reg"]["password"].value;
  if (password == "") {
    alert("Password must be filled out");
    return false;
  }
  let phone = document.forms["reg"]["phone"].value;
  if (phone == "") {
    alert("Phone must be filled out");
    return false;
  }
  let address = document.forms["reg"]["address"].value;
  if (address == "") {
    alert("Address must be filled out");
    return false;
  }

}


</script>
</html>
