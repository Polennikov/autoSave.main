<?php

namespace App\Controller\Admin;

use App\Entity\BookKC;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookKCCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BookKC::class;
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
