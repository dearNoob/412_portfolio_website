<?php
require_once('tcpdf/tcpdf.php'); // Include TCPDF library
include 'db.php'; // Include database connection

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Resume Builder');
$pdf->SetTitle('Professional CV');
$pdf->SetSubject('Generated CV');
$pdf->SetKeywords('CV, Resume, PDF, TCPDF');

// Set default header and footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Fetch data from the database
try {
    // Fetch personal information
    $stmt = $conn->query("SELECT * FROM personal_info LIMIT 1");
    $personalInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch experience
    $stmt = $conn->query("SELECT * FROM experience");
    $experience = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch education
    $stmt = $conn->query("SELECT * FROM education");
    $education = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch skills
    $stmt = $conn->query("SELECT * FROM skills");
    $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch summary
    $stmt = $conn->query("SELECT * FROM summary LIMIT 1");
    $summary = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch additional details
    $stmt = $conn->query("SELECT * FROM additional_details LIMIT 1");
    $additionalDetails = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}

// Check if data exists before accessing it
if (!$personalInfo || !$summary || !$additionalDetails) {
    die("Error: Missing required data to generate the PDF.");
}

// Build the PDF content
$html = '<style>
body {
    font-family: "Poppins", sans-serif;
    color: #333;
    line-height: 1.6;
}
.cv-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 40px;
    background: #fff;
    color: #333;
    border-radius: 8px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}
.cv-header h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    color: #2c3e50;
    font-weight: 600;
}
.cv-section h2 {
    font-size: 1.4rem;
    margin-bottom: 15px;
    color: #2c3e50;
    font-weight: 600;
    border-bottom: 2px solid #3498db;
    padding-bottom: 5px;
}
.timeline-item {
    padding-left: 25px;
    position: relative;
    margin-bottom: 25px;
    border-left: 2px solid #e0e0e0;
}
.timeline-item::before {
    content: "";
    position: absolute;
    left: -8px;
    top: 0;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #3498db;
}
.skill-item {
    background-color: #f0f7fc;
    padding: 8px 15px;
    border-radius: 20px;
    color: #3498db;
    font-size: 0.9rem;
    font-weight: 500;
    display: inline-block;
    margin-right: 5px;
    margin-bottom: 5px;
}
</style>';

$html .= '<div class="cv-container">';
$html .= '<div class="cv-header">';
$html .= '<h1>Professional CV</h1>';
$html .= '<p><strong>Name:</strong> ' . htmlspecialchars($personalInfo['first_name'] . ' ' . $personalInfo['surname']) . '</p>';
$html .= '<p><strong>Email:</strong> ' . htmlspecialchars($personalInfo['email']) . '</p>';
$html .= '<p><strong>Phone:</strong> ' . htmlspecialchars($personalInfo['phone']) . '</p>';
$html .= '<p><strong>City:</strong> ' . htmlspecialchars($personalInfo['city']) . ', ' . htmlspecialchars($personalInfo['country']) . '</p>';
$html .= '</div>';

// Summary
$html .= '<div class="cv-section">';
$html .= '<h2>Summary</h2>';
$html .= '<p>' . htmlspecialchars($summary['summary_text']) . '</p>';
$html .= '</div>';

// Experience
if (!empty($experience)) {
    $html .= '<div class="cv-section">';
    $html .= '<h2>Professional Experience</h2>';
    foreach ($experience as $exp) {
        $html .= '<div class="timeline-item">';
        $html .= '<p class="timeline-title"><strong>' . htmlspecialchars($exp['job_title']) . '</strong> at ' . htmlspecialchars($exp['company']) . '</p>';
        $html .= '<p class="timeline-date">' . htmlspecialchars($exp['start_date'] . ' to ' . $exp['end_date']) . '</p>';
        $html .= '<p class="timeline-subtitle">' . htmlspecialchars($exp['city'] . ', ' . $exp['country']) . '</p>';
        $html .= '</div>';
    }
    $html .= '</div>';
}

// Education
if (!empty($education)) {
    $html .= '<div class="cv-section">';
    $html .= '<h2>Education</h2>';
    foreach ($education as $edu) {
        $html .= '<div class="timeline-item">';
        $html .= '<p class="timeline-title"><strong>' . htmlspecialchars($edu['degree']) . '</strong> in ' . htmlspecialchars($edu['field_of_study']) . '</p>';
        $html .= '<p class="timeline-date">' . htmlspecialchars($edu['graduation_date']) . '</p>';
        $html .= '<p class="timeline-subtitle">' . htmlspecialchars($edu['institute_name'] . ', ' . $edu['school_location']) . '</p>';
        $html .= '</div>';
    }
    $html .= '</div>';
}

// Skills
if (!empty($skills)) {
    $html .= '<div class="cv-section">';
    $html .= '<h2>Skills</h2>';
    $html .= '<div class="skills-grid">';
    foreach ($skills as $skill) {
        $html .= '<span class="skill-item">' . htmlspecialchars($skill['skill_name']) . '</span>';
    }
    $html .= '</div>';
    $html .= '</div>';
}

// Additional Details
$html .= '<div class="cv-section">';
$html .= '<h2>Additional Information</h2>';
$html .= '<p><strong>Certifications:</strong> ' . htmlspecialchars($additionalDetails['certifications']) . '</p>';
$html .= '<p><strong>Languages:</strong> ' . htmlspecialchars($additionalDetails['languages']) . '</p>';
$html .= '<p><strong>Hobbies:</strong> ' . htmlspecialchars($additionalDetails['hobbies']) . '</p>';
$html .= '<p><strong>Other Details:</strong> ' . htmlspecialchars($additionalDetails['other_details']) . '</p>';
$html .= '</div>';

$html .= '</div>'; // Close cv-container

// Output the HTML content to the PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('Professional_CV.pdf', 'I'); // 'I' for inline display, 'D' for download
?>