<?php

namespace TransactionBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ReportAdmin extends AbstractAdmin
{

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
       $formMapper
           ->with('Data', array('class' => 'col-md-4'))
               ->add('e1', 'entity', array('class' => 'TransactionBundle:Category', 'label' => 'E1: one by column', 'required' => true))
               ->add('e2', 'entity', array('class' => 'TransactionBundle:Category', 'label' => 'E2: Grouped for one column', 'required' => true))
               ->add('e3', 'entity', array('class' => 'TransactionBundle:Category', 'label' => 'E3: Exclued', 'required' => false))
           ->end();
       $formMapper
        ->with('Periode', array('class' => 'col-md-4'))
            ->add('initDate', 'sonata_type_datetime_picker', array(
                      'dp_side_by_side'  => true,
                      'dp_use_current'   => false,
                      'dp_use_seconds'   => false,
              ))
            ->add('finitDate', 'sonata_type_datetime_picker', array(
                      'dp_side_by_side'  => true,
                      'dp_use_current'   => false,
                      'dp_use_seconds'   => false,
              ))
        ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        
    }
}
