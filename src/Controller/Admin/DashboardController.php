<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {}
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(ProductCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Site');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('E_commerce');
        yield MenuItem::section('Products');
        yield MenuItem::subMenu('Action', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Product','fas fa-plus',Product::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Products','fas fa-eye',Product::class)
        ]);

        yield MenuItem::subMenu('Categorie', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Category','fas fa-plus',Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Categories','fas fa-eye',Category::class)
        ]);
    }
}
