<?php

namespace App\Controller\Admin;

use App\Entity\Questions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuestionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Questions::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')
                ->onlyOnIndex();
            yield TextField::new('name');
            yield Field::new('votes', 'Total Votes');
            yield Field::new('createdAt');
                // ->hideOnForm();
    }
   
}
