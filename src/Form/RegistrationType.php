<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, 
                $this->setFieldConf('Prénom', 'Entrez un prénom'))
            ->add('lastname', TextType::class, 
                $this->setFieldConf('Nom', 'Entrez un nom'))
            ->add('avatar')
            ->add('username', TextType::class, 
                $this->setFieldConf('Nom utilisateur', 'Entrez un nom d\'utilisateur'))
            ->add('email')
            ->add('hash')
            ->add('introduction', TextareaType::class,
                $this->setFieldConf('Presentation de l\'utilisateur', ''))
            ->add('description', TextareaType::class,
                $this->setFieldConf('Description de l\'utilisateur', ''))
            ->add('slug')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
