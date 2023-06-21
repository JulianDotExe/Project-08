<?php

require_once('../inc/db_conn.php');

class FileDownloader {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function downloadFile($fileId) {
        // Prepare the SQL statement
        $stmt = $this->pdo->prepare("SELECT * FROM files WHERE files_id = ?");
        $stmt->bindParam(1, $fileId);

        // Execute the statement
        $stmt->execute();

        // Fetch the file record
        $file = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($file) {
            $fileName = $file['name'];
            $fileContent = $file['content'];
            $fileType = $file['type'];

            // Set the appropriate headers for file download
            header("Content-type: $fileType");
            header("Content-Disposition: attachment; filename=$fileName");

            // Output the file content
            echo $fileContent;
            exit;
        } else {
            echo "File not found.";
        }
    }
}

// Create an instance of FileDownloader
$fileDownloader = new FileDownloader($pdo);

// Check if the file_id is set in the request parameters
if (isset($_GET['file_id'])) {
    $fileId = $_GET['file_id'];

    // Call the downloadFile method
    $fileDownloader->downloadFile($fileId);
}

?>

