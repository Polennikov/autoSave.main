<?php

namespace App\Controller\Admin;

use App\Entity\BookTB;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class BookTBCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BookTB::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('category','Категория'),
            TextField::new('index', 'Индекс'),
        ];
    }

}
