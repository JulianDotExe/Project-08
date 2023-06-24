<?php
class Role {
    private $id;
    public $inlognaam;
    private $pdo;
    public $rol_id;
    public $rol;

    public function __construct($db){
        $this->pdo = $db;
    }
    public function readRoleAll() {
        $qryRol = "SELECT * FROM functie;";
        $stmt = $this->pdo->prepare( $qryRol );
        $stmt->execute();
        return $stmt;
    }

    public function addRole($rolName) {
        $qryRol = "INSERT INTO functie (functie_naam) VALUES (:functie_naam)";
        $insertStmt = $this->pdo->prepare($qryRol);
        $insertStmt->bindParam(':functie_naam', $rolName);
        $insertStmt->execute();
        return $insertStmt;
    }


}