<?php

namespace App\Controller;

use App\Entity\Score;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        if ($this->getUser() !== null && $this->getUser()->getRoles() === ["ROLE_ADMIN"]) {
            return $this->render('admin/index.html.twig', [
            ]);
        } else return $this->redirectToRoute("home");
    }

    public function userList(): Response
    {
        $users = array_filter($this->getDoctrine()->getRepository(User::class)->findAll(), function ($user) {
            return $user->getRoles() === ["ROLE_USER"];
        });
        if ($this->getUser() !== null && $this->getUser()->getRoles() === ["ROLE_ADMIN"]) {
            return $this->render('admin/userList.html.twig', [
                "users" => $users
            ]);
        } else return $this->redirectToRoute("home");
    }

    public function showProfile(int $id): Response
    {
        if ($this->getUser() !== null && $this->getUser()->getRoles() === ["ROLE_ADMIN"]) {
            $scoreFilter = [];
            $score = $this->getDoctrine()->getRepository(Score::class)->findTotal($id);
            for ($i = 0; $i < count($score); $i += 2)
                $scoreFilter[$i / 2] = [$score[$i], $score[$i + 1]];
            return $this->render("admin/profile.html.twig", [
                "score" => $scoreFilter
            ]);
        } else return $this->redirectToRoute("home");
    }

    public function quizzInfo(): Response
    {
        dd($this->getDoctrine()->getRepository(Score::class)->findInfo());
    }
}
