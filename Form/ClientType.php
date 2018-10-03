<?php

namespace Fyher\ClientBundle\Form;



use Doctrine\DBAL\Types\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;



class ClientType extends AbstractType
{

    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add("nomClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.nomclient"));
        $builder->add("civiliteClient",ChoiceType::class,array("label"=>"fyher.form.civiliteclient",
            "choices"=>array("Mme"=>"mme","Mr"=>"mr","Mdme"=>"mdme"),"placeholder"=>"fyher.form.choisircivilite"
            ));
        $builder->add("prenomClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.prenomclient"));
        $builder->add("adresseClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.adresseclient"));
        $builder->add("villeClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.villeclient"));
        $builder->add("codePostalClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.codepostalclient"));
        $builder->add("numeroFixeClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.numeroficeclient"));
        $builder->add("numeroMobileClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.numeromobileclient"));
        $builder->add("departementNomClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.departementnomclient"));
        $builder->add("departementCodeClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.departementcodeclient"));
        $builder->add("paysClient",CountryType::class,array("label"=>"fyher.form.paysclient","placeholder"=>"fyher.form.paysclient"));
        $builder->add("codeInseeVilleClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.codeinseevilleclient"));



    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => $this->class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fyherbundle_client_addd';
    }


}
