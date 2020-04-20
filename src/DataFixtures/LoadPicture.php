<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LoadPicture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $pictures = [
            'title' => 'picture n°',
            'url' => 'https://i.picsum.photos/id/',
            'caption' => 'description for picture n°',
        ];

        for ($i = 1; $i <= 50 ; $i++) {

            $picture = new Picture;
            $title = $pictures['title'].$i;
            $picture->setTitle($title);
            $picture->setUrl($pictures['url'].mt_rand(1, 500).'/300/300.jpg');
            $picture->setCaption('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam, voluptate.');
            $picture->setAdvertisement($this->getReference('annonce '.mt_rand(1, 5)));
            $manager->persist($picture);
    
            $manager->flush();
        }
    }
}
