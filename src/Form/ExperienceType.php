<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Titre : ',
            ))
            ->add('entreprise', TextType::class, array(
                'label' => 'Entreprise : ',
            ))
            ->add('body', CKEditorType::class, array(
                'label' => 'Contenu : ',
            ))
            ->add('url', TextType::class, array(
                'label' => 'Url de l\'entreprise : ',
            ))
            ->add('imageFile', VichImageType::class, array(
                'label' => 'Image : ',
            ))
            ->add('year', TextType::class, array(
                'label' => 'Période : ',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
