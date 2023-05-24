<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Employee Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<body>
<h1>Welcome to the Main Employee Page!</h1>
<div >
    <a href="login.php">Log Out</a>
</div>
<?php if (isset($_POST["upload"])) {
    uploader();
    update_database();
    echo "<p><strong>Memo Uploaded Successfully!<br> Log out or Upload New Memo!</strong></p>";
} ?>
<form action="" method="post" enctype="multipart/form-data">
    <fieldset>
        <p>Upload Your Sales Memo Here:</p>
        <label>
            <input type="file" name="memo" id="memo" required>
        </label>
        <br><br>
        <button type="submit" name="upload">Upload File</button>
    </fieldset>
</form>
</body>
</html>
<?php



function uploader()
{
    if (!is_dir("./memos")) mkdir("./memos");

    $temp = $_FILES["memo"]["tmp_name"];
    $actual = $_FILES["memo"]["name"];
    move_uploaded_file($temp, "./memos/$actual");


}

function update_database(){
    $conn = new mysqli("localhost", "root", "", "creative_learning");
    $username = $_GET["username"];
    $query = "SELECT Id,StoreOfEmployment from Employees WHERE Username = '$username'";
    $result = $conn->query($query);
    $result = $result->fetch_assoc();
    $uploader = $result["Id"];
    $store_of_uploader = $result["StoreOfEmployment"];
    $filename = $_FILES["memo"]["name"];
    $filesize = $_FILES["memo"]["size"];
    $path_to_file = "./memos/$filename";
    $date_uploaded = filemtime($path_to_file);
    $query2 = "INSERT INTO Memos(FileName, FileSize, DateUploaded, Uploader, StoreOfUploader, PathToFile)
                VALUES ('$filename', '$filesize', FROM_UNIXTIME('$date_uploaded'), '$uploader','$store_of_uploader' ,'$path_to_file')";
    $conn->query($query2);
    $conn->close();
}


?>