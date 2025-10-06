<?php
// process.php - Handles form submission and price calculation

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service = $_POST['service'] ?? '';
    $quantity = $_POST['quantity'] ?? 1;
    $location = $_POST['location'] ?? '';

    // Validate inputs
    if (empty($service) || empty($quantity)) {
        header('Location: index.php?error=missing_data');
        exit;
    }

    if (!is_numeric($quantity) || $quantity < 1) {
        header('Location: index.php?error=invalid_quantity');
        exit;
    }

    // Read JSON data
    $jsonData = file_get_contents('Teceze_Global_Pricebook_all_sheets.json');
    $data = json_decode($jsonData, true);

    if (!$data || !isset($data['Commercials'])) {
        header('Location: index.php?error=data_error');
        exit;
    }

    $unitPrice = 0;
    $currency = 'USD';
    $serviceName = '';
    $found = false;

    // Find the appropriate rate based on service and location
    foreach ($data['Commercials'] as $entry) {
        // Skip header rows and empty entries
        if (empty($entry['Country']) || empty($entry['Region']) || !is_numeric($entry[$service])) {
            continue;
        }

        // Check if location matches (if specified)
        $entryLocation = $entry['Region'] . ' - ' . $entry['Country'];
        $locationMatch = empty($location) || $entryLocation === $location;

        if ($locationMatch && is_numeric($entry[$service]) && $entry[$service] > 0) {
            $unitPrice = $entry[$service];
            $currency = $entry['Currency'] ?? 'USD';
            $serviceName = getServiceName($service);
            $found = true;
            break;
        }
    }

    // If no specific location match found, use the first available rate for the service
    if (!$found) {
        foreach ($data['Commercials'] as $entry) {
            if (is_numeric($entry[$service]) && $entry[$service] > 0) {
                $unitPrice = $entry[$service];
                $currency = $entry['Currency'] ?? 'USD';
                $serviceName = getServiceName($service);
                $found = true;
                break;
            }
        }
    }

    if (!$found || $unitPrice <= 0) {
        header('Location: index.php?error=service_not_found');
        exit;
    }

    // Calculate total
    $total = $unitPrice * $quantity;

    // Format numbers for display
    $formattedUnitPrice = number_format($unitPrice, 2);
    $formattedTotal = number_format($total, 2);

    // Redirect back to index.php with results
    $params = http_build_query([
        'service' => $serviceName,
        'unit_price' => $formattedUnitPrice,
        'quantity' => $quantity,
        'total' => $formattedTotal,
        'location' => $location,
        'currency' => $currency
    ]);

    header("Location: index.php?$params");
    exit;
}

// Helper function to get service name
function getServiceName($serviceCode) {
    $serviceNames = [
        'L1' => 'L1 - Basic Support (Min 6 months experience)',
        'L2' => 'L2 - Advanced Support (Min 18 months experience)',
        'L3' => 'L3 - Expert Support (Min 2 years experience)',
        'L4' => 'L4 - Senior Expert (3-5 years experience)',
        'L5' => 'L5 - Architecture & Planning (5+ years experience)'
    ];

    return $serviceNames[$serviceCode] ?? $serviceCode;
}

// Handle GET requests (shouldn't happen normally, but just in case)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Location: index.php');
    exit;
}
?>
