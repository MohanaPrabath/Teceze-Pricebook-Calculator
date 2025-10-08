<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teceze Global Pricebook Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Teceze Global Pricebook Calculator</h1>
            <p>Select a service and enter quantity to calculate pricing</p>
        </header>

        <form method="POST" action="process.php" class="calculator-form">
            <div class="form-group">
                <label for="service">Select Service:</label>
                <select name="service" id="service" required>
                    <option value="">-- Choose a Service --</option>
                    <?php
                    // Read JSON data
                    $jsonData = file_get_contents('Teceze_Global_Pricebook_all_sheets.json');
                    $data = json_decode($jsonData, true);

                    if ($data && isset($data['Commercials'])) {
                        // Get unique service levels from the data
                        $services = array();
                        foreach ($data['Commercials'] as $entry) {
                            if (!empty($entry['L1']) && is_numeric($entry['L1'])) {
                                $services['L1'] = 'L1 - Basic Support (Min 6 months experience)';
                            }
                            if (!empty($entry['L2']) && is_numeric($entry['L2'])) {
                                $services['L2'] = 'L2 - Advanced Support (Min 18 months experience)';
                            }
                            if (!empty($entry['L3']) && is_numeric($entry['L3'])) {
                                $services['L3'] = 'L3 - Expert Support (Min 2 years experience)';
                            }
                            if (!empty($entry['L4']) && is_numeric($entry['L4'])) {
                                $services['L4'] = 'L4 - Senior Expert (3-5 years experience)';
                            }
                            if (!empty($entry['L5']) && is_numeric($entry['L5'])) {
                                $services['L5'] = 'L5 - Architecture & Planning (5+ years experience)';
                            }
                        }

                        // Remove duplicates and display options
                        $services = array_unique($services);
                        foreach ($services as $key => $value) {
                            echo "<option value=\"$key\">$value</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" min="1" step="1" required>
            </div>

            <div class="form-group">
                <label for="location">Location (Optional):</label>
                <select name="location" id="location">
                    <option value="">-- Choose Location --</option>
                    <?php
                    if ($data && isset($data['Commercials'])) {
                        $locations = array();
                        foreach ($data['Commercials'] as $entry) {
                            if (!empty($entry['Country']) && !empty($entry['Region'])) {
                                $location = $entry['Region'] . ' - ' . $entry['Country'];
                                if (!in_array($location, $locations)) {
                                    $locations[] = $location;
                                    echo "<option value=\"$location\">$location</option>";
                                }
                            }
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="project_type">Project Type:</label>
                <select name="project_type" id="project_type" required>
                    <option value="">-- Choose Project Type --</option>
                    <option value="short_term">Short-Term Project</option>
                    <option value="long_term">Long-Term Project</option>
                </select>
            </div>

            <button type="submit" class="calculate-btn">Calculate Price</button>
        </form>

        <?php
        // Display results if available
        if (isset($_GET['service']) && isset($_GET['unit_price']) && isset($_GET['quantity']) && isset($_GET['total'])) {
            $service = htmlspecialchars($_GET['service']);
            $unitPrice = htmlspecialchars($_GET['unit_price']);
            $quantity = htmlspecialchars($_GET['quantity']);
            $total = htmlspecialchars($_GET['total']);
            $location = isset($_GET['location']) ? htmlspecialchars($_GET['location']) : 'Not specified';
            $currency = isset($_GET['currency']) ? htmlspecialchars($_GET['currency']) : 'USD';
            $projectType = isset($_GET['project_type']) ? htmlspecialchars($_GET['project_type']) : '';
            $adjustedTotal = isset($_GET['adjusted_total']) ? htmlspecialchars($_GET['adjusted_total']) : '';

            // Determine project type display name
            $projectTypeDisplay = '';
            if ($projectType === 'short_term') {
                $projectTypeDisplay = 'Short-Term';
            } elseif ($projectType === 'long_term') {
                $projectTypeDisplay = 'Long-Term';
            }

            echo "
            <div class='result'>
                <h2>Calculation Result</h2>
                <div class='result-details'>
                    <p><strong>Service:</strong> $service</p>
                    <p><strong>Location:</strong> $location</p>
                    <p><strong>Currency:</strong> $currency</p>
                    <p><strong>Unit Price:</strong> $unitPrice</p>
                    <p><strong>Quantity:</strong> $quantity</p>
                    <p><strong>Project Type:</strong> $projectTypeDisplay Project</p>
                    <p class='total'><strong>Base Total:</strong> $total $currency</p>";

            if (!empty($adjustedTotal)) {
                echo "
                    <p class='adjusted-total'><strong>Adjusted Total for $projectTypeDisplay Project:</strong> $adjustedTotal $currency</p>";
            }

            echo "
                </div>
            </div>";
        }
        ?>
    </div>
</body>
</html>
