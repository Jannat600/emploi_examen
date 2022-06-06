<?php

namespace App\Controller\Admin;

use App\Entity\Emploi;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

class EmploiCrudController extends AbstractCrudController
{

    public const ACTION_DUPLICATE = 'Duplicate';
    public static function getEntityFqcn(): string
    {
        return Emploi::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('intitule'),
            DateTimeField::new('date_creation')->hideOnForm(),
            DateTimeField::new('date_expiration'),
        ];
    }

        // public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
        // {
        //     if(!$entityInstance instanceof Emploi) return;
        //     $entityInstance->setDateCreation(new \DateTimeImmutable);
        //     parent::persistEntity($entityManager, $entityInstance);
        // }

        public function configureActions(Actions $actions ) : Actions 
        {
         $duplicate= Action::new(self::ACTION_DUPLICATE)
         ->linkToCrudAction('duplicateEmploi')
         ->setCssClass('btn btn-info');

         return $actions
         ->add(Crud::PAGE_EDIT, $duplicate);
        }

        public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
        {
            if(!$entityInstance instanceof Emploi) return;
            $entityInstance->setDateCreation(new \DateTimeImmutable);
            parent::updateEntity($entityManager, $entityInstance);
            
        }
    
        public function duplicateEmploi(AdminContext $adminContext, EntityManagerInterface $em, AdminUrlGenerator $adminUrlGenerator ): Response
        {
            /** @var Emploi $emploi*/
            $emploi = $adminContext->getEntity()->getInstance();
            $duplicateemploi= clone $emploi;
            parent:: persistEntity($em, $duplicateemploi);

            $url = $adminUrlGenerator->setController(self::class)
            ->setAction(Action::DETAIL)
            ->setEntityId($duplicateemploi->getId())
            ->generateUrl();

            return $this->redirect($url);

        }
        public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
        {
            if(!$entityInstance instanceof Emploi) return;
          foreach ($entityInstance->getSeances() as $seance) {
            $entityManager->remove($seance);
          } 
          foreach ($entityInstance->getJour() as $jour) {
            $entityManager->remove($jour);
          }
          parent::deleteEntity($entityManager, $entityInstance);
        }
}
