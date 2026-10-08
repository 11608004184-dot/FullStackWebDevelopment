
<?php
$name = "Pema Dorji";
$age = 24;

function classifyAge($age) {
    if ($age < 0 || $age > 120) {
        return [
            "group" => "Invalid",
            "eligible" => false,
            "explanation" => "Age must be between 0 and 120."
        ];
    }

    if ($age < 13) {
        $group = "Child";
    } elseif ($age <= 17) {
        $group = "Teenager";
    } elseif ($age <= 59) {
        $group = "Adult";
    } else {
        $group = "Senior Citizen";
    }

    $eligible = $age >= 18;

    return [
        "group" => $group,
        "eligible" => $eligible,
        "explanation" => $eligible
            ? "Eligible for the adult-only service."
            : "Not eligible for the adult-only service."
    ];
}

$result = classifyAge($age);

echo "<h1>Age and Eligibility</h1>";
echo "Name: $name<br>";
echo "Age: $age<br>";
echo "Age Group: " . $result["group"] . "<br>";
echo "Eligibility: " . $result["explanation"];
?>