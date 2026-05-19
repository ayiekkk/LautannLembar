<?php

$conn = mysqli_connect(
    "localhost",
    "ojokerro_Lautan",
    "Lautan1234567",
    "ojokerro_lautanlembardb"
);

if (!$conn) {
    die(mysqli_connect_error());
}

echo "Koneksi sukses";