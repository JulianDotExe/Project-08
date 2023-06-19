<?php

    class BezoekVerzoekHandler {
        private $pdo;
        private $id;

        public function __construct($pdo, $id) {
            $this->pdo = $pdo;
            $this->id = $id;
        }

        public function handleVerzoek() {
            if (isset($_POST["bezoek_verzoek_id_yes"])) {
                echo '<div id="confirm">Actie succesvol</div>';
                echo '<script>setTimeout(function(){
                    document.getElementById("confirm").style.display = "none";        
                    window.location.href="overzicht_bezoeken.php";
                }, 2000);
                </script>';

                $bezoekverzoekid = 2;

                $sql = "UPDATE bezoekers SET bezoek_verzoek_id = :bezoek_verzoek_id WHERE bezoek_id = :bezoek_id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ':bezoek_verzoek_id' => $bezoekverzoekid,
                    ':bezoek_id' => $this->id 
                ]);
            } else if (isset($_POST["bezoek_verzoek_id_no"])) {
                echo '<div id="confirm">Actie succesvol</div>';
                echo '<script>setTimeout(function(){
                    document.getElementById("confirm").style.display = "none";        
                    window.location.href="overzicht_bezoeken.php";
                }, 2000);
                </script>';

                $bezoekverzoekid = 3;

                $sql = "UPDATE bezoekers SET bezoek_verzoek_id = :bezoek_verzoek_id WHERE bezoek_id = :bezoek_id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ':bezoek_verzoek_id' => $bezoekverzoekid,
                    ':bezoek_id' => $this->id
                ]);
            }
        }
    }

    require_once("inc/db_conn.php"); 

    $verzoekHandler = new BezoekVerzoekHandler($pdo, $id);
    $verzoekHandler->handleVerzoek();

?>