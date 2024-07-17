<?php

namespace App\Form;

use App\Entity\Complaint;
use App\Enum\ComplaintStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ComplaintType extends AbstractType
{
    private AuthorizationCheckerInterface $checker;
    public function __construct(AuthorizationCheckerInterface $checker)
    {
        $this->checker = $checker;

    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('text', TextareaType::class)
        ;
        if ($this->checker->isGranted('ROLE_ADMIN')) {
            $builder->add('status', EnumType::class, ['class' => ComplaintStatus::class]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Complaint::class,
        ]);
    }
}
