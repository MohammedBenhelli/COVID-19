<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Question;
use App\Entity\Reponse as QuizResponse;
use Doctrine\DBAL\Schema\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Response;

class QuizzController extends AbstractController
{
    public function __construct()
    {
        session_start();
    }

    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        if($this->getUser()) $logout = true;
        else $logout = false;
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        return $this->render("quizz/index.html.twig", [
            "categories" => $categories,
            "logout" => $logout
        ]);
    }

    public function showQuizz(int $id): Response
    {
        $_SESSION["id_quizz"] = [$id, []];
        return $this->redirectToRoute("question_show", [
            "id" => $id,
            "id_question" => 0
        ]);
    }

    public function showQuestion(int $id, int $id_question): Response
    {
        if (isset($this->getDoctrine()->getRepository(Question::class)->findBy(["idCategorie" => $id])[$id_question])) {
            $question = $this->getDoctrine()->getRepository(Question::class)->findBy(["idCategorie" => $id])[$id_question];
            $responses = $this->getDoctrine()->getRepository(QuizResponse::class)->findBy(["idQuestion" => $question->getId()]);
            shuffle($responses);
            return $this->render("quizz/quizz.html.twig", [
                "question" => $question,
                "responses" => $responses,
                "count" => $_SESSION["id_quizz"][1],
                "number" => ++$id_question
            ]);
        } else return $this->render("quizz/result.html.twig", [
            "result" => count(array_filter($_SESSION["id_quizz"][1], function ($value){
                return $value === true;
            }))
        ]);
    }

    public function response(int $id, int $id_question, int $response): Response
    {
        if ($response === 2) array_push($_SESSION["id_quizz"][1], true);
        else array_push($_SESSION["id_quizz"][1], false);
        return $this->redirectToRoute("question_show", [
            "id" => $id,
            "id_question" => $id_question
        ]);
    }
}