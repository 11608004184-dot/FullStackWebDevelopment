
<?php
$permissions = [
    "administrator" => ["create", "read", "update", "delete", "export"],
    "data officer" => ["create", "read", "update"],
    "viewer" => ["read"]
];

$currentRole = "Data Officer";
$requestedAction = "update";

function canPerformAction($role, $action, $permissions) {
    $role = strtolower(trim($role));
    $action = strtolower(trim($action));

    if (!isset($permissions[$role])) {
        return false;
    }

    return in_array($action, $permissions[$role], true);
}

$allowed = canPerformAction(
    $currentRole,
    $requestedAction,
    $permissions
);

echo "<h1>Role Permission Checker</h1>";
echo "<p>Role: $currentRole</p>";
echo "<p>Requested action: $requestedAction</p>";

if ($allowed) {
    echo "<p style='color:green'>Access granted. You can perform this action.</p>";
} else {
    echo "<p style='color:red'>Access denied. You cannot perform this action.</p>";
}

$tests = [
    ["Administrator", "delete"],
    ["Administrator", "export"],
    ["Data Officer", "update"],
    ["Data Officer", "delete"],
    ["Viewer", "read"],
    ["Viewer", "create"],
    ["Unknown", "read"],
    ["administrator", "READ"]
];

echo "<h2>Test Results</h2>";
echo "<table border='1' cellpadding='6'>";
echo "<tr><th>Role</th><th>Action</th><th>Result</th></tr>";

foreach ($tests as $test) {
    $result = canPerformAction($test[0], $test[1], $permissions);
    echo "<tr>";
    echo "<td>{$test[0]}</td>";
    echo "<td>{$test[1]}</td>";
    echo "<td>" . ($result ? "Allowed" : "Denied") . "</td>";
    echo "</tr>";
}

echo "</table>";
?>