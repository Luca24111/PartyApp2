<?php

namespace App\Controller\Admin;

use App\Entity\Payer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PayerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Payer::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
