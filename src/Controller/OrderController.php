<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class OrderController extends AbstractController
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

//    /**
//     * @param Request $request
//     *
//     * @Route("/export-order")
//     * @throws \Doctrine\ORM\EntityNotFoundException
//     */
//    public function exportOrder(Request $request)
//    {
//        $id = $request->query->get('orderId');
//
//        $order = $this->orderRepository->getByOrderId($id);
//
//        $items = $order->getItems();
//
//        foreach ($items as $item)
//        {
//            $variant = $item->getProductVariant();
//
//            $product = $variant->getProduct();
//            dump($variant);
//            dump($product);
//
//        }
//
//        dump($order);
//        die;
//
//    }
}