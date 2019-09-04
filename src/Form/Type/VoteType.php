<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Teacher;
use App\Repository\CategoryRepository;
use App\Entity\Catgory;

class VoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        echo $count;

        $builder
            ->add('teacher', EntityType::class, [
                'class' => Teacher::class,
                'choice_label' => 'name'
            ])
            ->add('category', ChoiceType::class)
            ->add('save', SubmitType::class, ['label' => 'Zagłosuj'])
        ;
    }
}