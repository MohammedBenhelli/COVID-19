<?php

namespace App\Controller;

use App\Entity\Score;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScoreController extends AbstractController
{
    public function __construct()
    {
        session_start();
    }

    /**
     * @Route("/score", name="score")
     */
    public function index()
    {
        return $this->render('score/index.html.twig', [
            'controller_name' => 'ScoreController',
        ]);
    }

    private function isLogged(): bool
    {
        if ($this->getUser()) return true;
        else return false;
    }

    public function showProfile(): Response
    {
        $scoreFilter = [];
        $score = $this->getDoctrine()->getRepository(Score::class)->findTotal($this->getUser()->getId());
        for($i = 0; $i < count($score); $i += 2)
            $scoreFilter[$i / 2] = [$score[$i], $score[$i + 1]];
        return $this->render("quizz/profile.html.twig", [
            "score" => $scoreFilter,
            "logout" => $this->isLogged()
        ]);
    }
}
