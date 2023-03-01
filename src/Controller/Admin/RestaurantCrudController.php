<?php

namespace App\Controller\Admin;

use App\Entity\Restaurant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Restaurant::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Restaurant')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ->setDefaultSort(['id' => 'ASC']);
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('name', 'Nom du restaurant'),
            TextField::new('phoneNumber', 'Numéro de téléphone'),
            IntegerField::new('nbrTotalOfPlaces', 'Nombre total de places'),
            TextField::new('openingDays', 'Jours d\'ouverture'),
            TextField::new('openingHours', 'Heures d\'ouverture'),
        ];
    }
    
}
