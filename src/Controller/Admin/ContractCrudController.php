<?php

namespace App\Controller\Admin;

use App\Entity\Contract;
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

class ContractCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contract::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('date_start')->setFormat('dd.MM.YYYY')->renderAsNativeWidget(),
            DateTimeField::new('date_end')->setFormat('dd.MM.YYYY')->renderAsNativeWidget(),
            TextField::new('amount'),
            TextField::new('purpose'),
            NumberField::new('status'),
            TextField::new('agent_id'),
            BooleanField::new('trailer'),
            NumberField::new('marks'),
            AssociationField::new('auto'),
            DateTimeField::new('date_start_one')->setFormat('dd.MM.YYYY')->renderAsNativeWidget(),
            DateTimeField::new('date_end_one')->setFormat('dd.MM.YYYY')->renderAsNativeWidget(),
            DateTimeField::new('date_start_two')->setFormat('dd.MM.YYYY')->renderAsNativeWidget(),
            DateTimeField::new('date_end_two')->setFormat('dd.MM.YYYY')->renderAsNativeWidget(),
            DateTimeField::new('date_start_three')->setFormat('dd.MM.YYYY')->renderAsNativeWidget(),
            DateTimeField::new('date_end_three')->setFormat('dd.MM.YYYY')->renderAsNativeWidget(),
            TextField::new('diagnostic_card'),
            BooleanField::new('non_limited'),



        ];
    }
}
