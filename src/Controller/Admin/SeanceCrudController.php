<?php

namespace App\Controller\Admin;

use App\Entity\Seance;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class SeanceCrudController extends AbstractCrudController
{

    public const ACTION_DUPLICATE = 'Duplicate';
    public static function getEntityFqcn(): string
    {
        return Seance::class;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance instanceof Seance) return;
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('module'),
            AssociationField::new('horaire'),
            AssociationField::new('salle'),
            AssociationField::new('professeur'),
            AssociationField::new('jour'),

        ];
    }
    public function configureActions(Actions $actions ) : Actions 
    {
     $duplicate= Action::new(self::ACTION_DUPLICATE)
     ->linkToCrudAction('duplicateEmploi')
     ->setCssClass('btn btn-info');

     return $actions
     ->add(Crud::PAGE_EDIT, $duplicate);
    }
    
    public function duplicateSeance(AdminContext $adminContext, EntityManagerInterface $em, AdminUrlGenerator $adminUrlGenerator ): Response
    {
        /** @var Seance $seance*/
        $seance = $adminContext->getEntity()->getInstance();
        $duplicateseance= clone $seance;
        parent:: persistEntity($em, $duplicateseance);

        $url = $adminUrlGenerator->setController(self::class)
        ->setAction(Action::DETAIL)
        ->setEntityId($duplicateseance->getId())
        ->generateUrl();

        return $this->redirect($url);

    }
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance instanceof Seance) return;
        parent::updateEntity($entityManager, $entityInstance);
        
    }
   
}
