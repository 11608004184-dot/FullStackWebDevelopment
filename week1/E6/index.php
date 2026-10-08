
<?php
$profile = [
    "name" => "Pema Dorji",
    "age" => 24,
    "dzongkhag" => "Thimphu",
    "cid" => "12345678901",
    "status" => "Active"
];

function validateProfile($profile) {
    $errors = [];

    if (!isset($profile["name"]) ||
        strlen(trim($profile["name"])) < 3) {
        $errors[] = "Name must contain at least 3 characters.";
    }

    if (!isset($profile["age"]) ||
        !is_numeric($profile["age"]) ||
        $profile["age"] < 0 ||
        $profile["age"] > 120) {
        $errors[] = "Age must be between 0 and 120.";
    }

    if (!isset($profile["dzongkhag"]) ||
        trim($profile["dzongkhag"]) === "") {
        $errors[] = "Dzongkhag is required.";
    }

    if (!isset($profile["cid"]) ||
        strlen($profile["cid"]) != 11) {
        $errors[] = "CID must contain exactly 11 characters.";
    }

    if (!isset($profile["status"]) ||
        !in_array($profile["status"], ["Active", "Inactive"], true)) {
        $errors[] = "Status must be Active or Inactive.";
    }

    return [
        "isValid" => count($errors) === 0,
        "errors" => $errors
    ];
}

$result = validateProfile($profile);

echo "<h1>Profile Validation</h1>";

if ($result["isValid"]) {
    echo "<p style='color:green'>Profile is valid.</p>";
} else {
    echo "<p style='color:red'>Profile is invalid.</p>";
    echo "<ul>";

    foreach ($result["errors"] as $error) {
        echo "<li>$error</li>";
    }

    echo "</ul>";
}
?>