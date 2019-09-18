<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Entity\Teacher;
use App\Form\TeacherType;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Entity\Vote;
use App\Entity\TeacherVote;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherVoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // dd($options);
        $builder->add('teachers', EntityType::class, [
            'class' => Teacher::class,
            'choice_label' => 'name',
            'mapped' => false,
            'label' => false
        ])
        ->add('categories', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'name',
            'mapped' => false,
            'label' => false
        ])
        ;

    }

    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults([
    //          'data_class' => TeacherVote::class,
    //     ]);
    // }
}