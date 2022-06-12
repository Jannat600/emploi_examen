<?php

namespace App\Controller\Admin;

use App\Entity\Emploi;
use App\Form\JourType;
use App\Form\SeanceType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class EmploiCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Emploi::class;
    }

    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }


    public const ACTION_DUPLICATE = 'Duplicate';

    
    public function configureFields(string $pageName): iterable
    {
        IdField::new('id')->hideOnForm();
        return [
            TextField::new('intitule'),
            DateTimeField::new('date_creation')->hideOnForm(),
            DateTimeField::new('date_expiration'),
            DateTimeField::new(propertyName:'updated_at', label: 'Dernière mise à jour')->hideOnForm(),
            AssociationField::new(propertyName:'user', label: 'Admin'),
            AssociationField::new(propertyName:'annee_univ', label: 'Année Universitaire'),
            AssociationField::new(propertyName:'semestre', label: 'Semestre'),
            CollectionField::new(propertyName:'jour', label:'Jours')
             ->setTemplatePath('admin/emploi/jour.html.twig')
            ->setEntryIsComplex(isComplex:true)
            ->setEntryType(formTypeFqcn:JourType::class)
            ->setTemplatePath('admin/emploi/jour.html.twig'),
            CollectionField::new(propertyName:'seances', label:'Séances')
            ->setTemplatePath('admin/emploi/seance.html.twig')
            ->setEntryIsComplex(isComplex:true)
            ->setEntryType(formTypeFqcn:SeanceType::class)
            ->setTemplatePath('admin/emploi/seance.html.twig')
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
        ->setDefaultSort(sortFieldsAndOrder:['date_creation'=>'desc']);

    }

        // public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
        // {
        //     if(!$entityInstance instanceof Emploi) return;
        //     $entityInstance->setDateCreation(new \DateTimeImmutable);
        //     parent::persistEntity($entityManager, $entityInstance);
        // }

        public function configureActions(Actions $actions ) : Actions 
        {

        $url = $this->adminUrlGenerator
            ->setController(SeanceCrudController::class)
            ->setAction(Action::NEW)
            ->generateUrl();

         $duplicate= Action::new(self::ACTION_DUPLICATE)
         ->linkToCrudAction('duplicateEmploi')
         ->setCssClass('btn btn-info');

         return $actions
         ->add(Crud::PAGE_EDIT, $duplicate)
         ->add(Crud::PAGE_NEW,Action:: SAVE_AND_CONTINUE)
         ->add(Crud::PAGE_INDEX, Action:: DETAIL );




        }

        // public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
        // {
        //     if(!$entityInstance instanceof Emploi) return;
        //     $entityInstance->setUpdatedAt(new \DateTimeImmutable);
        //     parent::updateEntity($entityManager, $entityInstance);
            
        // }
    
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
