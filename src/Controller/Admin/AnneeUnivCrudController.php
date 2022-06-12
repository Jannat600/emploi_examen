<?php

namespace App\Controller\Admin;

use App\Entity\AnneeUniv;
use App\Entity\Jour;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class AnneeUnivCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AnneeUniv::class;
    }

    public function configureFields(string $pageName): iterable
    {
        IdField::new('id')->hideOnForm();
        return [
            DateField::new(propertyName:'annee_debut', label:'Début'),
            DateField::new(propertyName:'annee_fin',label:'Fin')
        ];
    }
    
    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add('annee_debut');
        return $filters->add('annee_fin');
        
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural(label: 'Années Universitaires')
        ->setEntityLabelInSingular(label: 'Année Universitaire')
        ->setDefaultSort(sortFieldsAndOrder:['id'=>'desc']);

    }
   
}
