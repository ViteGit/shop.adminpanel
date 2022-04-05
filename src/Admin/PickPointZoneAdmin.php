<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class PickPointZoneAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('city', TextType::class, [
                'required' => false,
            ])
            ->add('region', TextType::class, [
                'required' => false,
            ])
            ->add('zone', TextType::class, [
                'required' => false,
            ])
            ->add('deliveryTerms', TextType::class, [
                'required' => false,
            ])
            ->add('coefficient', TextareaType::class, ['required' => false])
            ->add('file', FileType::class, [
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'data-url' => '/importZone',
                    'data-redirect' => '/admin/app/pickpointzone/list',
                    'class' => 'import',
                ],
            ]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id')
            ->add('city')
            ->add('region')
            ->add('zone')
            ->add('deliveryTerms')
            ->add('coefficient');

    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('city')
            ->add('region')
            ->add('zone')
            ->add('deliveryTerms')
            ->add('coefficient');
    }
}
