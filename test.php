<?php
if (isset($_POST['name'])) {
    echo "SUCCESS";
} else var_dump($_POST);
// include 'header.php';
// include 'db_config.php';

// include 'vendors/autoload.php';
// include 'vendors/codelicious/php-coda-parser/src/Parser.php';
// include 'vendors/codelicious/php-coda-parser/src/Statements/Account.php';
// include 'vendors/codelicious/php-coda-parser/src/Statements/Statement.php';
// include 'vendors/codelicious/php-coda-parser/src/Statements/Transaction.php';

// use Codelicious\Coda\Parser;
// use Codelicious\Coda\Statements\Statement;
// use Codelicious\Coda\Statements\Transaction;

// $parser = new Parser();
// $codaFile = '';
// $err_msg = '';
// if (isset($_POST['codafile'])) {
//     $target_dir = "codafiles/";
//     $fileName = $_FILES['file']['name'];
//     $filePath = $target_dir . basename($fileName);
//     $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
//     $coda_response = [];
//     $coda_response['file_name'] = $fileName;


//         // Allow only COD files
//         if ($fileType != "cod") {
//             $err_msg = "Seuls les fichiers COD sont autorisés.";
//         }
//         // Chech if file already exists
//         else if (file_exists($filePath)) {
//             $codaFile = $filePath;
//             $err_msg = "Fichier déjà téléchargé, Affichage des données du fichier.";
//         }
//         // If no error message
//         else if (!$err_msg) {
//             // Try to upload the file
//             if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
//                 $codaFile = $filePath;
//                 $err_msg = "Fichier transféré avec succès.";
//             }
//             // if upload failed
//             else {
//                 $err_msg = "Échec du téléchargement du fichier.";
//             }
//         }
//         $coda_response['file_response'] = $err_msg;
//         // Read coda file
//         if ($codaFile) {
//             // use coda parser library
//             $statements = $parser->parseFile($codaFile);
//             echo '<pre>';
//             var_dump($statements);
//             echo '</pre>';
//         }

//         echo "SUCCESS";
// }
// else echo "FAIL";
?>
                                    <!-- <form class="forms-sample pt-3 pl-3" id="codaform" action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="codafile">
                                                <h3>Choisissez coda à télécharger</h3>
                                            </label>
                                            <input type="file" class="form-control-file" name="file" id="file" aria-describedby="fileHelp">
                                            <p id="fileHelp" class="form-text text-muted pt-3">Choisissez de télécharger un fichier coda bancaire belge. Seul le format de fichier .cod est accepté. </p>
                                        </div> -->
                                        <!-- <div class="col-12"> -->
                                        <!-- <button type="submit" class="btn btn-primary btn-lg" id="btn-upload" name="codafile">Télécharger CODA</button> -->
                                        <!-- </div> -->
                                    <!-- </form> -->
