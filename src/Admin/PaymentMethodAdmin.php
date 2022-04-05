<?php

namespace App\Admin;

use App\Entity\PaymentMethod;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Exception;

final class PaymentMethodAdmin extends AbstractAdmin
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
            ->add('label', null, ['label' => 'Название'])
            ->add('code', null, ['label' => 'Код доставки'])
            ->add('description', TextareaType::class, ['label' => 'Описание метода оплаты'])
            ->add('active', null, ['label' => 'Активна'])
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
        $datagridMapper->add('label');
        $datagridMapper->add('code');
        $datagridMapper->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('label')
            ->add('code')
            ->add('description');
    }

    /**
     * @var PaymentMethod $entity
     *
     * @throws Exception
     */
    public function prePersist($entity)
    {
        $entity->setCreatedAt();

        parent::preUpdate($entity);
    }
}
