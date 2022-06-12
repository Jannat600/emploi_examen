<?php

namespace App\Form;

use App\Entity\Horaire;
use App\Entity\Jour;
use App\Entity\Module;
use App\Entity\Salle;
use App\Entity\Seance;
use App\Entity\Upfien;
use App\Repository\JourRepository;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,DateType,MoneyType,BirthdayType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;


class SeanceType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        
        $builder
            ->add(child:'Module',type: EntityType::class, options: ['label'=>'Module','class'=>Module::class,

            'choice_label'=>'intitule'])
            ->add(child:'Horaire',type: EntityType::class, options: ['label'=>'Horaire','class'=>Horaire::class])
            ->add(child:'Professeur',type: EntityType::class, options: ['label'=>'Professeur','class'=>Upfien::class, 'choice_label'=>'nom'])
            ->add(child:'Salle',type: EntityType::class, options: ['label'=>'Salle','class'=>Salle::class, 'choice_label'=>'code'])
            ->add(child:'Jour',type: EntityType::class, options: ['label'=>'Jour','class'=>Jour::class,
            'query_builder' => function (JourRepository $jr) {
                return $jr->createQueryBuilder('j')
                    ->select( 'j' )
                    ->orderBy('j.id', 'DESC')
                    ->setMaxResults(6);
            }, 'choice_label'=>'nom_jour'])
            ;
       
    }
     
    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefault(option: 'data_class', value:Seance::class);

            }
}