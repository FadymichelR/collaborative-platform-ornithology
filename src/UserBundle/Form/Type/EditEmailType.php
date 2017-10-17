<?php
namespace UserBundle\Form\Type;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('email', EmailType::class, array(
                    'label' => 'core.email.new',
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
                ->add('current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
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
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User',
            'csrf_token_id' => 'profile',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'core_user_profile';
    }
}
