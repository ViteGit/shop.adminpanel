<?php

namespace App\Admin;

use App\Entity\ShipmentMethod;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Exception;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class ShipmentMethodAdmin extends AbstractAdmin
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
            ->add('price', null, ['label' => 'Цена доставки'])
            ->add('label', null, ['label' => 'Название'])
            ->add('code', null, ['label' => 'Код доставки'])
            ->add('description', TextareaType::class, ['label' => 'Описание доставки'])
            ->add('active', null, ['label' => 'Активна'])
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
        $datagridMapper->add('price');
        $datagridMapper->add('label');
        $datagridMapper->add('active');
        $datagridMapper->add('code');
        $datagridMapper->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('price')
            ->add('label')
            ->add('active')
            ->add('code')
            ->add('description');
    }

    /**
     * @var ShipmentMethod $shipmentMethod
     *
     * @throws Exception
     */
    public function prePersist($shipmentMethod)
    {
        $shipmentMethod->setCreatedAt();

        parent::preUpdate($shipmentMethod);
    }
}
