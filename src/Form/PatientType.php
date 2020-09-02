<?php

namespace App\Form;

use App\Entity\Cabinet;
use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('nom', TextType::class,[
                "attr" => ["class" => "uk-input"]
            ])
            ->add('prenom', TextType::class,[
                "attr" => ["class" => "uk-input"]
            ])
            ->add('sexe', TextType::class,[
                "attr" => ["class" => "uk-input"]
            ])
            ->add('dateNaissance',DateType::class,[
                'widget' => 'single_text',
                "label" => "Date de naissance"
            ])
            ->add('adresse', TextType::class,[
                "attr" => ["class" => "uk-input"]
            ])
            ->add('codePostal', TextType::class,[
                "attr" => ["class" => "uk-input"]
            ])
            ->add('ville', TextType::class,[
                "attr" => ["class" => "uk-input"]
            ])
            ->add('numFixe', TextType::class,[
                "attr" => ["class" => "uk-input"],
                "required" => false,
                "label" => "Numéro Fixe"
            ])
            ->add('numPortable', TextType::class,[
                "attr" => ["class" => "uk-input"],
                "required" => false,
                "label" => "Numéro Portable"
            ])
            ->add('email', TextType::class,[
                "attr" => ["class" => "uk-input"],
                "required" => false
            ])
            ->add('profession', TextType::class,[
                "attr" => ["class" => "uk-input"],
                "required" => false
            ])
            ->add('loisir',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false
            ])
            ->add('antTete',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "Tête"
            ])
            ->add('antOrl',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "ORL"
            ])
            ->add('antOphtalmo',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "Ophtalmo"
            ])
            ->add('antAuditif',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "Auditif"
            ])
            ->add('antDent',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "Dentaire"
            ])
            ->add('antPulmo',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "Pulmonaire"
            ])
            ->add('antCardia',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "Cardiaque/Circulatoire"
            ])
            ->add('antDigest',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "Digestif"
            ])
            ->add('antUrin',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "Urinaire"
            ])
            ->add('antGyneco',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "Gynécologique"
            ])
            ->add('antEndoc',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "Endoctrine"
            ])
            ->add('antDermato',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "Dermatologique"
            ])
            ->add('antFamille',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => "Familiaux"
            ])
            ->add('antTrauma',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => false
            ])
            ->add('antOpe',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => false
            ])
            ->add('antPriseMedic',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                "required" => false,
                "label" => false
            ])
            ->add('cabinet',EntityType::class,[
                'class' => Cabinet::class,
                'choice_label' => 'id',
                "attr" => ["class" => "uk-input"],
                'multiple'  => true,
                'label' => false,
            ])

            ->add('consultations', CollectionType::class, [
                "entry_type" => ConsultationType::class,
                "allow_delete" => true,
                "entry_options" => [
                    "label" => false,
                ],
                "label" => false,
                "allow_add" => true,
                "delete_empty" => true,
                'by_reference' => false,
            ])
            
            ->add("Enregistrer",SubmitType::class,[
                'attr' => ['class' => 'uk-button uk-button-primary uk-margin-top uk-margin-bottom']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
      
    }
}
