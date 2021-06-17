<?php

namespace App\Controller\Admin;

use App\Entity\BookKT;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookKTCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BookKT::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('region','Регион'),
            TextField::new('index', 'Индекс'),
        ];
    }

}
