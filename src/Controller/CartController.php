<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\httpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products;
use App\Form\ProductsType;
use App\Repository\ProductsRepository;

/**
* @Route("/cart", name="cart")
*/
class CartController extends AbstractController
{
    /**
     * @Route("/", name="cart")
     */
    public function index(ProductsRepository $productsRepository): Response
    {
        // get the cart from  the session
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        // $cart = $session->set('cart', '');
        $cart = $session->get('cart', array());

        // $cart = array_keys($cart);
        // print_r($cart); die;

        // fetch the information using query and ids in the cart
        if ($cart != '') {


            if (isset($cart)) {
                $product = $productsRepository->findAll();
            } else {
                return $this->render('cart/index.html.twig', array(
                    'empty' => true,
                ));
            }


            return $this->render('cart/index.html.twig', array(
                'empty' => false,
                'product' => $product,
            ));
        } else {
            return $this->render('cart/index.html.twig', array(
                'empty' => true,
            ));
        }
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
