<?php

namespace App\Form;

use App\Entity\Todo;
use App\Entity\Status;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class TodoType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
      $builder
          ->add('name', TextType::class, [
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
        ->add('pictureUrl', FileType::class, [
            'label' => 'Upload Picture',
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpeg',
                        'image/jpg',
                    ],
                    'mimeTypesMessage' => 'Please upload a valid image file',
                ])
            ],
        ])
          ->add('category', TextType::class, [
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
          ->add('description', TextType::class, [
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
          ->add('priority', ChoiceType::class, [
              'choices' => ['Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'],
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
          ->add('dueDate', DateTimeType::class, [
              'attr' => ['style' => 'margin-bottom:15px']
          ])
          ->add('fk_status', EntityType::class, [
            'class' => Status::class,
            'choice_label' => 'available',
          ])    
          ->add('save', SubmitType::class, [
              'label' => 'Create todo',
              'attr' => ['class' => 'btn-primary', 'style' => 'margin-bottom:15px']
          ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
      $resolver->setDefaults([
          'data_class' => Todo::class,
      ]);
  }
}

