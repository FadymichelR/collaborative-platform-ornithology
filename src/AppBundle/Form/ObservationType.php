<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservationType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('comment', TextareaType::class, array(
            'label' => 'COMMENTAIRE (Facultatif)',
            'required' => false
      ))
      ->add('date', DateType::class, array(
            'label' => 'DATE*',
            'html5' => false,
            'widget' => 'single_text',
            'format' => 'dd-mm-yyyy',
      ))
      ->add('longitude', TextType::class, array(
            'label' => 'longitude'
      ))
      ->add('lattitude', TextType::class, array(
            'label' => 'lattitude'
      ))
      ->add('country', TextType::class, array(
            'label' => 'country'
      ))
      ->add('birdName', TextType::class, array(
            'label' => 'NOM DE L\'OISEAU'
      ))
      ->add('birdId',  HiddenType::class, array(
        'label' => 'id' 
        ))
      ->add('image', ImageType::class, array(
            'label' => 'PHOTO',
      ))
      ->add('save', SubmitType::class, array(
            'label' => 'Soumettre',
      ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\Observation'
    ));
  }
}



 