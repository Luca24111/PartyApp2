<?php

namespace App\Controller\Admin;

use App\Entity\Payer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PayerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Payer::class;
    }

}
