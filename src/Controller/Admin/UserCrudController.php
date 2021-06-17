<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Auto;
use Doctrine\DBAL\Types\IntegerType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            EmailField::new('email'),
            ArrayField::new('roles', 'Роли'),
            TextField::new('name'),
            TextField::new('midName'),
            TextField::new('surname'),
            DateTimeField::new('dateDriver')->setFormat('dd.MM.YYYY')->renderAsNativeWidget(),
            TextField::new('adressDriver'),
            IntegerField::new('expDriver'),
            BooleanField::new('genderDriver'),
            NumberField::new('KBM'),
            AssociationField::new('autos'),

        ];
    }

}
return [


];