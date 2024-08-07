<?php
namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
// DECOMMENTER POUR LA VARIANTE ORM
// use Faker\ORM\Doctrine\Populator;
// use Doctrine\ORM\Mapping\Entity;

class AppFixtures extends Fixture
{
    private const NB_ARTICLES = 100;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $categories = [];

        // GENERATION DES CATEGORIES
        for ($i = 0; $i < 4; $i++) {
            // nouvelles instances de Category
            $category = new Category();
            $category->setName($faker->word());

            // on les persist pour les envoyer dans la bdd
            $manager->persist($category);
            // on stocke les categories dans cette array
            $categories[] = $category;
        }

        // GENERATION DES ARTICLES
        for ($i = 0; $i < self::NB_ARTICLES; $i++){
            $article = new Article;
            $article
                ->setTitle($faker->sentence())
                ->setContent($faker->text())
                ->setCreatedAt($faker->dateTime())
                ->setVisible($faker->boolean())
                // ici on attribue une catégorie aléatoirement à chaque article depuis la liste de Categories
                ->setCategory($categories[random_int(0, count($categories) - 1)]);
            $manager->persist($article);
        };
        $manager->flush(); // communication avec la bdd
        
        // EXEMPLE DE ORM INTEGRATION AVEC DOCTRINE
        //
        // $generator = Factory::create();
        // $populator = new Populator($generator, $manager);
        // $populator->addEntity(Article::class,10);
        // $populator->execute();

    }
}
