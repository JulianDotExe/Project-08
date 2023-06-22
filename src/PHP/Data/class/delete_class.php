<?php

require_once('../inc/db_conn.php');

class FileDeletionSystem {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function deleteFile($fileId, $gevangenenId) {
        $stmt = $this->pdo->prepare("SELECT * FROM files WHERE files_id = ? AND id_gevangenen = ?");
        $stmt->bindParam(1, $fileId);
        $stmt->bindParam(2, $gevangenenId);
        $stmt->execute();
        $file = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($file) {
            $deleteStmt = $this->pdo->prepare("DELETE FROM files WHERE files_id = ? AND id_gevangenen = ?");
            $deleteStmt->bindParam(1, $fileId);
            $deleteStmt->bindParam(2, $gevangenenId);
            $deleteStmt->execute();
            return true;
        }

        return false;
    }
}

$fileDeletionSystem = new FileDeletionSystem($pdo);

if (isset($_GET['file_id']) && isset($_GET['id_gevangenen'])) {
    $fileId = $_GET['file_id'];
    $gevangenenId = $_GET['id_gevangenen'];

    if ($fileDeletionSystem->deleteFile($fileId, $gevangenenId)) {
        header("Location: ../bestanden.php?id=" . $gevangenenId);
        exit;
    } else {
        echo "<p>File not found.</p>";
    }
} else {
    echo "<p>Both file ID and gevangenen ID are required.</p>";
}

?>
