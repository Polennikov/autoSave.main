<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Auto;
use App\Entity\Contract;
use App\Entity\Dtp;
use App\Entity\BookTB;
use App\Entity\BookKBM;
use App\Entity\BookKBC;
use App\Entity\BookKT;
use App\Entity\BookKP;
use App\Entity\BookKC;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdFiel;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin_app")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted(
            'ROLE_SUPER_ADMIN',
            $this->getUser(),
            'У вас нет доступа к этой странице'
        );

        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        $url = $routeBuilder->setController(UserCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Main Service');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Административная панель', 'fa fa-home');
        yield MenuItem::linkToCrud('Пользователи', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Автомобили', 'fas fa-users', Auto::class);
        yield MenuItem::linkToCrud('Договоры', 'fas fa-users', Contract::class);
        yield MenuItem::linkToCrud('ДТП', 'fas fa-users', Dtp::class);
        yield MenuItem::linkToCrud('Справочник КБМ', 'fas fa-users', BookKBM::class);
        yield MenuItem::linkToCrud('Справочник КБC', 'fas fa-users', BookKBC::class);
        yield MenuItem::linkToCrud('Справочник КС', 'fas fa-users', BookKC::class);
        yield MenuItem::linkToCrud('Справочник КТ', 'fas fa-users', BookKT::class);
        yield MenuItem::linkToCrud('Справочник ТБ', 'fas fa-users', BookTB::class);
        yield MenuItem::linkToCrud('Справочник КП', 'fas fa-users', BookKP::class);

    }
}
