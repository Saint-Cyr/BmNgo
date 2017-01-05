<?php

namespace TransactionBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class StockAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('product')
            ->add('branch')
            ->add('value')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('branch')
            ->add('value', null, array('editable' => true))
            ->add('alertLevel', null, array('editable' => true))
            ->add('product')
            ->add('createdAt')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
         ->with('Detail', array('class' => 'col-md-6'))
            ->add('name', null, array('label' => 'Tag Name'))
            ->add('value', null, array('label' => 'Value ( Quantity )', 'required' => false))
         ->end()
        
         ->with('Extra', array('class' => 'col-md-4'))
            ->add('product')
            ->add('alertLevel')
            ->add('branch')
         ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('createdAt')
        ;
    }
    
    public function preValidate($object) {
        parent::preValidate($object);
        //Set the default value of the quantity to 0 if not input by the user
        if(!$object->getValue()){
            $object->setValue(0);
        }
    }
}
