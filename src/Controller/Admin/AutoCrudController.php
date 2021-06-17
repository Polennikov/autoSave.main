<?php

namespace App\Controller\Admin;

use App\Entity\Auto;
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

class AutoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Auto::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('marka','Марка'),
            TextField::new('model', 'Модель'),
            TextField::new('vin','ВИН'),
            TextField::new('number','Номер'),
            TextField::new('color','Цвет'),
            NumberField::new('year','Год'),
            NumberField::new('power','Мощность'),
            NumberField::new('mileage','Пробег'),
            TextField::new('category','Категория'),
            AssociationField::new('users','Пользователь'),
            TextField::new('number_sts','Номер стс'),

        ];
    }
}
