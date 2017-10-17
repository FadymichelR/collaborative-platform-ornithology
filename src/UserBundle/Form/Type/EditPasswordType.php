<?php
namespace UserBundle\Form\Type;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
                    'label' => 'core.pass.current',
                    'label_attr' => array(
                        'class' => 'col-sm-4 control-label'
                    ),
                    'attr' => array(
                        'class' => 'form-control input-lg',
                        'placeholder' => 'core.pass.placeholder',
                        'aria-required' => true,
                        'autocomplete' => 'off'
                    ),
                    'translation_domain' => 'validators',
                    'mapped' => false,
                    'constraints' => array(
                        new NotBlank(),
                        new UserPassword(array(
                            'message' => 'core.pass.invalid',
                        )),
                    ),
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
            'csrf_token_id' => 'change_password',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'core_user_password';
    }
}
