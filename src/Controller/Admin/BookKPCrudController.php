<?php

namespace App\Controller\Admin;

use App\Entity\BookKP;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookKPCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BookKP::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('period','Период'),
            TextField::new('index', 'Индекс'),
        ];
    }

}
