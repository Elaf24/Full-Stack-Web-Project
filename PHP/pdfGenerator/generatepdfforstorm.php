<?php
require('./fpdf186/fpdf.php');

// Start the session
session_start();

// Check if the user is logged in (assuming you store user info in the session)
if (!isset($_SESSION['email'])) {
    die("User not logged in");
}

$email = $_SESSION['email'];

// Connect to the database
$connection = mysqli_connect("localhost", "root", "", "demo");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // Fetch the last donation details for the logged-in user based on email
    $query = "SELECT name, category, quantity, date, address FROM storm_donate WHERE email = ? ORDER BY Fid DESC LIMIT 1";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($connection);
        exit();
    }

    // Create a new FPDF instance
    class PDF extends FPDF {
        // Page header
        function Header() {
            // Company name
            $this->SetFont('Arial', 'B', 30); // Doubled the font size
            $this->Cell(0, 20, 'Sohaiyotar Dar', 0, 1, 'C');
            $this->Ln(20);

            // Add image watermark
            $this->Image('img/semi_transparent_icon.png', 30, 80, 150); // Adjust the dimensions accordingly
        }

        // Page footer
        function Footer() {
            // Position at 1.5 cm from bottom
            $this->SetY(-40);
            // Arial italic 16 (doubled the font size)
            $this->SetFont('Arial', 'I', 16);
            // Contact information
            $this->Cell(0, 10, 'Contact: (+880) 1707564128 | sohaiyotar.dar2428@gmail.com', 0, 1, 'C');
            $this->Cell(0, 10, 'Website: sohaiyotardar.org | Social: @sohaiyotar.dar', 0, 1, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('Arial', '', 24); // Doubled the font size

    // Fetch details from the query result
    $customerName = $row['name'];
    $category = $row['category'];
    $quantity = $row['quantity'];
    $date = $row['date'];
    $address = $row['address'];

    // Output invoice details
    $pdf->SetFont('Arial', 'B', 28); // Doubled the font size
    $pdf->Cell(0, 20, "Invoice Details", 0, 1, "C");
    $pdf->Ln(20);

    $pdf->SetFont('Arial', '', 24); // Doubled the font size
    $pdf->Cell(50, 20, "Name:", 1);
    $pdf->Cell(140, 20, $customerName, 1, 1);
    $pdf->Cell(50, 20, "Item:", 1);
    $pdf->Cell(140, 20, $category, 1, 1);
    $pdf->Cell(50, 20, "Amount:", 1);
    $pdf->Cell(140, 20, $quantity, 1, 1);
    $pdf->Cell(50, 20, "Date:", 1);
    $pdf->Cell(140, 20, $date, 1, 1);
    $pdf->Cell(50, 20, "Address:", 1);
    $pdf->Cell(140, 20, $address, 1, 1);

    // Output the PDF
    $pdf->Output();

    // Close the database connection
    mysqli_close($connection);
}
?>
