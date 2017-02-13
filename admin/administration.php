<?php
$myfile = fopen("data.xml", "w+") or die("Unable to open file!");
$servername = "192.168.0.12";
$username = "admin";
$password = "itsasecret";
$dbname = "cct-data";
$sd = $_POST["sd"];
$xml = "<?xml version='1.0' encoding='UTF-8'?><content>";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT ID, firstname, lastname, bday, dov, service, doc, email, phone FROM client_info";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $nxml = "<entry date = '". substr($row["dov"], 0, 10)."'>"."<id>" . $row["ID"]. "</id>"."<firstname>" . $row["firstname"]. "</firstname>"."<lastname>" . $row["lastname"]. "</lastname>"."<birthday>" . $row["bday"]. "</birthday>"."<dov>" . $row["dov"]. "</dov>"."<service>" . $row["service"]. "</service>"."<doc>" . $row["doc"]. "</doc>"."<email>" . $row["email"]. "</email>"."<phone>" . $row["phone"]. "</phone>"."</entry>";
		$xml = $xml.$nxml;
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
$xml = $xml."</content>";
fwrite($myfile,$xml);
echo fread($myfile,filesize("data.xml"));
fclose($myfile);
$fxml=simplexml_load_file("data.xml") or die("Error: Cannot create object");
foreach($fxml->xpath('/content/entry[@date="'.$sd.'"]') as $entry) {
    echo $entry->dov . ", ";
    echo $entry->firstname . " "; 
    echo $entry->lastname . ", ";
    echo $entry->email . ", "; 
    echo $entry->phone . ", ";
    echo $entry->birthday . ", "; 
    echo $entry->doc . "<br>"; 
    echo $entry->id . ", "; 
} 
?>