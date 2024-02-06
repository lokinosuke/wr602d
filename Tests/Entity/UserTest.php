<?php
// tests/Entity/UserTest.php
namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetterAndSetter()
    {
        $user = new User();

        // Définition de données de test
        $email = 'test@test.com';
        $password = 'password';
        $roles = ['ROLE_USER'];
        $lastname = 'Doe';
        $firstname = 'John';

        // Utilisation des setters
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setRoles($roles);
        $user->setLastname($lastname);
        $user->setFirstname($firstname);

        // Vérification des getters
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($password, $user->getPassword());
        $this->assertEquals( ['ROLE_USER', 'ROLE_ADMIN'], $user->getRoles());
        $this->assertEquals($lastname, $user->getLastname());
        $this->assertEquals($firstname, $user->getFirstname());

    }
}