
<?php
$records = [
    ["name"=>"Pema", "dzongkhag"=>"Thimphu", "age"=>24, "status"=>"Active", "type"=>"Birth"],
    ["name"=>"Sonam", "dzongkhag"=>"Paro", "age"=>65, "status"=>"Inactive", "type"=>"Marriage"],
    ["name"=>"Karma", "dzongkhag"=>"Thimphu", "age"=>35, "status"=>"Active", "type"=>"Birth"],
    ["name"=>"Tashi", "dzongkhag"=>"Punakha", "age"=>70, "status"=>"Active", "type"=>"Death"],
    ["name"=>"Ugyen", "dzongkhag"=>"Paro", "age"=>45, "status"=>"Inactive", "type"=>"Birth"],
    ["name"=>"Jigme", "dzongkhag"=>"Thimphu", "age"=>60, "status"=>"Active", "type"=>"Marriage"],
    ["name"=>"Pema", "dzongkhag"=>"Bumthang", "age"=>29, "status"=>"Inactive", "type"=>"Birth"],
    ["name"=>"Choden", "dzongkhag"=>"Paro", "age"=>62, "status"=>"Active", "type"=>"Death"],
    ["name"=>"Dorji", "dzongkhag"=>"Punakha", "age"=>40, "status"=>"Active", "type"=>"Marriage"],
    ["name"=>"Karma", "dzongkhag"=>"Thimphu", "age"=>68, "status"=>"Inactive", "type"=>"Birth"]
];

function countByField($records, $field) {
    $counts = [];

    foreach ($records as $record) {
        $value = $record[$field];

        if (!isset($counts[$value])) {
            $counts[$value] = 0;
        }

        $counts[$value]++;
    }

    return $counts;
}

function countByStatus($records) {
    return countByField($records, "status");
}

function countByDzongkhag($records) {
    return countByField($records, "dzongkhag");
}

function countByType($records) {
    return countByField($records, "type");
}

function calculatePercentage($part, $total) {
    return $total > 0 ? ($part / $total) * 100 : 0;
}

$total = count($records);
$statusCounts = countByStatus($records);
$dzongkhagCounts = countByDzongkhag($records);
$typeCounts = countByType($records);

$adults = 0;
$seniors = 0;

foreach ($records as $record) {
    if ($record["age"] >= 18 && $record["age"] <= 59) {
        $adults++;
    } elseif ($record["age"] >= 60 && $record["age"] <= 120) {
        $seniors++;
    }
}

$active = $statusCounts["Active"] ?? 0;
$inactive = $statusCounts["Inactive"] ?? 0;
$percentage = calculatePercentage($active, $total);

echo "<h1>B-PIS Records Report</h1>";

echo "<h2>Summary</h2>";
echo "<p>Total records: $total</p>";
echo "<p>Active: $active</p>";
echo "<p>Inactive: $inactive</p>";
echo "<p>Adults: $adults</p>";
echo "<p>Senior citizens: $seniors</p>";
echo "<p>Active percentage: " . number_format($percentage, 2) . "%</p>";

echo "<h2>Dzongkhag Counts</h2><ul>";
foreach ($dzongkhagCounts as $name => $count) {
    echo "<li>$name: $count</li>";
}
echo "</ul>";

echo "<h2>Record Type Counts</h2><ul>";
foreach ($typeCounts as $type => $count) {
    echo "<li>$type: $count</li>";
}
echo "</ul>";

echo "<h2>Complete Records</h2>";
echo "<table border='1' cellpadding='6'>";
echo "<tr><th>Name</th><th>Dzongkhag</th><th>Age</th><th>Status</th><th>Type</th></tr>";

foreach ($records as $record) {
    echo "<tr>";
    echo "<td>{$record['name']}</td>";
    echo "<td>{$record['dzongkhag']}</td>";
    echo "<td>{$record['age']}</td>";
    echo "<td>{$record['status']}</td>";
    echo "<td>{$record['type']}</td>";
    echo "</tr>";
}
echo "</table>";

$highestDzongkhag = max($dzongkhagCounts);
$mostCommon = [];

foreach ($dzongkhagCounts as $name => $count) {
    if ($count === $highestDzongkhag) {
        $mostCommon[] = $name;
    }
}

echo "<p>Most common dzongkhag: " .
    implode(", ", $mostCommon) . "</p>";
?>