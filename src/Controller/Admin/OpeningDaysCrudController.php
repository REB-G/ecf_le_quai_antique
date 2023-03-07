<?php

namespace App\Controller\Admin;

use App\Entity\OpeningDays;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class OpeningDaysCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningDays::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Jour d\'ouverture')
            ->setEntityLabelInPlural('Jours d\'ouverture')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ->setDefaultSort(['id' => 'ASC']);
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('day', 'Jour d\'ouverture'),
            AssociationField::new('service', 'Service assurés'),
        ];
    }
}
