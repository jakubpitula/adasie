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
use App\Repository\TeacherRepository;
use App\Entity\Category;
use App\Entity\Vote;
use App\Entity\Minivote;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class MinivoteType extends AbstractType
{
    private $teacherRepository;

    public function __construct(TeacherRepository $tr)
    {
        $this->teacherRepository = $tr;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
        ->add('teacher', EntityType::class, [
            'class' => Teacher::class,
            'choice_label' => 'name',
            'label' => false,
            'preferred_choices' => $this->teacherRepository->findByName('brak'),
            'query_builder' => function (TeacherRepository $r) {
                return $r->createQueryBuilder('u')
                    ->orderBy('u.name', 'ASC');
            },
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Minivote::class,
        ]);
    }
}