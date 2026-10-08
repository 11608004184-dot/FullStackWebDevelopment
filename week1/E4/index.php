
<?php
$requests = [
    "Thimphu", "Paro", "Thimphu",
    "Punakha", "Paro", "Thimphu"
];

$counts = [];

echo "<h1>Dzongkhag Service Counter</h1>";
echo "<h2>All Requests</h2>";

foreach ($requests as $index => $dzongkhag) {
    echo "Request " . ($index + 1) . ": $dzongkhag<br>";

    if (!isset($counts[$dzongkhag])) {
        $counts[$dzongkhag] = 0;
    }

    $counts[$dzongkhag]++;
}

echo "<h2>Request Counts</h2><ul>";

foreach ($counts as $dzongkhag => $count) {
    echo "<li>$dzongkhag: $count</li>";
}

echo "</ul>";

$total = count($requests);
$highest = max($counts);
$topDzongkhags = [];

foreach ($counts as $dzongkhag => $count) {
    if ($count == $highest) {
        $topDzongkhags[] = $dzongkhag;
    }
}

$thimphuCount = $counts["Thimphu"] ?? 0;
$percentage = ($thimphuCount / $total) * 100;

echo "<p>Total requests: $total</p>";
echo "<p>Highest requests: " . implode(", ", $topDzongkhags) . "</p>";
echo "<p>Thimphu percentage: " .
    number_format($percentage, 2) . "%</p>";
?>