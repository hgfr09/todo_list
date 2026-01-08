<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Task;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // Création des catégories
        $cats = [];
        for ($i = 0; $i < 5; $i++) {
            $category = new Category;
            $category->setNom('Catégorie ' . ($i + 1));
            $cats[] = $category;

            $manager->persist($category);
        }

        // Création des tâches
        for ($i = 0; $i < 10; $i++) {
            $task = new Task;
            $task->setTitle('Tâche ' . ($i + 1));
            $task->setIsDone(false);
            $task->setCreatedAt(new DateTimeImmutable());
            $catIndx = array_rand($cats);
            $task->setCategory($cats[$catIndx]);

            $manager->persist($task);
        }
        $manager->flush();
    }
}
