<?php

namespace App\DataFixtures;

use App\Entity\Advertisement;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LoadAdvertisement extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $advertisements = [
            [
                'Title' => 'annonce 1',
                'CoverImage' => 'https://picsum.photos/200/300',
                'Introduction' => 'Une intro',
                'Content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum saepe sint adipisci in eveniet ex corporis aliquid natus quas dolores.'
            ],
            [
                'Title' => 'annonce 2',
                'CoverImage' => 'https://picsum.photos/200/300',
                'Introduction' => 'Une intro',
                'Content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto quos, assumenda inventore nobis necessitatibus a.'
            ],
            [
                'Title' => 'annonce 3',
                'CoverImage' => 'https://picsum.photos/200/300',
                'Introduction' => 'Une intro',
                'Content' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sint cum inventore ex pariatur itaque? Deserunt omnis nesciunt ab assumenda rem.'
            ],
            [
                'Title' => 'annonce 4',
                'CoverImage' => 'https://picsum.photos/200/300',
                'Introduction' => 'Une intro',
                'Content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et ipsam ea ex cum, voluptatibus in hic sint quibusdam ducimus doloribus natus facilis alias esse tempora.'
            ],
            [
                'Title' => 'annonce 5',
                'CoverImage' => 'https://picsum.photos/200/300',
                'Introduction' => 'Une intro',
                'Content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Incidunt temporibus accusantium cumque accusamus.'
            ]
        ];

        foreach ($advertisements as $ad) {
            $advertisement = new Advertisement();
            
            $advertisement->setTitle($ad['Title'])
               ->setCoverImage($ad['CoverImage'])
               ->setIntroduction($ad['Introduction'])
               ->setContent($ad['Content'])
               ->setPrice(mt_rand(50, 300))
               ->setRooms(mt_rand(1, 6));
            
            $manager->persist($advertisement);

            $this->addReference($ad['Title'], $advertisement);

        }


        $manager->flush();
    }
}
