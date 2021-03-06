<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => false, 'attr' => [
                'class' => 'text_input',
                'placeholder' => 'ФИО',]])
            ->add('email', EmailType::class, ['label' => false, 'attr' => [
                'class' => 'text_input',
                'placeholder' => 'Почта',
                'type' => 'email',]])
            ->add('password', PasswordType::class, ['label' => false, 'attr' => [
                'class' => 'text_input input_password',
                'placeholder' => 'Пароль',]])
            ->add('address', TextType::class, ['label' => false, 'attr' => [
                'class' => 'text_input',
                'placeholder' => 'Адресс доставки',]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
