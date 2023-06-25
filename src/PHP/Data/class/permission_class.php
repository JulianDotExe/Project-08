<?php
class Permission {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getRoles() {
        $qry = "SELECT * FROM functie"; //id and rol...
        $stmt = $this->pdo->prepare($qry);
        $stmt->execute();
        return $stmt;
    }

    public function getPermissions() {
        $qry = "SELECT * FROM permissie";
        $stmt = $this->pdo->prepare($qry);
        $stmt->execute();
        return $stmt;
    }

    public function CheckPagePermission($pageTitle, $emailUser)
    {
        $stmt = $this->pdo->prepare("SELECT functie_id FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindValue(':gebruikersnaam', $emailUser);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();
    
        // echo "User Role: " . $userRole . "<br>";
    
        $stmt = $this->pdo->prepare("SELECT permissie_id AS count FROM permissie WHERE permissie_desc = :permissie_desc");
        $stmt->bindValue(':permissie_desc', $pageTitle);
        $stmt->execute();
        $pageTitleID = $stmt->fetchColumn();
        

        // echo "Page Title ID: " . $pageTitleID . "<br>";

        $resultstmt = $this->pdo->prepare("SELECT COUNT(*) FROM functie_permissie WHERE functie_id = :functie_id AND permissie_id = :permissie_id");
        $resultstmt->bindValue(':functie_id', $userRole);
        $resultstmt->bindValue(':permissie_id', $pageTitleID);
        $resultstmt->execute();
        $count = $resultstmt->fetchColumn();
    
        // echo "Permission Count: " . $count . "<br>";
        
        if($count == 0) {
            echo "
                <script>
                    alert('You are not allowed to access this page.');
                    window.history.back();
                </script>
            ";
            exit();
        }
    }

    public function getPermissionsForRole($rolId) {
        $qry = "SELECT r.permissie_desc
                FROM permissie r
                INNER JOIN functie_permissie rr ON r.permissie_id = rr.permissie_id
                WHERE rr.rol_id = :rolId";
        $stmt = $this->pdo->prepare($qry);
        $stmt->bindParam(':rolId', $rolId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getRolesPermission() {
        $qry = "SELECT * FROM functie_permissie"; 
        $stmt = $this->pdo->prepare($qry);
        $stmt->execute();
        return $stmt;
    }

    public function checkPermissions($rolId, $permId) {
        $qry = "SELECT functie_id, permissie_id FROM functie_permissie WHERE functie_id = :rolId AND permissie_id = :permId";
        $stmt = $this->pdo->prepare($qry);
        // bind variables
        $stmt->bindParam(':rolId', $rolId, PDO::PARAM_INT);
        $stmt->bindParam(':permId', $permId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $permissions = array_column($result, 'permissie_id'); // Extract the permissie_id values into an array
        return $permissions;
    }

    public function savePermissions($rolId, $checkboxes) {
        // Perform the necessary operations to delete existing entries
        $deleteQry = "DELETE FROM functie_permissie WHERE functie_id = :functie_id";
        $deleteStmt = $this->pdo->prepare($deleteQry);
        $deleteStmt->bindParam(':functie_id', $rolId);
        $deleteStmt->execute();

        // Perform the necessary operations to save the data
        $insertQry = "INSERT INTO functie_permissie (functie_id, permissie_id) VALUES (:functie_id, :permissie_id)";
        $insertStmt = $this->pdo->prepare($insertQry);
        $insertStmt->bindParam(':functie_id', $rolId);
        
        // Insert the new entries
        foreach ($checkboxes as $checkbox) {
            $insertStmt->bindValue(':permissie_id', $checkbox); // Bind the parameter inside the loop
            $insertStmt->execute();
        }
    }

    public function addPermission($rechtDesc) {
        $qryRol = "INSERT INTO permissie (permissie_desc) VALUES (:permissie_desc)";
        $insertStmt = $this->pdo->prepare($qryRol);
        $insertStmt->bindParam(':permissie_desc', $rechtDesc);
        $insertStmt->execute();
        return $insertStmt;
    }

}

?>