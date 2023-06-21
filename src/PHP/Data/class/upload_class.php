<?php

require_once('../inc/db_conn.php');

class FileUploader {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function uploadFile($gevangenenId, $file, $description) {
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];

        // Read the file content
        $fileContent = file_get_contents($fileTmpName);

        // Prepare the SQL statement
        $stmt = $this->pdo->prepare("INSERT INTO files (name, content, size, type, description, id_gevangenen) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $fileName);
        $stmt->bindParam(2, $fileContent, PDO::PARAM_LOB);
        $stmt->bindParam(3, $fileSize);
        $stmt->bindParam(4, $fileType);
        $stmt->bindParam(5, $description);
        $stmt->bindParam(6, $gevangenenId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "File uploaded successfully.";
        } else {
            echo "Error uploading file.";
        }
    }
}

// Create an instance of FileUploader
$fileUploader = new FileUploader($pdo);

// Check if the request method is POST and the file parameter is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $gevangenenId = $_POST['id_gevangenen'];
    $file = $_FILES['file'];
    $description = $_POST['description'];

    // Call the uploadFile method
    $fileUploader->uploadFile($gevangenenId, $file, $description);
}

?>
