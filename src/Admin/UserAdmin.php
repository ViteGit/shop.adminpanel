<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class UserAdmin extends AbstractAdmin
{
    /**
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     */
    public function __construct(
        string $code,
        string $class,
        string $baseControllerName
    ) {
        parent::__construct($code, $class, $baseControllerName);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username',  TextType::class)
            ->add('fio', TextType::class)
            ->add('email', TextType::class)
            ->add('phone', TextType::class)
            ->add('createdAt', TextType::class)
            ->add('points', TextType::class)
            ->add('emailVerificationToken', TextType::class)
            ->add('passwordResetToken', TextType::class)
            ->add('status', TextType::class)
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id')
            ->add('username')
            ->add('fio')
            ->add('email')
            ->add('phone')
            ->add('createdAt')
            ->add('points')
            ->add('status');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('username')
            ->add('fio')
            ->add('email')
            ->add('phone')
            ->add('createdAt')
            ->add('points')
            ->add('status');
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
    }
}
