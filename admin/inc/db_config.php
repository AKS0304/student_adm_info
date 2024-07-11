<?php 
    
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'student_admission';

    $conn = mysqli_connect($hostname,$username,$password,$db);

    if(!$conn){
    die("Cannot Connect to Database".mysqli_connect_error());
    }

    function filteration($data){
        foreach($data as $key => $value){
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
            $data[$key] = $value;
        }
        return $data;
    }

    function selectAll($table)
    {
      $conn = $GLOBALS['conn'];
      $res = mysqli_query($conn,"SELECT * FROM $table");
      return $res;
    }
    
    function select($sql,$values,$datatypes)
    {
       $conn = $GLOBALS['conn'];
       if($stmt = mysqli_prepare($conn,$sql)){
          mysqli_stmt_bind_param($stmt,$datatypes,...$values);
          if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
          }
          else{
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Select");
          }
       }
       else{
        die("Query cannot be prepared - Select");
       }
    }

    function update($sql,$values,$datatypes)
    {
       $conn = $GLOBALS['conn'];
       if($stmt = mysqli_prepare($conn,$sql)){
          mysqli_stmt_bind_param($stmt,$datatypes,...$values);
          if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
          }
          else{
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Update");
          }
       }
       else{
        die("Query cannot be prepared - Update");
       }
    }

    function insert($sql,$values,$datatypes)
    {
       $conn = $GLOBALS['conn'];
       if($stmt = mysqli_prepare($conn,$sql)){
          mysqli_stmt_bind_param($stmt,$datatypes,...$values);
          if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
          }
          else{
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Insert");
          }
       }
       else{
        die("Query cannot be prepared - Insert");
       }
    }

    // insert function
    function createStudent($data) {
      global $conn;
      $stmt = $conn->prepare("INSERT INTO student_data (full_name, date_of_birth, gender, contact_number, email, permanent_address, desired_course, desired_branch, highest_qualification, institution_name, year_of_passing, grade, photograph) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
      $stmt->bind_param("sssssssssssss", $data['full_name'], $data['date_of_birth'], $data['gender'], $data['contact_number'], $data['email'], $data['permanent_address'], $data['desired_course'], $data['desired_branch'], $data['highest_qualification'], $data['institution_name'], $data['year_of_passing'], $data['grade'], $data['photograph']);
      
      if ($stmt->execute()) {
          echo "Form submitted successfully!";
      } else {
          echo "Error: " . $conn . "<br>" . $conn->error;
      }
     
      $stmt->close();
    }

    function delete($sql,$values,$datatypes)
    {
       $conn = $GLOBALS['conn'];
       if($stmt = mysqli_prepare($conn,$sql)){
          mysqli_stmt_bind_param($stmt,$datatypes,...$values);
          if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
          }
          else{
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Delete");
          }
       }
       else{
        die("Query cannot be prepared - Delete");
       }
    }




?>