<?php

// src/Acme/TaskBundle/Form/Type/TaskType.php
namespace Proyecto\PrincipalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('propietarioEmpleado', 'checkbox',array('required'  => false))
        ->add('agenteComercial', 'checkbox',array('required'  => false))
        ->add('administradorWeb', 'checkbox',array('required'  => false))
        ->add('nombre', 'text')
        ->add('descripcionGeneral', 'textarea')
        ->add('duracionTotal', 'text')
        ->add('file','file') 
        ->add('enlaceVideo', 'text')
        ->add('esPrivado', 'checkbox',array('required'  => false))
        ->add('esGratuito', 'checkbox',array('required'  => false))
        ->add('modoAula', 'checkbox',array('required'  => false))
        ->add('modoAulaCapacidad')
        ->add('modoBanquete', 'checkbox',array('required'  => false))
        ->add('modoBanqueteCapacidad')
        ->add('modoCocktail', 'checkbox',array('required'  => false))
        ->add('modoCocktailCapacidad')
        ->add('modoEscenario', 'checkbox',array('required'  => false))
        ->add('modoEscenarioCapacidad')
        ->add('modoExposicion', 'checkbox',array('required'  => false))
        ->add('modoExposicionCapacidad')
        ->add('aceptacionReservaAutomatica', 'checkbox',array('required'  => false))
        ->add('tiempoMaximoAceptacionReservaAutomatica24h', 'checkbox',array('required'  => false))
        ->add('tiempoMaximoAceptacionReservaAutomatica48', 'checkbox',array('required'  => false))
        ->add('datosFacturacionPagoDelUsuario', 'checkbox',array('required'  => false))
        ->add('anadirDatosFacturacionPago', 'checkbox',array('required'  => false))
        ->add('formacionTeorica', 'checkbox',array('required'  => false))
        ->add('formacionInformatica', 'checkbox',array('required'  => false))
        ->add('formacionTaller', 'checkbox',array('required'  => false))
        ->add('exposicion', 'checkbox',array('required'  => false))
        ->add('ventaFeria', 'checkbox',array('required'  => false))
        ->add('deporte', 'checkbox',array('required'  => false))
        ->add('espectaculo', 'checkbox',array('required'  => false))
        ->add('reunionAsamblea', 'checkbox',array('required'  => false))
        ->add('boda', 'checkbox',array('required'  => false))
        ->add('fiesta', 'checkbox',array('required'  => false))
        ->add('jardineria', 'checkbox',array('required'  => false))
        ->add('aceptoCondicionesUsoPoliticaPrivacidad', 'checkbox',array('required'  => false))
        ->add('precio','number',array('required'  => true))
        ->add('fecha', 'date', array(
            'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Dia')
            ))
        ->add('horaInicio', 'time', array(
            'input'  => 'datetime',
            'widget' => 'choice',
            ))
        ->add('horaFinalizacion', 'time', array(
            'input'  => 'datetime',
            'widget' => 'choice',
            ))
        ->add('espacio', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:Espacio',
            'property' => 'nombre',
            'required'  => false,
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                ->orderBy('u.nombre', 'ASC');
            },
            ))
        ->add('localidad', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:Localidad',
            'property' => 'nombre',
            'query_builder' => function(EntityRepository $er)use ( $parametro ) {
                return $er->createQueryBuilder('u')
                ->add('where', 'u.provincia = ?1')
                ->orderBy('u.nombre', 'ASC')
                        ->setParameter(1, $parametro); // Sustituye ?1 por 100
                    },
            ));           
        //->add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')));
    }

    public function getName()
    {
        return 'evento';
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Proyecto\PrincipalBundle\Entity\Evento',
            ));
    }
}