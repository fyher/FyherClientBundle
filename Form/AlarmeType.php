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



class AlarmeType extends AbstractType
{




    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add("titreAlarme",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.titrealarme"));
        $builder->add("descriptionAlarme",\Symfony\Component\Form\Extension\Core\Type\TextareaType::class,array("label"=>"fyher.form.descriptionalarme"));
        $builder->add("emailRappelAlarme",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.emailrappelalarme"));
        $builder->add("mobileRappelAlarme",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.mobilerappelalarme"));
        $builder->add("dateRappelAlarme",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.daterappelalarme"));
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' =>"Fyher\ClientBundle\Entity\Alarme"
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fyherbundle_alarme_add';
    }


}
