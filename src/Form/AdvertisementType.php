<?php

namespace App\Form;

use App\Form\PictureType;
use App\Entity\Advertisement;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdvertisementType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title', TextType::class, 
                $this->setFieldConf('titre de l\'annonce', 'Entrez un titre')
            )
            ->add('price', MoneyType::class,
                $this->setFieldConf('Prix pour une nuit', 'Prix en euros')
            )
            ->add('introduction', TextareaType::class,
            $this->setFieldConf('Phrase d\'accroche', 'Introduction de l\'annonce')
            )
            ->add('content', TextareaType::class,
            $this->setFieldConf('Description du bien', '')
            )
            ->add('coverImage', UrlType::class,
                $this->setFieldConf('Image de couverture', 'lien de l\'image')
            )
            ->add('rooms', IntegerType::class,
                $this->setFieldConf('Nombre de chambre', '')
            )
            ->add(
                'pictures',
                CollectionType::class,
                [
                    'entry_type' => PictureType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advertisement::class,

        ]);
    }
}
