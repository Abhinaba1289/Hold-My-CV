<?php


$title = "My Resumes | Hold My CV";
require './assets/includes/header.php';
require './assets/includes/navbar.php';
require './assets/includes/conndb.php'; 

class Databasee{
    private $host= 'localhost';
    private $username = 'root';

    private $database = 'cvbuilder';
    private $password= '';

    private $dbb=null;

    function __construct(){
        $this->dbb=new mysqli($this->host,$this->username,$this->password,$this->database);
    }

    public function connect(){
        return $this->dbb;
    }
}

$dbb=new Databasee();
$dbb=$dbb->connect();



$fn->AuthPage(); 
session_start();
$user = $fn->Auth();
$resumes = $db->query('SELECT * FROM resumedata WHERE user_id=' . $user['id']);
$resumes = $resumes->fetch_all(1); 

$detailsQuery = 'SELECT id FROM details  WHERE id =' . $user['id'];
$result = $dbb->query($detailsQuery);
if ($result) {
    $row = $result->fetch_assoc();
    $abhinaba = $row['id'];
    // echo "<h5 style='padding:10px; text-align:center; background-color:white;'>Your Unique ID: " . $abhinaba. "</h5>";
    $updateQuery = 'UPDATE resumedata SET user_id=' . $abhinaba . ' WHERE user_id=' . $user['id'];
} else {
    echo "Error fetching details: " . $db->error;
}

?>

    <div class="container">

        <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
            <div class="d-flex justify-content-between border-bottom">
                <h5>My Resumes📃</h5>
                <?php
                  echo "<h5>Unique Resume ID: $abhinaba</h5>";
                ?>
              
                <div>
                    <a href="createresume.php" class="text-decoration-none text-black add-new"><i style="color:black; " class="bi bi-file-earmark-plus"></i> Add New Resume</a>
                </div>
            </div>

<?php

if($resumes){
    ?>
            <div class="d-flex flex-wrap">
                <?php
                    foreach ($resumes as $resume) {
                       ?>
                        <div class="col-12 col-md-6 p-2" >
                        <div class="p-2 border rounded">
                        <h5><?=$resume['full_name']?></h5>
                        <p class="small text-secondary m-0" style="font-size:12px"><i class="bi bi-clock-history"></i>
                        Last Updated <?= date('d F, Y', strtotime($resume['updated_at'])) ?>
                        </p>
                        <div class="d-flex gap-2 mt-1">
                        <a href="createresume.action.php?user_id=<?= urlencode($resume['id']) ?>" class="text-decoration-none small">
                                <i class="bi bi-file-text"></i> Open & Download
                        </a>
                        <a href="deleteresume.action.php?id=<?= $resume['id'] ?>" class="text-decoration-none small"><i class="bi bi-copy"></i> Delete</a>
                        </div>
                    </div>
                </div>
                       <?php 
                    }
                ?>
            </div>
    <?php
}else{
    ?>
         <div class="text-center py-3 border rounded mt-3" style="background-color: rgba(236, 236, 236, 0.56);">
                <i class="bi bi-file-text"></i> No Resumes Available
            </div>
    <?php
}


?>

           




        </div>

    </div>

    <?php
require './assets/includes/footer.php';
?>