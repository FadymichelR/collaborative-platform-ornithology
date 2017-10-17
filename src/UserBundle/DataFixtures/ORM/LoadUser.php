<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;
use AppBundle\Entity\Observation;
use AppBundle\Entity\Image;

class LoadUser implements FixtureInterface {
    private function generateUser($firstname, $surname, $email, $role) {
        $user = new User;

        // Le prénom de l'utilisateur et le mot de passe sont identiques pour l'instant
        $user->setFirstName($firstname);
        $user->setPassword($firstname);

        $user->setSurname($surname);

        $user->setEmail($email);

        $user->setRoles(array($role));

        $user->setPassword('');

        $user->setUsername($email);

        $user->setUsernameCanonical($email);

        $user->setEmailCanonical($email);

        $user->setEnabled(true);

        return $user;
    }

    public function load(ObjectManager $manager) {
        $user1 = $this->generateUser('Alex', 'Dodo', 'alex@email.fr', 'ROLE_USER');
        $manager->persist($user1);

        $user2 = $this->generateUser('Chloé', 'Jean', 'chloe@email.fr', 'ROLE_ADMIN');
        $manager->persist($user2);

        $user3 = $this->generateUser('Flo', 'Montagne', 'flo@email.fr', 'ROLE_SUDO_ADMIN');
        $manager->persist($user3);

        // On déclenche l'enregistrement
        $manager->flush();
    }
}
