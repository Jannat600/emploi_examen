<?php

namespace App\Controller\Admin;

use App\Entity\Jour;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class JourCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Jour::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new(propertyName:'nom_jour', label:'Jour'),
            AssociationField::new(propertyName:'emploi')
        ];
    }
    
    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add('intitule');
        
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural(label: 'Emplois')
        ->setEntityLabelInSingular(label: 'Emploi')
        ->setDefaultSort(sortFieldsAndOrder:['updated_at'=>'desc']);

    }
   
}
