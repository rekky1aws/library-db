<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Borrow;
use App\Entity\Borrower;
use App\Entity\Genre;
use App\Entity\Role;
use App\Entity\User;

use DateTimeImmutable;
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
        // $this->loadBorrows($manager, $faker);
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

    public function loadGenres(ObjectManager $manager, FakerGenerator $faker): void
    {
        // Genres
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

    /*     
    | id | nom | prenom | tel       | actif | created_at        | updated_at        | user_id |
    |----|-----|--------|-----------|-------|-------------------|-------------------|---------|
    | 1  | foo | foo    | 123456789 | true  | 20200101 10:00:00 | 20200101 10:00:00 | 2       |
    | 2  | bar | bar    | 123456789 | false | 20200201 11:00:00 | 20200501 12:00:00 | 3       |
    | 3  | baz | baz    | 123456789 | true  | 20200301 12:00:00 | 20200301 12:00:00 | 4       |

    Données de test : */

    public function loadBorrows(ObjectManager $manager, FakerGenerator $faker): void
    {
        // Borrowers
        $borrowerDatas = [
            [
                'lastname' => 'foo',
                'firstname' => 'foo',
                'phone_number' => '123456789',
                'active' => true,
                'created_at' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2020-01-01 10:00:00'),
                'update_at' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2020-01-01 10:00:00'),
                'user' => 0
            ],
        ];

        foreach ($borrowerDatas as $borrowerData) {
            $borrower = new Borrower();
            $borrower->setLastname($borrowerData['lastname']);
            $borrower->setFirstname($borrowerData['firstname']);

            $manager->persist($borrower);
        }

        // 100 emprunteurs dont les données sont générées aléatoirement.
        for ($i = 0; $i < 500; $i++) {
            $borrower = new Borrower();
            $borrower->setLastname($faker->lastName());
            $borrower->setFirstname($faker->firstName());

            $manager->persist($borrower);
        }

        $manager->flush();
    }
}
