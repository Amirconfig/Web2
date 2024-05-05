<?php
$customer_name = $_POST['customer_name'] ?? '';
$customer_email = $_POST['customer_email'] ?? '';
$room = $_POST['room'] ?? '';
$side_one = floatval($_POST['side_one'] ?? 0);
$side_two = floatval($_POST['side_two'] ?? 0);
$side_three = floatval($_POST['side_three'] ?? 0);
$color = $_POST['color'] ?? '';
$paint_type = floatval($_POST['paint_type'] ?? 0);

$errors = [];

if (empty($customer_name)) {
  $errors[] = "Please enter a customer name.";
}

if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "Please enter a valid email address.";
}

if (empty($room)) {
  $errors[] = "Please select a room.";
}

if (!is_numeric($side_one) || $side_one <= 0) {
  $errors[] = "Please enter a valid value for side one.";
}

if (!is_numeric($side_two) || $side_two <= 0) {
  $errors[] = "Please enter a valid value for side two.";
}

if (!is_numeric($side_three) || $side_three <= 0) {
  $errors[] = "Please enter a valid value for side three.";
}

if (empty($paint_type)) {
  $errors[] = "Please select a paint type.";
}

if (count($errors) > 0) {
  echo "<h1>Error</h1>";
  foreach ($errors as $error) {
    echo "<p>$error</p>";
  }
} else {
  $total_sq_ft = 2 * ($side_one * $side_two + $side_two * $side_three + $side_one * $side_three);
  $paint_coverage = 350;
  $paint_cans_required = ceil($total_sq_ft / $paint_coverage);
  $final_price = ($total_sq_ft / $paint_coverage) * $paint_type;
  $final_price_with_tax = $final_price * 1.13;

  echo "<h1>Painting Estimate / Assignment#5</h1>";
  echo "Customer Name: " . htmlspecialchars($customer_name) . "<br>";
  echo "Customer Email Address: " . htmlspecialchars($customer_email) . "<br>";
  echo "Room to be Painted: " . htmlspecialchars($room) . "<br>";
  echo "Total Square Feet of the Room: " . $total_sq_ft . " sq ft<br>";
  echo "Colour Selected: <span style='display: inline-block; width: 50px; height: 50px; background-color: " . htmlspecialchars($color) . ";'></span><br>";

  if ($paint_type == 34.99) {
    echo "Paint Type: Standard Paint ($34.99 per can)<br>";
  } else {
    echo "Paint Type: Premium Paint ($45 per can)<br>";
  }

  echo "Number of Paint Cans Required: " . $paint_cans_required . "<br>";
  echo "Final Price (excluding tax): $" . number_format($final_price, 2) . "<br>";
  echo "Final Price (including 13% GST): $" . number_format($final_price_with_tax, 2);
}
