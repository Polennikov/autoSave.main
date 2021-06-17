<?php

namespace App\Controller\Admin;

use App\Entity\BookKBC;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookKBCCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BookKBC::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('age','возраст'),
            TextField::new('yearOneMin', 'менее 1 года'),
            TextField::new('yearOne','1 год'),
            TextField::new('yearTwo', '2 года'),
            TextField::new('yearThree','3-5 лет'),
            TextField::new('yearFive', '5-7 лет'),
            TextField::new('yearSeven','7-9 лет'),
            TextField::new('yearTen', '10-14 лет'),
            TextField::new('yearFivten', 'более 15 лет'),
        ];
    }

}
