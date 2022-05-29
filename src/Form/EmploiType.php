<?php

namespace App\Form;

use App\Entity\Emploi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmploiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule')
            ->add('date_creation')
            ->add('date_expiration')
            ->add('user')
            ->add('semestre')
            ->add('annee_univ')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emploi::class,
        ]);
    }
}
