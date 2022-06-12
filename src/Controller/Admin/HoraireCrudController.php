<?php

namespace App\Controller\Admin;

use App\Entity\Horaire;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class HoraireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaire::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        IdField::new('id');
        return [
            TimeField::new(propertyName:'debut', label:'Heure de début'),
            TimeField::new(propertyName:'fin', label:'Heure de fin'),
           
           

        ];
    }

    // public function configureFilters(Filters $filters): Filters
    // {
    //     return $filters->add('roles');
        
    // }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural(label: 'Horaire')
        ->setEntityLabelInSingular(label: 'Horaires')
        ->setDefaultSort(sortFieldsAndOrder:['id'=>'desc']);

    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add('debut');
        return $filters->add('fin');
        
    }

  

}
