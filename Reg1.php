<?php   /* Name: Vasundhara Ghate
           File Name : Reg.PhP
           Aim : Code for performing MySQL CRUD operations using mysqli(Procedural API)
           */


<?php

$servername = "localhost:3309";  //Server info.No Need to provide port number of MySQL if using default 3306.
$username = "root"; //MySQL Server username
$password = "";// Password
$databasename = "mydatabase";  //Database name

//Object Oriented mysqi api
$conn = mysqli_connect($servername, $username, $password, $databasename);

if(!$conn)  //Check if connection is successful
{
	echo "error".mysqli_error($conn); 
}

else
{
		echo "Connected successfully";	
}



//Based on the CRUP option Button clicked by user perform the respective operation using PhP

if(isset($_POST['insert'])) //Is Insert button clicked ?
{
   $r=$_POST['rno'];  //Save the input provided by user in PhP Variables for all form elements
   if($r=="")
   {
   	echo "Cannot be empty";
   }
   if(strlen($r)>4)
   {
   	echo "only of size 4 allowed";
   }

   $n=$_POST['sname'];
   $c=$_POST['contact'];
   

   if(isset($_POST['gender']))  // If radio button option is selected save the selected option in a variable
   {
   $g=$_POST['gender'];
   }

   if(isset($_POST['City']))  //If Combobox list item is selected save the selected item in a variable
   {
   $city=$_POST['City'];
   } 

  
   $sql="insert into student(rno,Name,Contact,Gender,City) values ('$r','$n','$c','$g','$city')";  //MySQL Insert query
  
   if(mysqli_query($conn,$sql))  //Function to check if the query executed successfully 
   {
   	echo "Inserted Successfully";
   }
  }


//Update Operation 
elseif(isset($_POST['update']))
{
	$r=$_POST['rno'];
   if($r=="")
   {
   	echo "Cannot be empty";
   }
   
   $n=$_POST['sname'];
   $c=$_POST['contact'];
   

   if(isset($_POST['gender']))
   {
   $g=$_POST['gender'];
   }

   if(isset($_POST['City']))
   {
   $city=$_POST['City'];
   } 

$sql="update student set rno='$r',Name='$n',Contact='$c',Gender='$g',City='$city' where rno='$r'";

if(mysqli_query($conn,$sql))
{
	echo "Updated successfully";
}

}

//Delete Operation
elseif(isset($_POST['delete']))
{

	 $r=$_POST['rno'];
	$sql="delete from student where rno='$r'";
	if(mysqli_query($conn,$sql))
{
	echo "Deleted successfully";
}
}  


//Search based on roll no entered
elseif(isset($_POST['display']))
{
	$r=$_POST['rno'];  //saving roll no
	$sql="select rno,Name,Contact,Gender,City from student where rno='$r'";

    $res=mysqli_query($conn,$sql);//$res has the resultset stored


    if(mysqli_num_rows($res)>0)   
    {
    	while($row = mysqli_fetch_array($res)){  //fetch one row at a time
                
                // Retrieve individual field values
                $r=$row["rno"];  //extract the individual column values by column name
                $n = $row["Name"];
                $c = $row["Contact"];
                $g = $row["Gender"];

                $city=$row["City"];

                echo "Roll No entered is".$r;  //To display table column value as a text

                ?>
                <table border=1>  <!-- To Display the contents in tabular form-->
                	<tr>
                		<td><?php echo $r;?> </td>
                		<td><?php echo $n;?> </td>
                		<td><?php echo $c;?> </td>
                		<td><?php echo $g; ?> </td>
                		<td><?php echo $city;?> </td>
                	</tr>
                </table>
<?php
  }
     }
    
}
else
{
	echo 'select an option';
}


?> 

