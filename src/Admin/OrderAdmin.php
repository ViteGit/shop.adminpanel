<?php

namespace App\Admin;

use App\VO\PaymentStatus;
use App\VO\ShipmentStatus;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;

final class OrderAdmin extends AbstractAdmin
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

    protected function configureFormFields(FormMapper $form)
    {
        $form->add('shipment.status', ChoiceFieldMaskType::class, [
                'choices' => [
                    ShipmentStatus::PENDING => ShipmentStatus::PENDING,
                    ShipmentStatus::CANCELLED => ShipmentStatus::CANCELLED,
                    ShipmentStatus::READY => ShipmentStatus::READY,
                    ShipmentStatus::SHIPPED => ShipmentStatus::SHIPPED,
                    ShipmentStatus::RECEIVED => ShipmentStatus::RECEIVED,
                ]
            ]
        );

        $form->add('payment.status', ChoiceFieldMaskType::class, [
                'choices' => [
                    PaymentStatus::PENDING => PaymentStatus::PENDING,
                    PaymentStatus::COMPLETED => PaymentStatus::COMPLETED,
                    PaymentStatus::FAILED => PaymentStatus::FAILED,
                    PaymentStatus::CANCELLED => PaymentStatus::CANCELLED,
                    PaymentStatus::REFUNDED => PaymentStatus::REFUNDED,
                    PaymentStatus::UNKNOWN => PaymentStatus::UNKNOWN,
                ]
            ]
        );
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->tab('Главная')
            ->add('orderPrice', null, ['label' => 'Цена заказа'])
            ->add('orderId', null, ['label' => 'Id заказа'])
            ->add('notes', null, ['label' => 'Заметка'])
            ->add('orderDate', null, ['label' => 'Дата заказа'])
            ->end();

        $showMapper->with('Информация о товаре')
            ->add('items', null, [
                'template' => 'items.html.twig',
                'label' => 'позиции заказа',
            ])
            ->end();


        $showMapper->with('Платеж')
            ->add('payment.id')
            ->add('payment.currencyCode')
            ->add('payment.amount')
            ->add('payment.createdAt')
            ->add('payment.invId')
            ->add('payment.status.value')
            ->add('payment.paymentDate')
            ->add('payment.cancelDate')
            ->end();

        $showMapper->with('Способ оплаты')
            ->add('payment.paymentMethod.id')
            ->add('payment.paymentMethod.label')
            ->add('payment.paymentMethod.code')
            ->add('payment.paymentMethod.description')
            ->end()
            ->end();

        $showMapper->tab('Информация о доставке')
            ->add('shipment.shippingData.fio', null, ['label' => 'ФИО'])
            ->add('shipment.shippingData.phoneNumber', null, ['label' => 'Номер телефона'])
            ->add('shipment.shippingData.email', null, ['label' => 'Email'])
            ->add('shipment.shippingData.city', null, ['label' => 'Город'])
            ->add('shipment.shippingData.address', null, ['label' => 'Адрес доставки'])
            ->add('shipment.shippingData.postcode', null, ['label' => 'Почтовый индекс'])
            ->add('shipment.shippingData.pickUpId', null, ['label' => 'Id Постомата'])
            ->end();

        $showMapper->with('Способ Доставки')
            ->add('shipment.shipmentMethod.id', null, ['label' => 'Id'])
            ->add('shipment.shipmentMethod.price', null, ['label' => 'Цена доставки'])
            ->add('shipment.shipmentMethod.label', null, ['label' => 'Название'])
            ->add('shipment.shipmentMethod.code', null, ['label' => 'Код доставки'])
            ->add('shipment.shipmentMethod.description', null, ['label' => 'Описание доставки'])
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('orderId')
            ->add('notes')
            ->add('orderDate')
            ->add('payment.paymentMethod.label', null, ['label' => 'Способ оплаты'])
            ->add('payment.status.value')
            ->add('payment.paymentDate')
            ->add('shipment.status.value')
            ->add('shipment.shipmentMethod.label', null, ['label' => 'Способ доставки'])
            ->add('orderPrice');
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
    }
}
