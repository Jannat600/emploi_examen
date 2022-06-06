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

        for ($i = 0; $i < 10; $i++) {
            $filieres[$i] = new Filiere();
            $filieres[$i]->setIntitule(($faker->word));

            $manager->persist($filieres[$i]);
        }
        $niveaux[$i] = array();
        for ($i = 0; $i < 15; $i++) {
            $niveaux[$i] = new Niveau();
            $niveaux[$i]->setIntitule($faker->word);
            $niveaux[$i]->setFiliere($filieres[$i % 5]);
            $manager->persist($niveaux[$i]);
        }


        $upfiens = array();
        $statuts = array('Professeur', 'Etudiant');
        for ($i = 0; $i < 15; $i++) {
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
            $users[$i]->setUpfien($upfiens[$i]);
            $users[$i]->setEmail($faker->email);
            $users[$i]->setRoles(['ROLE_VIEWER']);
            
            $manager->persist($users[$i]);
        }

       
        $salles = array();
        for ($i = 0; $i < 13; $i++) {
            $salles[$i] = new Salle();
            $salles[$i]->setCode('A28');
            $manager->persist($salles[$i]);
        }

        
        
        $modules[$i] = array();
        for ($i = 0; $i < 15; $i++) {
            $modules[$i] = new Module();
            $modules[$i]->setIntitule($faker->word);
            $manager->persist($modules[$i]);
        }

        $annee_univ[$i] = array();
        for ($i = 0; $i < 12; $i++) {
            $annee_univ[$i] = new AnneeUniv();
            $annee_univ[$i]->setAnneeFin(date_create(($faker->date($format = 'Y-m-d', $max = 'now'))));
            $annee_univ[$i]->setAnneeDebut(date_create(($faker->date($format = 'Y-m-d', $max = 'now'))));
            $manager->persist($annee_univ[$i]);
        }

        $horaires[$i] = array();
        for ($i = 0; $i < 12; $i++) {
            $horaires[$i] = new Horaire();
            $horaires[$i]->setFin(date_create($faker->time($format = 'H:i:s', $max = 'now')) );
            $horaires[$i]->setDebut(date_create($faker->time($format = 'H:i:s', $max = 'now')));
            $manager->persist($horaires[$i]);
        }

        $Semestres[$i] = array();
        for ($i = 0; $i < 15; $i++) {
            $Semestres[$i] = new Semestre();
            $Semestres[$i]->setCode('S1');
            $Semestres[$i]-> setNiveau($niveaux[$i % 5]);
            $manager->persist($Semestres[$i]);
        }
        $Seances[$i] = array();
        for ($i = 0; $i < 12; $i++) {
            $Seances[$i] = new Seance();
            $Seances[$i]->setSalle($salles[$i]);
            $Seances[$i]->setModule($modules[$i]);
            $Seances[$i]->setHoraire(($horaires[$i]));
            
            $manager->persist($Seances[$i]);
        }

        $emplois[$i] = array();
        for ($i = 0; $i < 12; $i++) {
            $emplois[$i] = new Emploi();
            $emplois[$i]->setUser($users[$i]);
            $emplois[$i]->setIntitule($faker->word);
            $emplois[$i]->setDateCreation(date_create(($faker->date($format = 'Y-m-d', $max = 'now'))));
            $emplois[$i]->setDateExpiration(date_create(($faker->date($format = 'Y-m-d', $max = 'now'))));
            $emplois[$i]->setAnneeUniv($annee_univ[$i]);
            $emplois[$i]-> setSemestre($Semestres[$i]);
            $manager->persist($emplois[$i]);
        }
        $jours[$i] = array();
        for ($i = 0; $i < 12; $i++) {
            $jours[$i] = new Jour();
            $jours[$i]->setNomJour($faker->dayOfWeek($max = 'now') );
            $jours[$i]->setEmploi($emplois[$i] );
            $manager->persist($jours[$i]);
        }
        

        $manager->flush();
    }
}
