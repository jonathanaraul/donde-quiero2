<?php

// src/Acme/TaskBundle/Form/Type/TaskType.php
namespace Project\BackBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EspacioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('task')
        ->add('dueDate', null, array('widget' => 'single_text'))
        ->add('save', 'submit');
    }

    public function getName()
    {
        return 'espacio';
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\BackBundle\Entity\Espacio',
            ));
    }
}