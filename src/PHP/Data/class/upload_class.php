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
        $fileType = $file['type'];

        // Read the file content
        $fileContent = file_get_contents($fileTmpName);

        // Prepare the SQL statement
        $stmt = $this->pdo->prepare("INSERT INTO files (name, content, type, description, id_gevangenen) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $fileName);
        $stmt->bindParam(2, $fileContent, PDO::PARAM_LOB);
        $stmt->bindParam(3, $fileType);
        $stmt->bindParam(4, $description);
        $stmt->bindParam(5, $gevangenenId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('File uploaded successfully.')</script>";
            header("Location: bewijs_class.php?id=$gevangenenId");
        } else {
            echo "<script>alert('Error uploading file.')</script>";
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
