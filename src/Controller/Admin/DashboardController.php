<?php

namespace App\Controller\Admin;

use App\Entity\Emploi;
use App\Entity\Seance;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
 use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct( private AdminUrlGenerator $adminUrlGenerator)
    {

    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
        ->setController(EmploiCrudController::class)
        ->generateUrl();
        return $this->redirect($url);


        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());






        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Emploi Examen');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
    
        yield MenuItem::section('Emplois du Temps');
        yield MenuItem::Submenu('Options', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Nouveau', 'fa fa-plus', Emploi::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste Emplois', 'fa fa-eye', Emploi::class)
        
        ]);
        yield MenuItem::section('Administrateurs');
        yield MenuItem::Submenu('Options', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Nouveau', 'fa fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
        ]);
        yield MenuItem::section('Seance');
        yield MenuItem::Submenu('Options', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Nouveau', 'fa fa-plus',Seance::class)->setAction(Crud::PAGE_NEW),
        ]);
    }
}
