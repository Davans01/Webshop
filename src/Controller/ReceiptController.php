<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReceiptController extends AbstractController
{
    /**
     * @Route("/receipt", name="receipt")
     */
    public function index()
    {
        return $this->render('receipt/index.html.twig', [
            'controller_name' => 'ReceiptController',
        ]);
    }
}
