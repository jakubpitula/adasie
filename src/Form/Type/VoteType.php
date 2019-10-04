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
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\FormInterface;

class VoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categories = [];
        $minivotes = $options['vote']->getMinivotes();

        $i=0;
        foreach ($minivotes as $minivote){
            array_push($categories, $minivote->getCategory()->getName());
            $i++;
        }

        $ip = $options['request']->getClientIp();

        $builder->add('minivotes', CollectionType::class, [
            'entry_type' => MinivoteType::class,
            'entry_options' => [
                'label' => false,            ],
        ])
        ->add('ip', HiddenType::class,[
            'data' => $ip,
        ])
        ->add('submit', SubmitType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vote::class,
            'request' => null,
            'vote' => null
        ]);
    }   
}