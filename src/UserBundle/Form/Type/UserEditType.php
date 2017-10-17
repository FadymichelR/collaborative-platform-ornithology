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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('firstName', TextType::class, array(
                    'required' => true,
                    'label' => "Prénom",
                    'label_attr' => array(
                        'class' => 'col-sm-4 control-label'
                    ),
                    'attr' => array(
                        'class' => 'form-control input-lg',
                        'aria-required' => true,
                        'autocomplete' => 'off'
                    ),
                ))
                ->add('surname', TextType::class, array(
                    'required' => true,
                    'label' => "Nom",
                    'label_attr' => array(
                        'class' => 'col-sm-4 control-label'
                    ),
                    'attr' => array(
                        'class' => 'form-control input-lg',
                        'aria-required' => true,
                        'autocomplete' => 'off'
                    ),
                ))
                ->add('email', EmailType::class, array(
                    'required' => true,
                    'label' => "Adresse email",
                    'label_attr' => array(
                        'class' => 'col-sm-4 control-label'
                    ),
                    'attr' => array(
                        'class' => 'form-control input-lg',
                        'aria-required' => true,
                        'autocomplete' => 'off'
                    ),
                ))
                ->add('plainPassword', RepeatedType::class, array(
                    'required' => false,
                    'type' => PasswordType::class,
                    'options' => array(
                        'translation_domain' => 'FOSUserBundle'
                    ),
                    'first_options' => array(
                        'label' => 'form.password',
                        'label_attr' => array(
                            'class' => 'col-sm-4 control-label'
                        ),
                        'attr' => array(
                            'class' => 'form-control input-lg',
                            'autocomplete' => 'off'
                        ),
                    ),
                    'second_options' => array(
                        'label' => 'form.password_confirmation',
                        'label_attr' => array(
                            'class' => 'col-sm-4 control-label'
                        ),
                        'attr' => array(
                            'class' => 'form-control input-lg',
                            'autocomplete' => 'off'
                        ),
                    ),
                    'invalid_message' => 'fos_user.password.mismatch',
                ))
                ->add('roles', ChoiceType::class, array(
                    'required' => true,
                    'choices' => array(
                        'Utilisateur' => 'ROLE_USER',
                        'Administrateur' => 'ROLE_ADMIN'
                    ),
                    'choice_attr' => function($key, $val, $index) {
                        $disabled = false;

                        if ( $key == 'ROLE_USER' )
                            $disabled = true;

                        return $disabled ? ['disabled' => 'disabled'] : [];
                    },
                    'multiple' => true,
                    'expanded'=>true,
                    'label' => "Rôle ",
                    'label_attr' => array(
                        'class' => 'col-sm-4 control-label'
                    ),
                    'attr' => array(
                        'class' => 'input-lg',
                        'aria-required' => true
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
            'csrf_token_id' => 'user_edit',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'core_user_edit';
    }
}
