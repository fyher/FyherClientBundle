<?php

namespace Fyher\ClientBundle\Form;



use Doctrine\DBAL\Types\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;



class NoteType extends AbstractType
{




    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add("titreNote",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.titrenote"));
        $builder->add("descriptionNote",\Symfony\Component\Form\Extension\Core\Type\TextareaType::class,array("label"=>"fyher.form.descriptionnote"));
        $builder->add("emailAuteurNote",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.emailauteur"));
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' =>"Fyher\ClientBundle\Entity\Notes"
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fyherbundle_note_add';
    }


}
