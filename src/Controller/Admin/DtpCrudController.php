<?php

namespace App\Controller\Admin;

use App\Entity\Dtp;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DtpCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dtp::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateTimeField::new('date_dtp')->setFormat('dd.MM.YYYY')->renderAsNativeWidget(),
            TextField::new('description'),
            TextField::new('adress_dtp'),
            TextField::new('degree'),
            BooleanField::new('initiator'),
            AssociationField::new('users'),
            AssociationField::new('autos'),

        ];
    }
}
