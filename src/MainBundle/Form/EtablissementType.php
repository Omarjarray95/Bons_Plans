<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EtablissementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('attr'=>array('style'=>'width:300px')))
            ->add('type', ChoiceType::class, array('choices'=>array('Restaurants/Cafés'=>'Resto_Café','Boutique'=>'Shops','Hotels'=>'hotels',
            'Autres Etablissements'=>'Autres')))
            ->add('adresse', TextType::class, array('attr'=>array('style'=>'width:300px')))
            ->add('description', TextareaType::class, array('attr'=>array('style'=>'width:400px')))
            ->add('horaire', TextType::class, array('attr'=>array('style'=>'width:200px')))
            ->add('typeLoisirs', ChoiceType::class, array('choices'=>array('Cinéma'=>'Cinema','Salle De Sport'=>'Salle_De_Sport',
                "Parc D'Attraction"=>'Attraction Parc', 'Spa'=>'spa', 'Salon De Coiffure'=>'Beauty Shop', 'Salle De Jeux'=>'Salle_De_Jeux',
                'Autre'=>'Autres')))
            ->add('Ajouter',SubmitType::class)
            ->setMethod('GET');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Etablissement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_etablissement';
    }


}
