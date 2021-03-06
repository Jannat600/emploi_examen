<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        IdField::new('id');
        return [
            TextField::new(propertyName:'username', label:'Utilisateur'),
            EmailField::new(propertyName:'email', label:'Adresse Mail'),
            ArrayField::new(propertyName:'roles', label:'Role'),
            CollectionField::new(propertyName:'emplois', label:'Emplois'),
           
           

        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add('roles');
        
    }
    public function configureCrud(Crud $crud): Crud
    {
        
        return $crud
        ->setEntityLabelInPlural(label: 'Utilisateur')
        ->setEntityLabelInSingular(label: 'Utilisateurs')
        ->setDefaultSort(sortFieldsAndOrder:['id'=>'desc']);

    }
   
}
