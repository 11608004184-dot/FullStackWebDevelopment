
<?php
$members = [
    "Sonam",
    "Karma",
    "Pema",
    "Ugyen",
    "Tashi",
    "Jigme"
];

$shortest = $members[0];
$longest = $members[0];
$totalLength = 0;

echo "<h1>Household Members</h1>";
echo "<ol>";

foreach ($members as $name) {
    echo "<li>$name (" . strlen($name) . " characters)</li>";

    if (strlen($name) < strlen($shortest)) {
        $shortest = $name;
    }

    if (strlen($name) > strlen($longest)) {
        $longest = $name;
    }

    $totalLength += strlen($name);
}

echo "</ol>";

$count = count($members);
$average = $totalLength / $count;

function memberSummary($members) {
    $shortest = $members[0];
    $longest = $members[0];

    foreach ($members as $name) {
        if (strlen($name) < strlen($shortest)) {
            $shortest = $name;
        }
        if (strlen($name) > strlen($longest)) {
            $longest = $name;
        }
    }

    $totalLength = array_sum(array_map("strlen", $members));

    return [
        "count" => count($members),
        "shortest" => $shortest,
        "longest" => $longest,
        "average" => $totalLength / count($members)
    ];
}

$summary = memberSummary($members);

echo "<p>Total members: " . $summary["count"] . "</p>";
echo "<p>First member: " . $members[0] . "</p>";
echo "<p>Last member: " . $members[count($members) - 1] . "</p>";
echo "<p>Shortest name: " . $summary["shortest"] . "</p>";
echo "<p>Longest name: " . $summary["longest"] . "</p>";
echo "<p>Average name length: " . number_format($summary["average"], 2) . "</p>";
?>