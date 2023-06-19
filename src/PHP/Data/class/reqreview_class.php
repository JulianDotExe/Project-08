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
                }, 2000);
                </script>';

                $bezoekverzoekid = 2;

                $sql = "UPDATE bezoekers SET bezoek_verzoek_id = :bezoek_verzoek_id WHERE bezoek_id = :bezoek_id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ':bezoek_verzoek_id' => $bezoekverzoekid,
                    ':bezoek_id' => $this->id 
                ]);

                // $sql = "SELECT * FROM bezoekers WHERE bezoek_id = :bezoek_id"; 
                // $stmt = $this->pdo->prepare($sql);
                // $stmt->execute([
                //     ':bezoek_id' => $this->id
                // ]);
                
                // $row = $stmt->fetchColumn();

                $melding = "";
                $email = [];
                $email[] = htmlspecialchars($_GET['email_bezoeker']);
                // $email = $row['email_bezoeker'];
                // $email = htmlspecialchars($_POST['email_bezoeker']);

                // deze function genereert een token 64 tekens lang.
                $token = bin2hex(random_bytes(32));
                $timestamp = new DateTime("now");
                $timestamp = $timestamp->getTimestamp();
                // sla de token en timestamp voor deze klant in de database

                include("mail.php");
                // $email = $_POST['email_bezoeker'];

                $onderwerp = "Verzoek voor bezoek";
                $bericht = "<p>Bij deze de resultaten van onze reviews van uw verzoek:</p>
                            <p>Uw verzoek is goed gekeurd.</p>
                            <p>- Team HoornHack</p>";
                try{
                    Mailen($email, "bezoeker", $onderwerp, $bericht);
                    $melding = 'Open je mail om verder te gaan.';
                } catch(Exception $e){
                    $melding = 'Kon geen mail sturen - ' + $e->getMessage();
                }
                echo "<div id='melding'>".$melding."</div>";

            } else if (isset($_POST["bezoek_verzoek_id_no"])) {
                echo '<div id="confirm">Actie succesvol</div>';
                echo '<script>setTimeout(function(){
                    document.getElementById("confirm").style.display = "none";        
                }, 2000);
                </script>';
                // window.location.href="overzicht_bezoeken.php";

                $bezoekverzoekid = 3;

                $sql = "UPDATE bezoekers SET bezoek_verzoek_id = :bezoek_verzoek_id WHERE bezoek_id = :bezoek_id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ':bezoek_verzoek_id' => $bezoekverzoekid,
                    ':bezoek_id' => $this->id
                ]);

                $melding = "";
                $email = [];
                $email[] = htmlspecialchars($_GET['email_bezoeker']);

                // deze function genereert een token 64 tekens lang.
                $token = bin2hex(random_bytes(32));
                $timestamp = new DateTime("now");
                $timestamp = $timestamp->getTimestamp();
                // sla de token en timestamp voor deze klant in de database

                include("mail.php");
                // $email = $_POST['email_bezoeker'];

                $onderwerp = "Verzoek voor bezoek";
                $bericht = "<p>Bij deze de resultaten van onze reviews van uw verzoek:</p>
                            <p>Helaas moeten wij uw melden dat uw verzoek is afgekeurd.</p>
                            <p>Neem contact op met het personeel voor meer informatie.</p>
                            <p>- Team HoornHack</p>";
                try{
                    Mailen($email, "bezoeker", $onderwerp, $bericht);
                    $melding = 'Open je mail om verder te gaan.';
                } catch(Exception $e){
                    $melding = 'Kon geen mail sturen - ' + $e->getMessage();
                }
                echo "<div id='melding'>".$melding."</div>";
            }
        }
    }

    require_once("inc/db_conn.php"); 

    $verzoekHandler = new BezoekVerzoekHandler($pdo, $id);
    $verzoekHandler->handleVerzoek();

?>