<?php

namespace App\Form;

use App\Entity\Realisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EditRealisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Titre',
            ))
            ->add('body', CKEditorType::class, array(
                'label' => 'Description',
            ))
            ->add('url', TextType::class, array(
                'label' => 'lien du site',
            ))
            ->add('imageFile', VichImageType::class, array(
                'required' => false
            ))
            ->add('year', TextType::class, array(
                'label' => 'Période',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Realisation::class,
        ]);
    }
}
