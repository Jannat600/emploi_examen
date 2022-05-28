<?php

namespace App\DataFixtures;

use App\Entity\AnneeUniv;
use App\Entity\Emploi;
use App\Entity\Filiere;
use App\Entity\Horaire;
use App\Entity\Jour;
use App\Entity\Module;
use App\Entity\Niveau;
use App\Entity\Salle;
use App\Entity\Seance;
use App\Entity\Semestre;
use App\Entity\Upfien;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        // on crée 4 upfiens avec noms et prénoms "aléatoires" en français

        $filieres = array();

        for ($i = 0; $i < 5; $i++) {
            $filieres[$i] = new Filiere();
            $filieres[$i]->setIntitule(($faker->word));

            $manager->persist($filieres[$i]);
        }
        $niveaux[$i] = array();
        for ($i = 0; $i < 5; $i++) {
            $niveaux[$i] = new Niveau();
            $niveaux[$i]->setIntitule($faker->word);
            $niveaux[$i]->setFiliere($filieres[$i % 5]);
            $manager->persist($niveaux[$i]);
        }


        $upfiens = array();
        $statuts = array('Professeur', 'Etudiant');
        for ($i = 0; $i < 10; $i++) {
            $upfiens[$i] = new Upfien();
            $upfiens[$i]->setNom($faker->lastName);
            $upfiens[$i]->setPrenom($faker->firstName);
            $upfiens[$i]->setEmail($faker->email);
            $upfiens[$i]->setStatut('Etudiant');
            $upfiens[$i]->setNiveau($niveaux[$i % 5]);

            $manager->persist($upfiens[$i]);
        }
        // nouvelle boucle pour créer des users

        $users = array();

        for ($i = 0; $i < 12; $i++) {
            $users[$i] = new User();
            $users[$i]->setUsername($faker->username);
            $users[$i]->setPassword($faker->password);
            $users[$i]->setUpfien($upfiens[$i % 10]);
            $users[$i]->setRole('admin');
            
            $manager->persist($users[$i]);
        }

       
        $salles = array();
        for ($i = 0; $i < 3; $i++) {
            $salles[$i] = new Salle();
            $salles[$i]->setCode('A28');
            $manager->persist($salles[$i]);
        }

        
        
        $modules[$i] = array();
        for ($i = 0; $i < 5; $i++) {
            $modules[$i] = new Module();
            $modules[$i]->setIntitule($faker->word);
            $manager->persist($modules[$i]);
        }

        $annee_univ[$i] = array();
        for ($i = 0; $i < 5; $i++) {
            $annee_univ[$i] = new AnneeUniv();
            $annee_univ[$i]->setAnneeFin($faker->date() );
            $annee_univ[$i]->setAnneeDebut($faker->date($format = 'Y-m-d', $max = 'now'));
            $manager->persist($annee_univ[$i]);
        }

        $horaires[$i] = array();
        for ($i = 0; $i < 5; $i++) {
            $horaires[$i] = new Horaire();
            $horaires[$i]->setFin($faker->time($format = 'H:i:s', $max = 'now') );
            $horaires[$i]->setDebut($faker->time($format = 'H:i:s', $max = 'now'));
            $manager->persist($horaires[$i]);
        }

        $jours[$i] = array();
        for ($i = 0; $i < 5; $i++) {
            $jours[$i] = new Jour();
            $jours[$i]->setNomJour($faker->dayOfWeek($max = 'now') );
            $jours[$i]->setDebut($faker->time($format = 'H:i:s', $max = 'now'));
            $manager->persist($jours[$i]);
        }
        
        $Semestres[$i] = array();
        for ($i = 0; $i < 5; $i++) {
            $Semestres[$i] = new Semestre();
            $Semestres[$i]->setCode('S1');
            $Semestres[$i]-> setNiveau($niveaux[$i % 5]);
            $manager->persist($Semestres[$i]);
        }
        $Seances[$i] = array();
        for ($i = 0; $i < 5; $i++) {
            $Seances[$i] = new Seance();
            $Seances[$i]->setSalle($salles[$i % 5]);
            $Seances[$i]->setModule($modules[$i % 5]);
            $Seances[$i]->setHoraire($horaires[$i % 5]);
            
            $manager->persist($Seances[$i]);
        }

        $emplois[$i] = array();
        for ($i = 0; $i < 10; $i++) {
            $emplois[$i] = new Emploi();
            $emplois[$i]->setUser($users[$i % 12]);
            $emplois[$i]->setIntitule($faker->word);
            $emplois[$i]->setDateCreationdate($faker->$format = 'Y-m-d', $max = 'now');
            $emplois[$i]->setDateExpirationdate($faker->$format = 'Y-m-d', $max = 'now');
            $emplois[$i]->setAnneeUniv($annee_univ[$i % 4]);
            $emplois[$i]-> setSemestre($Semestres[$i % 4]);
            $manager->persist($emplois[$i]);
        }

        $manager->flush();
    }
}
