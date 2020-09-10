<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class,[
                "attr" => ["class" => "uk-input"]
            ])
            ->add('password', PasswordType::class,[
                "attr" => ["class" => "uk-input"]
            ])
            ->add('roles', ChoiceType::class, [
                "attr" => [
                    "class" => "uk-select",
                ],
                "label" => "Roles",
                'choices' => [
                    'ADMIN' => 'ROLE_ADMIN',
                    'REMPLACANT' => 'ROLE_USER',
                ],
                "multiple" => true,
                "expanded" => true
            ])
            ->add("Enregistrer",SubmitType::class,[
                'attr' => ['class' => 'uk-button uk-button-primary uk-margin-top uk-margin-bottom']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
