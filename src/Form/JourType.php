<?php

namespace App\Form;

use App\Entity\Horaire;
use App\Entity\Jour;
use App\Entity\Module;
use App\Entity\Salle;
use App\Entity\Seance;
use App\Entity\Upfien;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,DateType,MoneyType,BirthdayType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class JourType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add(child:'nom_jour',type: TextType::class, options: ['label'=>'Jour']);
            }
     
    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefault(option: 'data_class', value:Jour::class);

            }
}