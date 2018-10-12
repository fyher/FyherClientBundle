<?php

namespace Fyher\ClientBundle\Form;



use Doctrine\DBAL\Types\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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


        $builder->add("nomClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.nomclient","attr"=>array("class"=>"col-md-4","placeholder"=>"fyher.form.nomclient")));
        $builder->add("civiliteClient",ChoiceType::class,array("label"=>"fyher.form.civiliteclient","expanded"=>true,
            "choices"=>array("Mme"=>"mme","Mr"=>"mr","Mdme"=>"mdme"),"placeholder"=>"fyher.form.choisircivilite","attr"=>array("class"=>"form-check-inline")
            ));
        $builder->add("prenomClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.prenomclient","attr"=>array("class"=>"col-md-4","placeholder"=>"fyher.form.prenomclient")));
        $builder->add("adresseClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.adresseclient","attr"=>array("class"=>"col-md-6 listingvillefyher","placeholder"=>"fyher.form.adresseclient","autocomplete"=>"off")));
        $builder->add("villeClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.villeclient","attr"=>array("class"=>"col-md-6 ","placeholder"=>"fyher.form.vlleclient")));
        $builder->add("codePostalClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.codepostalclient","attr"=>array("class"=>"col-md-4","placeholder"=>"fyher.form.codepostalclient")));
        $builder->add("numeroFixeClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.numeroficeclient","attr"=>array("class"=>"col-md-12","placeholder"=>"fyher.form.numeroficeclient")));
        $builder->add("numeroMobileClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.numeromobileclient","attr"=>array("class"=>"col-md-12","placeholder"=>"fyher.form.numeromobileclient")));
        $builder->add("departementNomClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.departementnomclient","attr"=>array("class"=>"col-md-4","placeholder"=>"fyher.form.departementnomclient")));
        $builder->add("departementCodeClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.departementcodeclient","attr"=>array("class"=>"col-md-4","placeholder"=>"fyher.form.departementcodeclient")));
        $builder->add("paysClient",CountryType::class,array("label"=>"fyher.form.paysclient","attr"=>array("class"=>"col-md-4","data-placeholder"=>"fyher.form.paysclient")));
        $builder->add("codeInseeVilleClient",HiddenType::class,array("label"=>"fyher.form.codeinseevilleclient","attr"=>array("class"=>"col-md-4","placeholder"=>"fyher.form.codeinseevilleclient")));
        $builder->add("telephoneFauxNumFixClient",CheckboxType::class,array("label"=>"fyher.form.fauxnumero","value"=>1));
        $builder->add("telephoneValideFixClient",CheckboxType::class,array("label"=>"fyher.form.numerovalie","value"=>1));
        $builder->add("telephoneFauxNumMobClient",CheckboxType::class,array("label"=>"fyher.form.fauxnumero","value"=>1));
        $builder->add("telephoneValideMobClient",CheckboxType::class,array("label"=>"fyher.form.numerovalie","value"=>1));
        $builder->add("emailValideClient",CheckboxType::class,array("label"=>"fyher.form.numerovalie","value"=>1));
        $builder->add("emailClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.email"));
        $builder->add("cspClient",EntityType::class,array("label"=>"fyher.form.csp","class"=>"Fyher\ClientBundle\Entity\Csp",
            "choice_label"=>"nom","placeholder"=>"fyher.form.csp"));
        $builder->add("situationClient",EntityType::class,array("label"=>"fyher.form.situation","class"=>"Fyher\ClientBundle\Entity\Situation",
            "choice_label"=>"nom","placeholder"=>"fyher.form.situation"));
        $builder->add("trancheRevenuClient",EntityType::class,array("label"=>"fyher.form.trancherevenu","class"=>"Fyher\ClientBundle\Entity\TrancheRevenu",
            "choice_label"=>"info","placeholder"=>"fyher.form.trancherevenu"));
        $builder->add("anneTrancheRevenuClient",DateType::class,array("label"=>false,"attr"=>array("placeholder"=>"fyher.form.anne"),"input"=>"datetime","html5"=>false,"widget"=>"single_text","format"=>"yyyy"));
        $builder->add("impositionClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.imposition","attr"=>array("placeholder"=>"fyher.form.imposition")));
        $builder->add("anneImpositionClient",DateType::class,array("label"=>false,"attr"=>array("placeholder"=>"fyher.form.anne"),"input"=>"datetime","html5"=>false,"widget"=>"single_text","format"=>"yyyy"));
        $builder->add("nbEnfantClient",IntegerType::class,array("label"=>"fyher.form.nbenfant","attr"=>array("step"=>1,"min"=>0,"class"=>"col-md-2")));
        $builder->add("professionClient",\Symfony\Component\Form\Extension\Core\Type\TextType::class,array("label"=>"fyher.form.profession","attr"=>array("class"=>"col-md-4","placeholder"=>"fyher.form.profession")));

        $anne=array();
        for($i=1930;$i<date("Y");$i++){
            array_push($anne,$i);
        }
        $builder->add("dateNaissanceClient",DateType::class,array("label"=>"fyher.form.datenaissance","attr"=>array("class"=>"col-md-12"),"widget"=>"choice",
            "placeholder"=>array("year"=>"Année","month"=>"Mois","day"=>"jour"),"input"=>"datetime","years"=>$anne));
        $builder->add("longitudeClient",HiddenType::class);
        $builder->add("latitudeClient",HiddenType::class);

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
