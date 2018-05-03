<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EPurchaseController extends Controller
{
    /**
     * @Route("/invoice/purchase", name="e_purchase")
     */
    public function index()
    {
        return $this->render('e_purchase/index.html.twig', [
            'controller_name' => 'EPurchaseController',
        ]);
    }
}
