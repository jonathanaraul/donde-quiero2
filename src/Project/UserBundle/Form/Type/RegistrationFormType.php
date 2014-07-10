<?php

namespace Project\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Doctrine\ORM\EntityRepository;



class RegistrationFormType extends BaseType
{

    public function getName()
    {
        return 'project_user_registration';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $filtros = array();
        $filtros['idLocalidad'] = array(
            '1' => 'Alegría-Dulantzi',
            '2' => 'Amurrio',
            '3' => 'Añana',
            '4' => 'Aramaio',
            '5' => 'Armión',
            '6' => 'Arraia-Maeztu',
            '7' => 'Arrazua-Ubarrundia',
            '8' => 'Artziniega',
            '9' => 'Asparrena',
            '10' => 'Ayala',
            '11' => 'Baños de Ebro',
            '23' => 'Barrundia',
            '24' => 'Berantevilla',
            '25' => 'Bernedo',
            '26' => 'Campezo',
            '27' => 'Elburgo',
            '28' => 'Elciego',
            '29' => 'Elvillar',
            '31' => 'Iruña de Oca',
            '32' => 'Iruraiz-Gauna',
            '33' => 'Kripan',
            '34' => 'Kuartango',
            '35' => 'Labastida',
            '36' => 'Lagrán',
            '37' => 'Laguardia',
            '38' => 'Lanciego',
            '39' => 'Lantarón',
            '40' => 'Lapuebla de Labarca',
            '42' => 'Legutiano',
            '43' => 'Leza',
            '41' => 'Llodio',
            '44' => 'Moreda de Álava',
            '45' => 'Navaridas',
            '46' => 'Okondo',
            '47' => 'Oyón',
            '48' => 'Peñacerrada',
            '49' => 'Ribera Alta',
            '50' => 'Ribera Baja',
            '51' => 'Salvatierra',
            '52' => 'Samaniego',
            '53' => 'San Millán',
            '54' => 'Urkabustaiz',
            '55' => 'Valdegovía',
            '30' => 'Valle de Arana',
            '56' => 'Villabuena de Álava',
            '57' => 'Vitoria-Gasteiz',
            '58' => 'Yécora',
            '59' => 'Zalduondo',
            '60' => 'Zambrana',
            '61' => 'Zigoitia',
            '62' => 'Zuia',

            );
$filtros['marketing'] = array( 
   '1' => 'Mediante un buscador',
   '2'  => 'Por un enlace en otra Web', 
   '3'  => 'Ha recibido publicidad', 
   '4'  => 'Mediante carteles', 
   '5'  => 'Por un amigo/conocido', 
   '6'  => 'Otro' 
   );

$builder->add('email', 'email');
$builder->add('nombre');
$builder->add('apellido');
$builder->add('telefono');
$builder->add('profesion');
$builder->add('file');

$builder->add('descripcion');
$builder->add('pais');
/*$builder->add('provincia', 'entity', array(
            'class' => 'ProjectBackBundle:Provincia',
            'property' => 'nombre',
            ));
*/
$builder->add('provincia', 'entity', array(
    'class' => 'ProjectBackBundle:Provincia',
    'property' => 'nombre',
    'query_builder' => function(EntityRepository $er) {
        return $er->createQueryBuilder('u')
            ->orderBy('u.nombre', 'ASC');
    },
));

$builder->add('idLocalidad', 'choice', array('choices' => $filtros['idLocalidad'], 'required' => true));
$builder->add('marketing', 'choice', array('choices' => $filtros['marketing'], 'required' => true));
$builder->add('eventos', 'checkbox',array('required'  => false));
$builder->add('aceptoCondiciones');

    }


}