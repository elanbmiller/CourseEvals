<!-- needed to connect to db -->
<?php include "../inc/dbinfo.inc"; ?>

<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);
  
  $allRowData = getAllRows($connection);
  foreach($allRowData as $r) {
      console_log($r);
  }

?>



<?php
  mysqli_close($connection);
?>



<?php

/*
Print data to console
*/
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

/*
Returns all rows in the database
*/

function getAllRows ($connection) {
    $allRowData = array();
    $result = mysqli_query($connection, "SELECT * FROM courses"); 
    while($query_data = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $allRowData[] = $query_data;
    }
    return $allRowData;
}

?>
            

