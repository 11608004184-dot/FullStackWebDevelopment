
<?php
$profiles = [
    ["name" => "Pema Dorji", "dzongkhag" => "Thimphu", "age" => 24, "status" => "Active"],
    ["name" => "Sonam Wangmo", "dzongkhag" => "Paro", "age" => 30, "status" => "Active"],
    ["name" => "Karma Dorji", "dzongkhag" => "Punakha", "age" => 45, "status" => "Inactive"],
    ["name" => "Tashi Wangchuk", "dzongkhag" => "Thimphu", "age" => 20, "status" => "Active"],
    ["name" => "Ugyen Tshering", "dzongkhag" => "Paro", "age" => 60, "status" => "Inactive"],
    ["name" => "Pema Choden", "dzongkhag" => "Bumthang", "age" => 35, "status" => "Active"],
    ["name" => "Jigme Dorji", "dzongkhag" => "Thimphu", "age" => 55, "status" => "Active"],
    ["name" => "Sonam Dorji", "dzongkhag" => "Wangdue", "age" => 25, "status" => "Inactive"]
];

$searchTerm = "pema";

function searchProfiles($profiles, $term) {
    $matches = [];

    foreach ($profiles as $profile) {
        if (stripos($profile["name"], $term) !== false) {
            $matches[] = $profile;
        }
    }

    return $matches;
}

echo "<h1>B-PIS Record Search</h1>";
echo "<h2>All Profiles</h2>";

echo "<table border='1' cellpadding='6'>";
echo "<tr><th>Name</th><th>Dzongkhag</th><th>Age</th><th>Status</th></tr>";

foreach ($profiles as $profile) {
    echo "<tr>";
    echo "<td>{$profile['name']}</td>";
    echo "<td>{$profile['dzongkhag']}</td>";
    echo "<td>{$profile['age']}</td>";
    echo "<td>{$profile['status']}</td>";
    echo "</tr>";
}
echo "</table>";

$results = searchProfiles($profiles, $searchTerm);

echo "<h2>Search Results for: $searchTerm</h2>";
echo "<p>Matching profiles: " . count($results) . "</p>";

if (count($results) > 0) {
    foreach ($results as $profile) {
        echo "<p>" . $profile["name"] . " - " .
            $profile["dzongkhag"] . "</p>";
    }
} else {
    echo "<p>No matching records found.</p>";
}
?>