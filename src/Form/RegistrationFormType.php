<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'row_attr' => [
                    'class' => 'register-form__field'
                ],
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'register-form__field--input',
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'row_attr' => [
                    'class' => 'register-form__field'
                ],
                'label' => 'Mot de passe',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Mot de passe',
                    'class' => 'register-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('name', TextType::class, [
                'row_attr' => [
                    'class' => 'register-form__field'
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'register-form__field--input',
                ],
            ])
            ->add('firstname', TextType::class, [
                'row_attr' => [
                    'class' => 'register-form__field'
                ],
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'register-form__field--input',
                ],
            ])
            ->add('defaultNumberOfGuests', IntegerType::class, [
                'row_attr' => [
                    'class' => 'register-form__field'
                ],
                'label' => 'Nombre de convives par défaut',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
                'attr' => [
                    'placeholder' => 'Nombre de convives par défaut',
                    'class' => 'register-form__field--input',
                ],
            ])
            ->add('allergy', EntityType::class, [
                'class' => 'App\Entity\Allergies',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Allergies',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'row_attr' => [
                    'class' => 'register-form__field'
                ],
                'label' => 'Veuillez accepter nos conditions générales d\'utilisation',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
                'attr' => [
                    'class' => 'register-form__field--input',
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter nos conditions générales d\'utilisation',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
