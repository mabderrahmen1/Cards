<?php
// Incrémentation du compteur (sans affichage ici)
$counterFile = "counter.txt";
if (!file_exists($counterFile)) {
    file_put_contents($counterFile, 0);
}
$counter = (int)file_get_contents($counterFile);
$counter++;
file_put_contents($counterFile, $counter); // Sauvegarde

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $to = "votre@email.com";
    $subject = "Nouveau message de $name";
    $body = "Nom: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email";

    if (empty($name) || empty($email) || empty($message)) {
        echo '<script>alert("Tous les champs sont obligatoires."); window.history.back();</script>';
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (mail($to, $subject, $body, $headers)) {
            echo '<script>alert("Message envoyé avec succès!"); window.location.href = "accueil.html";</script>';
        } else {
            echo '<script>alert("Une erreur est survenue. Veuillez réessayer."); window.history.back();</script>';
        }
    } else {
        echo '<script>alert("Adresse email invalide."); window.history.back();</script>';
    }
} else {
    header("Location: accueil.html");
    exit;
}
