<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Teacher;

class TeacherFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // for($i=0; $i<50; $i++){
        //     $teacher = new Teacher();
        //     $teacher->setName('teacher'.$i);
        //     $manager->persist($teacher);
        // }

        $manager->flush();
    }
}
