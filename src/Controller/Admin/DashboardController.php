<?php

namespace App\Controller\Admin;

use App\Entity\AnneeUniv;
use App\Entity\Emploi;
use App\Entity\Horaire;
use App\Entity\Seance;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
 use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct( private AdminUrlGenerator $adminUrlGenerator)
    {

    }
    #[Route('/', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
        ->setController(EmploiCrudController::class)
        ->generateUrl();
        return $this->redirect($url);

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion Emplois du temps');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Administrateurs', 'fa fa-user');
        yield MenuItem::Submenu('Options', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Nouveau', 'fa fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
        ]);
       
    
        yield MenuItem::section('Emplois du Temps', 'fa fa-calendar');
        yield MenuItem::Submenu('Options', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Nouveau', 'fa fa-plus', Emploi::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste Emplois', 'fa fa-eye', Emploi::class)
        
        ]);
       
        yield MenuItem::section('Horaires', 'fa fa-clock');
        yield MenuItem::Submenu('Options', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Nouveau', 'fa fa-plus',Horaire::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste Horaires', 'fa fa-eye', Horaire::class)
        ]);

        yield MenuItem::section('Années Universitaires', 'fa fa-clock');
        yield MenuItem::Submenu('Options', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Nouveau', 'fa fa-plus',AnneeUniv::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste', 'fa fa-eye', AnneeUniv::class)
        ]);



        
    }
}
