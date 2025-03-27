<?php
session_start();

if (!isset($_SESSION['sessionid'])) {
    http_response_code(403);
    die('Unauthorized access');
}

$file = basename($_GET['file']); 
$file_path = __DIR__ . "/" . $file; 

$allowed_extensions = ['xlsx', 'doc', 'docx', 'pdf'];
$file_extension = pathinfo($file_path, PATHINFO_EXTENSION);

if (file_exists($file_path) && in_array($file_extension, $allowed_extensions)) {
    $mime_types = [
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'doc'  => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'pdf'  => 'application/pdf'
    ];

    header('Content-Type: ' . $mime_types[$file_extension]);
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    header('Content-Length: ' . filesize($file_path));
    
    readfile($file_path);
    exit;
} else {
    http_response_code(404);
    die('File not found');
}
?>
