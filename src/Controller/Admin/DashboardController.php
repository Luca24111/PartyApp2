<?php

namespace App\Controller\Admin;

use App\Entity\Questions;
use App\Entity\Answer;
use App\Entity\Payer;
use App\Entity\Topic;
use App\Entity\User;
use App\Repository\PayerRepository;
use App\Repository\QuestionsRepository;
use App\Repository\TopicRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted as AttributeIsGranted;

class DashboardController extends AbstractDashboardController
{
    // #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
     
    public function index(): Response
    {
        
        $latestPayer = $this->payerRepository
            ->findBy(
                array('id'=>'ASC'),
        );

        return $this->render('admin/admin.html.twig', [
            'latestPayer' => $latestPayer,
            
        ]);

        

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
            ->setTitle('Party App');
    } 

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        // yield MenuItem::linkToCrud('Questions', 'fa fa-question-circle', Questions::class);
        // yield MenuItem::linkToCrud('Answers', 'fas fa-comments', Answer::class);
        // yield MenuItem::linkToCrud('Topics', 'fas fa-folder', Topic::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
        // yield MenuItem::section('Content');
        yield MenuItem::linkToCrud('Payers', 'fas fa-dollar', Payer::class);
        yield MenuItem::linkToUrl('Homepage', 'fas fa-home', $this->generateUrl('app_home'));
        // yield MenuItem::linkToUrl('StackOverflow', 'fab fa-stack-overflow', 'https://stackoverflow.com');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->setPermission(Action::EDIT, 'ROLE_SUPER_ADMIN')
            ->update(Crud::PAGE_DETAIL, Action::EDIT, static function (Action $action) {
                return $action->setIcon('fa fa-edit');
            })
            ->update(Crud::PAGE_DETAIL, Action::INDEX, static function (Action $action) {
                return $action->setIcon('fa fa-list');
            });
            
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
        ->addMenuItems([
            MenuItem::linkToUrl('My Profile', 'fas fa-user', $this->generateUrl('app_user'))
        ]); 
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->setDefaultSort([
                'id' => 'DESC',
            ])
            ->overrideTemplate('crud/field/id', 'admin/field/id_icon.html.twig');
    }

    private PayerRepository $payerRepository;
    public function __construct(PayerRepository $payerRepository)
    {
        $this->payerRepository = $payerRepository;
    } 
    
    

}

    
