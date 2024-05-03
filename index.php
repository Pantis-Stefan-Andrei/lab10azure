<!DOCTYPE html>
<html>
<body>


<form action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

<?php

echo '<p>Hello World</p>'; 

$connectionInfo = array("UID" => "user", "pwd" => "Student1", "Database" => "lab10-data", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:lab10-std.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
  die(print_r(sqlsrv_errors(), true));
}

$sql = "SELECT fileinfo.blob_store_addr, fileinfo.filename, fileinfo.file_text FROM fileinfo";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
  die(print_r(sqlsrv_errors(), true));
}



while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
 $this_link='<a href="' . $row['blob_store_addr'] .'" target = "_blank">' .$row['filename'] .
        '</a>';
  echo $this_link;
  echo $row['file_text'] . "<br />";
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>


</body>
</html>
