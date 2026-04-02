<?php

namespace App\Controller\Admin;

use App\Controller\Admin\CaseGalleryImageCrudController;
use App\Controller\Admin\FaqCrudController;
use App\Controller\Admin\HomeHeroCrudController;
use App\Controller\Admin\LeadCrudController;
use App\Controller\Admin\PackageCrudController;
use App\Controller\Admin\RenovationCaseCrudController;
use App\Controller\Admin\SiteContactCrudController;
use App\Controller\Admin\TestimonialCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Remod — Админпанель')
            ->setFaviconPath('favicon.ico');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Главная', 'fa fa-home');

        yield MenuItem::section('Контент сайта');
        yield MenuItem::linkTo(HomeHeroCrudController::class, 'Hero (Главная)', 'fa fa-image');
        yield MenuItem::linkTo(RenovationCaseCrudController::class, 'Кейсы', 'fa fa-hard-hat');
        yield MenuItem::linkTo(CaseGalleryImageCrudController::class, 'Галерея кейсов', 'fa fa-images');
        yield MenuItem::linkTo(TestimonialCrudController::class, 'Отзывы', 'fa fa-star');
        yield MenuItem::linkTo(PackageCrudController::class, 'Пакеты отделки', 'fa fa-layer-group');
        yield MenuItem::linkTo(FaqCrudController::class, 'FAQ', 'fa fa-question-circle');
        yield MenuItem::linkTo(SiteContactCrudController::class, 'Контакты', 'fa fa-address-book');

        yield MenuItem::section('Заявки');
        yield MenuItem::linkTo(LeadCrudController::class, 'Заявки с сайта', 'fa fa-inbox');
    }
}
