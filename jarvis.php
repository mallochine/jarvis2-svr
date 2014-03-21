<?php

ob_start();
print_r($_POST);
$result = ob_get_clean();
file_put_contents("log/jarvis.txt", $result);

function update_ls() {
    shell_exec('ls up/ > log/ls.txt');
}

$cmd = $_POST['cmd'];
$file = $_POST['file'];
switch ($cmd) {
case "rm":
    shell_exec("rm up/$file.txt");
    update_ls();
    break;

case "up":
    # Store the file.
    $filename = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];
    move_uploaded_file($filetmp, "up/$filename.txt");
    update_ls();
    break;
}
