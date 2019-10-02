<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // for($i=0; $i<8; $i++){
        //     $category = new Category();
        //     $category->setName('cat'.$i);
        //     $manager->persist($category);
        // }
        
        $manager->flush();
    }
}
