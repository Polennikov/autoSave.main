<?php

namespace App\Controller\Admin;

use App\Entity\BookKBM;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BookKBMCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BookKBM::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('class','Класс'),
            TextField::new('index','индекс'),
            TextField::new('payoutsNull','0 выплат'),
            TextField::new('payoutOne','1 выплат'),
            TextField::new('payoutTwo','2 выплат'),
            TextField::new('payoutThree','3 выплат'),
            TextField::new('payoutFour','4 выплат'),


        ];
    }
}
