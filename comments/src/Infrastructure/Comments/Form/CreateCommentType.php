<?php

namespace App\Infrastructure\Comments\Form;

use App\Domain\Comments\DataTransferObject\CreateCommentDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => "Treść komentarza:"
            ])
            ->add('authorEmail', EmailType::class, [
                'label' => "Email:"
            ])
            ->add('nick', TextType::class, [
                'label' => "Nick"
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Wyślij"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateCommentDto::class,
        ]);
    }
}
