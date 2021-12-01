<?php
if (!empty($_POST['dropdown']) && $_POST['dropdown'] == 'snake') {


    $sql = "SELECT * FROM animal where species = 'snake' and  user = '$username' LIMIT $start_from,".$limit;

 $all_data=mysqli_query($con,$sql);
 $user_count = mysqli_fetch_row($all_data);   // say total count 9  
 $total_records = $user_count[0];   //9
 $total_pages = ceil($total_records / $limit);    // 9/3=  3


}



else if(!empty($_POST['dropdown']) && $_POST['dropdown'] == 'lizard') {

   $sql = "SELECT * FROM animal where species = 'lizard' and  user = '$username' LIMIT $start_from,".$limit;

 $all_data=mysqli_query($con,$sql);     //added 
 $user_count = mysqli_fetch_row($all_data);   // say total count 9  
 $total_records = $user_count[0];   //9
 $total_pages = ceil($total_records / $limit);    // 9/3=  3

}


else { //added 

$sql = "SELECT * FROM animal  where user = '$username' LIMIT $start_from,".$limit;  

 $all_data=mysqli_query($con,"select count(*) from animal where user = '$username'");
 $user_count = mysqli_fetch_row($all_data);   // say total count 9  
 $total_records = $user_count[0];   //9
 $total_pages = ceil($total_records / $limit);    // 9/3=  3

}



$num = 0;


// if($result = mysqli_query($con, $query)){
if($result = mysqli_query($con, $sql)){
 if(mysqli_num_rows($result) > 0){

    echo "<table>";


     while($row = mysqli_fetch_array($result)){
         if ($num++ % 4== 0 && $num > 1) echo '</tr><tr>';  

              echo "<td>" . $row['animal'] . "</td>";


      // }
         // echo "</tr>";

     }
      // echo "</table>";
}

}


 $current_page = isset($_GET['page'])?$_GET['page'] : 1;  


 for ($page = $start_page; $page <= $end_page; $page++){
         if ($total_pages > 0) {   

         if ($page == $current_page) {

             $active_class = "active";

              echo"<button class='btn' class='active' a href='room.php?page=".($page)."'>$page</a></button>";


              echo "&nbsp;&nbsp;";
         } 



         // else {
             // else if ($num == $limit){
             else if ($num == $limit){

             echo '<a href="?page='.$page.'" class="btn">'.$page.'</a>';   

             echo "&nbsp;&nbsp;";



     }

  }
 }


    echo "<form id='form_id' method='post' name='myform'>";
     echo "<select name='dropdown'>";

     // echo "<option value='All'>All</option>";

 if($result = mysqli_query($con, $sql)){
     if(mysqli_num_rows($result) > 0){
         while($row = mysqli_fetch_array($result)){
               echo "<option name='all'>" . $row['species'] . "</option>";
         }
     }
      echo "</select>";
      echo "<input id='submit' name='submit' type='submit' value='submit'>";

   echo "</form>";
    }
