<?php

namespace App\Form;

use App\Entity\Patient;
use App\Entity\Consultation;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_consult',DateType::class,[
                'widget' => 'single_text',
                "label" => "Date de consultation",
                "attr" => ["class" => "uk-input"],
            ])
            ->add('test',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                ])
            ->add('traitement',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                ])
            ->add('conseil',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                ])
            ->add('note',TextareaType::class,[
                "attr" => ["class" => "uk-textarea"],
                ])
            ->add('montant',IntegerType::class,[
                "attr" => ["class" => "uk-input"],
                ])
            ->add('numero_cheque',TextType::class,[
                "attr" => ["class" => "uk-input"],
                "required" => false,
                "label" => "Numéro de chèque"
                ])
            ->add('patient',EntityType::class,[
                'class' => Patient::class,
                'choice_label' => 'id',
                "attr" => ["class" => "hidden"],
                "label" => false
            
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consultation::class,
        ]);
    }
}
