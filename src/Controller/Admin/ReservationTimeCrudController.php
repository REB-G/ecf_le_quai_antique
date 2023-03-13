<?php

namespace App\Controller\Admin;

use App\Entity\ReservationTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReservationTimeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReservationTime::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Heure de réservation possibles')
            ->setEntityLabelInPlural('Heures de réservation possibles')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ->setDefaultSort(['id' => 'ASC']);
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('hour', 'Heure de réservation possible'),
            AssociationField::new('service', 'Service correspondant'),
        ];
    }
}
