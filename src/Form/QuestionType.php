<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'empty_data' => '', 
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min'        => 3,
                        'max'        => 100,
                        'minMessage' => 'Pas assez de caractères (min attendu : {{ limit }})',
                        'maxMessage' => 'Trop caractères (max attendu : {{ limit }})',
                    ])
                ]
            ])
            ->add('content', TextareaType::class, [
                'empty_data' => '', 
                'constraints' => [
                    new NotBlank(),
                ],
                'attr' => ['class' => 'input-texarea'],
            ])
            ->add('tags', EntityType::class, [                
                'class' => Tag::class,            
                'choice_label' => 'name',         
                'multiple' => true,
                'expanded' => true,
            ]);
                
                
            
            
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
