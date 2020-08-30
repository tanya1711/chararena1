<style>
#myTable {
  border-collapse: collapse;
  width: 90%;
height: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
   position: absolute;
  left: 50px;
  
}



#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}


tr:nth-child(even) {background-color: grey; color: purple;}

tr:nth-child(odd) {color: white;}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 50%;

  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
   position: absolute;
  left: 50px;
}

.topcorner{
   position:absolute;
   top:10px;
    right: 500px;
	width: 70%;
height: 100%;

  }

.rightcorner{
   position:absolute;
   top:100px;
    left: 800px;
	width: 50%;
height: 60%;
 background-image: url("chatbox.png");
  }

.scroll
{

  width: 60%;
height: 100%;

position: absolute;
overflow: scroll;
}


</style>




<?php

//fetch_user.php

include('database_connection.php');

session_start();

$query = "
SELECT * FROM login 
WHERE user_id != '".$_SESSION['user_id']."' 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();


$output = '
<div class="topcorner"><br><br>
<h2><font color="white" family="comicSansMs" align="center" vertical-align= "top"> My Chats <span class="glyphicon glyphicon-comment"></span></h2>
<br><

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" >
<br><br>
<div class="scroll">
<table id="myTable" align="left">
<h1>

';

foreach($result as $row)
{
 $status = '';
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 $user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
 if($user_last_activity > $current_timestamp)
 {
  $status = '<font color="green"><span class="glyphicon glyphicon-record"></span></font';
 }
 else
 {
  $status = '<font color="red"><span class="glyphicon glyphicon-record"></span></font>';
 }
 $output .= '
 <tr><font face="Courier New" size="100">
  <td>'.$row['username'].' '.count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).' '.fetch_is_type_status($row['user_id'], $connect).'</td>
  <td>'.$status.'</td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">Send Message <span class="glyphicon glyphicon-send"></span></button></td>
 </font></tr></h1></div>
 ';
}

$output .= '</table></div><div class="rightcorner"></div>';

echo $output;

?>

<script>
function myFunction() {
	
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>