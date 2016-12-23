<?php


    $conn;

     function openConnection($servername, $username, $password, $db){

      // Create connection
      $GLOBALS['conn'] = mysqli_connect($servername, $username, $password, $db);
      // Check connection
      if (!$GLOBALS['conn']) {
          die("Connection failed: " . mysqli_connect_error());
      }
    }


     function perform_query($query){
				//$q=mysqli_real_escape_string($this->conn, $q);
				//echo $q."<br>";
     	//echo $query;
			$result=mysqli_query($GLOBALS['conn'], $query);

				if (!$result) {
				die("There was an error With The Result \n query:".$query."\n".mysqli_error($GLOBALS['conn']));
				}

					return $result;
			}


      function fetch_result($res){

			     return mysqli_fetch_assoc($res);

		  }

       function num_rows($result){

			      return mysqli_num_rows($result);

		}
     function closeConnection(){

				mysqli_close($GLOBALS['conn']);
        $GLOBALS['conn'] = null;

		}



   function fetch_multiple_result($sql){

      $result1=mysqli_query($GLOBALS['conn'], $sql);

      $k=array_keys(fetch_result($result1));
      mysqli_free_result($result1);

        $result=mysqli_query($GLOBALS['conn'], $sql);

      $arr=array();
      $count=0;

      while($row=mysqli_fetch_assoc($result)) {


        for ($i=0; $i <sizeof($k); $i++) {

          $arr[$k[$i]][$count]=$row[$k[$i]];
        }
        $count++;
      }

      return $arr;
    }// End of fetch_multiple_result

?>
