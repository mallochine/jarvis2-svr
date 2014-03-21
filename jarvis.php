<?php
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
# Author: Alex Guo
# Contact: chssnut@outlook.com
# Program: JARVIS.
# Purpose: serve as the back-end for the JARVIS CLI tool line.

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
