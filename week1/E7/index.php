
<?php
$serviceFees = [
    "Certificate" => 100,
    "Verification" => 50,
    "Replacement" => 200,
    "Correction" => 75
];

$selectedService = "Certificate";
$quantity = 5;

function calculateFee($service, $quantity, $fees) {
    if (!isset($fees[$service])) {
        return ["error" => "Unknown service."];
    }

    if (!is_numeric($quantity) || $quantity < 1 ||
        (int)$quantity != $quantity) {
        return ["error" => "Quantity must be at least 1."];
    }

    $unitFee = $fees[$service];
    $subtotal = $unitFee * $quantity;

    $discount = $quantity >= 5 ? $subtotal * 0.10 : 0;
    $processing = 20;
    $total = $subtotal - $discount + $processing;

    return [
        "service" => $service,
        "unitFee" => $unitFee,
        "quantity" => $quantity,
        "subtotal" => $subtotal,
        "discount" => $discount,
        "processing" => $processing,
        "total" => $total
    ];
}

$result = calculateFee($selectedService, $quantity, $serviceFees);

echo "<h1>Service Fee Calculator</h1>";

if (isset($result["error"])) {
    echo "<p style='color:red'>" . $result["error"] . "</p>";
} else {
    echo "<p>Service: " . $result["service"] . "</p>";
    echo "<p>Unit fee: Nu. " . number_format($result["unitFee"], 2) . "</p>";
    echo "<p>Quantity: " . $result["quantity"] . "</p>";
    echo "<p>Cost before discount: Nu. " . number_format($result["subtotal"], 2) . "</p>";
    echo "<p>Discount: Nu. " . number_format($result["discount"], 2) . "</p>";
    echo "<p>Processing charge: Nu. " . number_format($result["processing"], 2) . "</p>";
    echo "<h2>Final amount: Nu. " . number_format($result["total"], 2) . "</h2>";
}
?>