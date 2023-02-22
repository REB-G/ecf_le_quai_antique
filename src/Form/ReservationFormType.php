<?php

namespace App\Form;

use App\Entity\Reservation;
use Doctrine\DBAL\Types\TimeImmutableType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reservationDate', DateTimeType::class, [
                'label' => 'Date de la réservation',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'placeholder' => 'Date de la réservation',
                    'class' => '',
                ],
            ])
            ->add('reservationTime', TimeImmutableType::class, [
                'label' => 'Heure de la réservation',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'placeholder' => 'Heure de la réservation',
                    'class' => '',
                ],
            ])
            ->add('numberOfGuests', IntegerType::class, [
                'label' => 'Nombre de personnes',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'placeholder' => 'Nombre de personnes',
                    'class' => '',
                ],
            ])
            ->add('user', EntityType::class, [
                'class' => Users::class,
                'choice_label' => 'name',
                'label' => 'Utilisateur',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'placeholder' => 'Utilisateur',
                    'class' => '',
                ],
            ])
            ->add('restaurantTable', EntityType::class, [
                'class' => RestaurantTable::class,
                'choice_label' => 'name',
                'label' => 'Table',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'placeholder' => 'Table',
                    'class' => '',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
