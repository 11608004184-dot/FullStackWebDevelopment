
<?php
$profiles = [
    ["name"=>"Pema Dorji", "dzongkhag"=>"Thimphu", "age"=>24, "status"=>"Active", "cid"=>"12345678901"],
    ["name"=>"Sonam Wangmo", "dzongkhag"=>"Paro", "age"=>65, "status"=>"Inactive", "cid"=>"12345678902"],
    ["name"=>"Karma Dorji", "dzongkhag"=>"Thimphu", "age"=>35, "status"=>"Active", "cid"=>"12345678903"],
    ["name"=>"Tashi", "dzongkhag"=>"Punakha", "age"=>70, "status"=>"Active", "cid"=>"12345678904"],
    ["name"=>"Ugyen Tshering", "dzongkhag"=>"Paro", "age"=>45, "status"=>"Inactive", "cid"=>"12345678905"],
    ["name"=>"Jigme Dorji", "dzongkhag"=>"Thimphu", "age"=>60, "status"=>"Active", "cid"=>"12345678906"],
    ["name"=>"", "dzongkhag"=>"Bumthang", "age"=>29, "status"=>"Active", "cid"=>"123"],
    ["name"=>"Dorji Wangmo", "dzongkhag"=>"Punakha", "age"=>130, "status"=>"Unknown", "cid"=>"12345678908"]
];

$permissions = [
    "administrator" => ["create", "read", "update", "delete", "export"],
    "data officer" => ["create", "read", "update"],
    "viewer" => ["read"]
];

$selectedDzongkhag = "Thimphu";
$selectedStatus = "Active";
$role = "Data Officer";
$action = "update";

function validateProfile($profile) {
    $errors = [];

    if (trim($profile["name"]) === "") {
        $errors[] = "Missing name";
    }

    if (!is_numeric($profile["age"]) ||
        $profile["age"] < 0 || $profile["age"] > 120) {
        $errors[] = "Invalid age";
    }

    if (trim($profile["dzongkhag"]) === "") {
        $errors[] = "Missing dzongkhag";
    }

    if (!in_array($profile["status"], ["Active", "Inactive"], true)) {
        $errors[] = "Invalid status";
    }

    if (strlen($profile["cid"]) != 11) {
        $errors[] = "Invalid CID";
    }

    return $errors;
}

function canPerformAction($role, $action, $permissions) {
    $role = strtolower(trim($role));
    $action = strtolower(trim($action));

    return isset($permissions[$role]) &&
        in_array($action, $permissions[$role], true);
}

$total = count($profiles);
$active = 0;
$inactive = 0;
$totalAge = 0;
$youngest = null;
$oldest = null;
$filtered = [];
$imperfect = 0;
$totalScore = 0;
$worstScore = 100;
$worstName = "None";

foreach ($profiles as $profile) {
    if ($profile["status"] === "Active") {
        $active++;
    } elseif ($profile["status"] === "Inactive") {
        $inactive++;
    }

    if (is_numeric($profile["age"]) &&
        $profile["age"] >= 0 && $profile["age"] <= 120) {
        $totalAge += $profile["age"];

        if ($youngest === null || $profile["age"] < $youngest["age"]) {
            $youngest = $profile;
        }

        if ($oldest === null || $profile["age"] > $oldest["age"]) {
            $oldest = $profile;
        }
    }

    if (($selectedDzongkhag === "All" ||
         $profile["dzongkhag"] === $selectedDzongkhag) &&
        ($selectedStatus === "All" ||
         $profile["status"] === $selectedStatus)) {
        $filtered[] = $profile;
    }

    $errors = validateProfile($profile);
    $score = max(0, 100 - (count($errors) * 25));

    $totalScore += $score;

    if ($score < 100) {
        $imperfect++;
    }

    if ($score < $worstScore) {
        $worstScore = $score;
        $worstName = $profile["name"] ?: "Unnamed profile";
    }
}

$averageAge = $total > 0 ? $totalAge / $total : 0;
$averageScore = $total > 0 ? $totalScore / $total : 0;

echo "<h1>B-PIS Command Dashboard</h1>";

echo "<h2>Summary</h2>";
echo "<p>Total profiles: $total</p>";
echo "<p>Active: $active</p>";
echo "<p>Inactive: $inactive</p>";
echo "<p>Average age of all valid ages: " .
    number_format($averageAge, 2) . "</p>";

if ($youngest !== null) {
    echo "<p>Youngest: " . htmlspecialchars($youngest["name"]) .
        " (" . $youngest["age"] . ")</p>";
}
if ($oldest !== null) {
    echo "<p>Oldest: " . htmlspecialchars($oldest["name"]) .
        " (" . $oldest["age"] . ")</p>";
}

echo "<h2>Filtered Profiles</h2>";
echo "<p>Dzongkhag: $selectedDzongkhag | Status: $selectedStatus</p>";

echo "<table border='1' cellpadding='6'>";
echo "<tr><th>Name</th><th>Dzongkhag</th><th>Age</th><th>Status</th></tr>";

foreach ($filtered as $profile) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($profile["name"]) . "</td>";
    echo "<td>" . htmlspecialchars($profile["dzongkhag"]) . "</td>";
    echo "<td>" . htmlspecialchars((string)$profile["age"]) . "</td>";
    echo "<td>" . htmlspecialchars($profile["status"]) . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h2>Validation and Data Quality</h2>";
echo "<table border='1' cellpadding='6'>";
echo "<tr><th>Name</th><th>Errors</th><th>Score</th></tr>";

foreach ($profiles as $profile) {
    $errors = validateProfile($profile);
    $score = max(0, 100 - count($errors) * 25);

    echo "<tr>";
    echo "<td>" . htmlspecialchars($profile["name"] ?: "Unnamed") . "</td>";
    echo "<td>" . htmlspecialchars(implode(", ", $errors) ?: "None") . "</td>";
    echo "<td>$score</td>";
    echo "</tr>";
}
echo "</table>";

echo "<p>Average data-quality score: " .
    number_format($averageScore, 2) . "</p>";
echo "<p>Imperfect profiles: $imperfect</p>";
echo "<p>Record requiring the most correction: " .
    htmlspecialchars($worstName) . "</p>";

echo "<h2>Role Permission</h2>";
echo "<p>Role: " . htmlspecialchars($role) . "</p>";
echo "<p>Action: " . htmlspecialchars($action) . "</p>";

if (canPerformAction($role, $action, $permissions)) {
    echo "<p style='color:green'>Access granted.</p>";
} else {
    echo "<p style='color:red'>Access denied.</p>";
}
?>