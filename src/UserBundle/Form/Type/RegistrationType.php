<?php
namespace UserBundle\Form\Type;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('firstName', TextType::class, array(
                    'label' => 'core.firstname.label',
                    'label_attr' => array(
                        'class' => 'col-sm-4 control-label'
                    ),
                    'attr' => array(
                        'class' => 'form-control input-lg',
                        'placeholder' => 'core.firstname.placeholder',
                        'minlength' => 2,
                        'maxlength' => 255,
                        'aria-required' => true,
                        'autocomplete' => 'off'
                    ),
                    'translation_domain' => 'validators'
                ))
                ->add('surname', TextType::class, array(
                    'label' => 'core.surname.label',
                    'label_attr' => array(
                        'class' => 'col-sm-4 control-label'
                    ),
                    'attr' => array(
                        'class' => 'form-control input-lg',
                        'placeholder' => 'core.surname.placeholder',
                        'minlength' => 2,
                        'maxlength' => 255,
                        'aria-required' => true,
                        'autocomplete' => 'off'
                    ),
                    'translation_domain' => 'validators'
                ))
                ->add('email', EmailType::class, array(
                    'label' => 'core.email.label',
                    'label_attr' => array(
                        'class' => 'col-sm-4 control-label'
                    ),
                    'attr' => array(
                        'class' => 'form-control input-lg',
                        'placeholder' => 'core.email.placeholder',
                        'aria-required' => true,
                        'autocomplete' => 'off'
                    ),
                    'translation_domain' => 'validators'
                ))
                ->add('plainPassword', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'core.pass.mismatch',
                    'options' => array(
                        'required' => true,
                        'translation_domain' => 'validators'
                    ),
                    'first_options' => array(
                        'label' => 'core.pass.label',
                        'label_attr' => array(
                            'class' => 'col-sm-4 control-label'
                        ),
                        'attr' => array(
                            'class' => 'form-control input-lg',
                            'placeholder' => 'core.pass.placeholder',
                            'aria-required' => true,
                            'autocomplete' => 'off'
                        )
                    ),
                    'second_options' => array(
                        'label' => 'core.pass.confirm',
                        'label_attr' => array(
                            'class' => 'col-sm-4 control-label'
                        ),
                        'attr' => array(
                            'class' => 'form-control input-lg',
                            'placeholder' => 'core.pass.placeholder',
                            'aria-required' => true,
                            'autocomplete' => 'off'
                        )
                    ),
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User',
            'csrf_token_id' => 'registration',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'core_user_registration';
    }
}
