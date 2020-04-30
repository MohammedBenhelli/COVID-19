<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        if ($this->getUser() !== null && $this->getUser()->getRoles() === ["ROLE_ADMIN"])
            return $this->render('admin/index.html.twig', [
                'controller_name' => 'AdminController',
            ]);
        else return $this->redirectToRoute("home");
    }
}
