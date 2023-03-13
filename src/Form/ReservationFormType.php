<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReservationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'row_attr' => [
                'class' => 'resa-form__field'
            ],
            'label' => 'Nom',
            'label_attr' => [
                'class' => 'resa-form__label'
            ],
            'attr' => [
                'placeholder' => 'Nom',
                'class' => 'resa-form__field--input',
            ],
        ])
        ->add('firstname', TextType::class, [
            'row_attr' => [
                'class' => 'resa-form__field'
            ],
            'label' => 'Prénom',
            'label_attr' => [
                'class' => 'resa-form__field--label'
            ],
            'attr' => [
                'placeholder' => 'Prénom',
                'class' => 'resa-form__field--input',
            ],
        ])
        ->add('email', EmailType::class, [
            'row_attr' => [
                'class' => 'resa-form__field'
            ],
            'label' => 'Email',
            'label_attr' => [
                'class' => 'resa-form__field--label'
            ],
            'attr' => [
                'placeholder' => 'Email',
                'class' => 'resa-form__field--input',
            ],
        ])
        ->add('allergy', EntityType::class, [
            'class' => 'App\Entity\Allergies',
            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => true,
            'label' => 'Allergies',
            'label_attr' => [
                'class' => 'resa-form__field--label'
            ],
        ])
        ->add('numberOfGuests', IntegerType::class, [
            'row_attr' => [
                'class' => 'resa-form__field'
            ],
            'label' => 'Nombre de personnes',
            'label_attr' => [
                'class' => 'resa-form__field--label'
            ],
            'attr' => [
                'placeholder' => 'Nombre de personnes',
                'class' => 'resa-form__field--input',
            ],
        ])
            ->add('reservationDate', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                //'1 month' => new \DateTime('+1 month'),
                'row_attr' => [
                    'class' => 'resa-form__field'
                ],
                'label' => 'Date de la réservation',
                'label_attr' => [
                    'class' => 'resa-form__field--label'
                ],
                'attr' => [
                    'placeholder' => 'Date de la réservation',
                    'class' => 'resa-form__field--input',
                ],
            ])
            ->add('reservationHour', EntityType::class, [
                'class' => 'App\Entity\ReservationTime',
                'choice_label' => 'hour',
                'row_attr' => [
                    'class' => 'resa-form__field'
                ],
                'label' => 'Heure de la réservation',
                'label_attr' => [
                    'class' => 'resa-form__field--label'
                ],
                'attr' => [
                    'placeholder' => 'Heure de la réservation',
                    'class' => 'resa-form__field--input',
                ],
            ])
            ->add('service', EntityType::class, [
                'class' => 'App\Entity\Services',
                'choice_label' => 'name',
                'row_attr' => [
                    'class' => 'resa-form__field'
                ],
                'label' => 'Service',
                'label_attr' => [
                    'class' => 'resa-form__field--label'
                ],
                'attr' => [
                    'readonly' => true,
                    'class' => 'resa-form__field--input',
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
