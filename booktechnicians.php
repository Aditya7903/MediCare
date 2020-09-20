<?php 
include_once 'includes/dbh.inc.php';
include_once 'customerheader.php';
?>
<style>


.responstable {
  margin: 1em 0;
  width: 100%;
  overflow: hidden;
  background: #fff;
  color: #024457;
  border-radius: 10px;
  border: 1px solid #167f92;
}
.responstable tr {
  border: 1px solid #d9e4e6;
}
.responstable tr:nth-child(odd) {
  background-color: #eaf3f3;
}
.responstable th {
  display: none;
  border: 1px solid #fff;
  background-color: #167f92;
  color: #fff;
  padding: 1em;
}
.responstable th:first-child {
  display: table-cell;
  text-align: center;
}
.responstable th:nth-child(2) {
  display: table-cell;
}
.responstable th:nth-child(2) span {
  display: none;
}
.responstable th:nth-child(2):after {
  content: attr(data-th);
}
@media (min-width: 480px) {
  .responstable th:nth-child(2) span {
    display: block;
  }
  .responstable th:nth-child(2):after {
    display: none;
  }
}
.responstable td {
  display: block;
  word-wrap: break-word;
  max-width: 7em;
}
.responstable td:first-child {
  display: table-cell;
  text-align: center;
  border-right: 1px solid #d9e4e6;
}
@media (min-width: 480px) {
  .responstable td {
    border: 1px solid #d9e4e6;
  }
}
.responstable th,
.responstable td {
  text-align: left;
  margin: 0.5em 1em;
}
@media (min-width: 480px) {
  .responstable th,
  .responstable td {
    display: table-cell;
    padding: 1em;
  }
}
h1 {
  font-family: Verdana;
  font-weight: normal;
  color: #024457;
}
h1 span {
  color: #167f92;
}
</style>
<center>
    <h2><u>Book Technicians</u></h2>
</center>
        <?php
        
        $sql="SELECT * FROM technician WHERE pincode= '".$_SESSION['pin']."'";
        $result=mysqli_query($conn,$sql);
        $resultcheck=mysqli_num_rows($result);
        if($resultcheck<1)
        {?>
            <center><h2 class ="text-center" style ="color:red">No Technicians Available at your pin code</h2></center>
        <?php }
        else{
          ?>
           <table class ="responstable">
        <tr style="color:black">
                  
            <th>Name</th>
             <th>E-Mail</th>            
              <th>Pincode</th>            
               <th>Contact</th>
               <th>Timing</th>
                <th>Book</th>
        </tr><?php
            while($row=mysqli_fetch_assoc($result)){
              
                $query="SELECT * FROM bookings WHERE cname='".$_SESSION['user']."'&& tname='".$row['username']."'";
                $res=mysqli_query($conn,$query);
                $rescheck=mysqli_num_rows($res);
                if($rescheck<=0)
                {?>
                <tr>
                <td><?php echo $row['fullname']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['pincode']?></td>
                <td><?php echo $row['cnumber']?></td>
                <td><?php echo $row['timings']?></td>
                <td><form action ="book.php" method="post">
                <?php if($row['flag']==0){?>
                <center>
                <button type ="submit" name ="submit" value ="<?php echo $row['username']?>" class ="btn btn-primary">
                Book</button>
                </center>
                <?php } else{?>
                  <center>
                <button type ="submit" name ="submit" value ="<?php echo $row['username']?>" class ="btn btn-primary" disabled>
                Unavailable</button>
                <?php }?>
                </form></td>
                </tr>
               <?php }
               else{?>
                <tr>
                <td><?php echo $row['fullname']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['pincode']?></td>
                <td><?php echo $row['cnumber']?></td>
                <td><?php echo $row['timings']?></td>
                <td class ="text-center">
                <button class ="btn btn-danger" disabled>Booked</td>
                </tr>
              <?php }
           }
        }
        ?>
    </table>
</body>
</html>