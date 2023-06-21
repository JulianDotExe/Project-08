<?php
// Check if both the file ID and gevangenen ID are provided
if (isset($_GET['file_id']) && isset($_GET['id_gevangenen'])) {
  $fileId = $_GET['file_id'];
  $gevangenenId = $_GET['id_gevangenen'];

  // Connect to the database
  require_once("../inc/db_conn.php");

  // Prepare the SQL statement to retrieve the file details
  $stmt = $pdo->prepare("SELECT * FROM files WHERE files_id = ? AND id_gevangenen = ?");
  $stmt->bindParam(1, $fileId);
  $stmt->bindParam(2, $gevangenenId);

  // Execute the statement
  $stmt->execute();

  // Fetch the file details
  $file = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($file) {
    // Delete the file from the database
    $deleteStmt = $pdo->prepare("DELETE FROM files WHERE files_id = ? AND id_gevangenen = ?");
    $deleteStmt->bindParam(1, $fileId);
    $deleteStmt->bindParam(2, $gevangenenId);
    $deleteStmt->execute();

    // Redirect back to the bewijs_class.php page
    header("Location: bewijs_class.php?id=" . $gevangenenId);
    
    exit;
  } else {
    echo "<p>File not found.</p>";
  }
} else {
  echo "<p>Both file ID and gevangenen ID are required.</p>";
}
?>
