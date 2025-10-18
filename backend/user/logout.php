<?php
session_start();
session_unset();
session_destroy();

// Redirige proprement vers la page d'accueil
header('Location: /index.php?page=home');
exit;
