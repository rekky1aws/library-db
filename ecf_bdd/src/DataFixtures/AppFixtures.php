<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Borrow;
use App\Entity\Borrower;
use App\Entity\Genre;
use App\Entity\Role;
use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');

        $this->loadAuthors($manager, $faker);
        $this->loadGenres($manager, $faker);
    }

    public function loadAuthors(ObjectManager $manager, FakerGenerator $faker): void
    {
        // Authors
        $authorDatas = [
            [
                'lastname' => 'auteur inconnu',
                'firstname' => ''
            ],
            [
                'lastname' => 'Cartier',
                'firstname' => 'Hugues'
            ],
            [
                'lastname' => 'Lambert',
                'firstname' => 'Armand'
            ],
            [
                'lastname' => 'Moitessier',
                'firstname' => 'Thomas'
            ]
        ];

        foreach ($authorDatas as $authorData) {
            $author = new Author();
            $author->setLastname($authorData['lastname']);
            $author->setFirstname($authorData['firstname']);

            $manager->persist($author);
        }

        // 500 auteurs dont les données sont générées aléatoirement.
        for ($i = 0; $i < 500; $i++) {
            $author = new Author();
            $author->setLastname($faker->lastName());
            $author->setFirstname($faker->firstName());

            $manager->persist($author);
        }

        $manager->flush();
    }

    /*
    | id | nom              | description |
    |----|------------------|-------------|
    | 1  | poésie           | NULL        |
    | 2  | nouvelle         | NULL        |
    | 3  | roman historique | NULL        |
    | 4  | roman d'amour    | NULL        |
    | 5  | roman d'aventure | NULL        |
    | 6  | science-fiction  | NULL        |
    | 7  | fantasy          | NULL        |
    | 8  | biographie       | NULL        |
    | 9  | conte            | NULL        |
    | 10 | témoignage       | NULL        |
    | 11 | théâtre          | NULL        |
    | 12 | essai            | NULL        |
    | 13 | journal intime   | NULL        |
    */
    public function loadGenres(ObjectManager $manager, FakerGenerator $faker): void
    {
        // Authors
        $genreDatas = [
            [
                'name' => 'poésie'
            ],
            [
                'name' => 'nouvelle'
            ],
            [
                'name' => 'roman historique'
            ],
            [
                'name' => 'roman d\'amour'
            ],
            [
                'name' => 'roman d\'aventure'
            ],
            [
                'name' => 'science-fiction'
            ],
            [
                'name' => 'fantasy'
            ],
            [
                'name' => 'biographie'
            ],
            [
                'name' => 'conte'
            ],
            [
                'name' => 'témoignage'
            ],
            [
                'name' => 'théâtre'
            ],
            [
                'name' => 'essai'
            ],
            [
                'name' => 'journal intime'
            ],
        ];

        foreach ($genreDatas as $genreData) {
            $genre = new Genre();
            $genre->setName($genreData['name']);
            $genre->setDescription("");

            $manager->persist($genre);
        }

        $manager->flush();
    }
}
