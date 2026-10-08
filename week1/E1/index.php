
<?php
$profile = [
    "name" => "Pema Dorji",
    "cid" => "12345678901",
    "dob" => "2002-05-15",
    "dzongkhag" => "Thimphu",
    "gewog" => "Chang",
    "occupation" => "Student",
    "status" => true
];

echo "<h1>Citizen Profile</h1>";

echo "Full Name: " . strtoupper($profile["name"]) . "<br>";
echo "CID: " . $profile["cid"] . "<br>";
echo "Date of Birth: " . $profile["dob"] . "<br>";
echo "Dzongkhag: " . $profile["dzongkhag"] . "<br>";
echo "Gewog: " . $profile["gewog"] . "<br>";
echo "Occupation: " . $profile["occupation"] . "<br>";

if ($profile["status"] == true) {
    echo "Status: Active<br>";
} else {
    echo "Status: Inactive<br>";
}

$cidLength = strlen($profile["cid"]);

echo "CID Length: " . $cidLength . "<br>";

if ($cidLength != 11) {
    echo "<p style='color:red'>Warning: CID must contain exactly 11 characters.</p>";
} else {
    echo "<p style='color:green'>CID is valid.</p>";
}
?>