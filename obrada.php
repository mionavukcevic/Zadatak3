<?php

$mysqli = new mysqli("localhost", "korisnik", "lozinka", "forma_podaci");


if ($mysqli->connect_error) {
    die("Greška u konekciji sa bazom: " . $mysqli->connect_error);
}


$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$email = $_POST['email'];


$json_podaci = json_encode([
    'ime' => $ime,
    'prezime' => $prezime,
    'email' => $email
]);


file_put_contents('podaci.json', $json_podaci);


$sql = "INSERT INTO korisnici (ime, prezime, email, json_podaci) VALUES ('$ime', '$prezime', '$email', '$json_podaci')";

if ($mysqli->query($sql) === TRUE) {
    echo "Podaci su uspešno sačuvani u bazi i JSON fajlu.";
} else {
    echo "Greška pri čuvanju podataka: " . $mysqli->error;
}


$mysqli->close();
?>
