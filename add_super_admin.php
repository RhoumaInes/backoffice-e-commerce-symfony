<?php
// add_super_admin.php
require 'vendor/autoload.php';

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

$entityManager = require 'config/bootstrap.php';

$user = new User();
$user->setEmail('ines.rhouma@esprit.tn');
$user->setPassword(password_hash('inesrhouma', PASSWORD_BCRYPT)); // Remplacez par un mot de passe sécurisé
$user->setRoles(['ROLE_SUPER_ADMIN']);

$entityManager->persist($user);
$entityManager->flush();

echo "Super Admin user created successfully.\n";