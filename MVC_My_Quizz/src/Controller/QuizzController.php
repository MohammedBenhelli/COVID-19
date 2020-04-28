<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Question;
use App\Entity\Reponse as QuizResponse;
use App\Entity\Score;
use Doctrine\DBAL\Schema\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Yaml;

class QuizzController extends AbstractController
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
    }

    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        return $this->render("quizz/index.html.twig", [
            "categories" => $categories,
            "logout" => $this->isLogged()
        ]);
    }

    private function isLogged(): bool
    {
        if ($this->getUser()) return true;
        else return false;
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
                "number" => ++$id_question,
                "logout" => $this->isLogged()
            ]);
        } else {
            $result = count(array_filter($_SESSION["id_quizz"][1], function ($value) {
                return $value === true;
            }));
            $entityManager = $this->getDoctrine()->getManager();
            if ($this->getDoctrine()->getRepository(Score::class)->findBy(['user' => $this->getUser()->getId(), 'categorie' => $_SESSION["id_quizz"][0]]))
                $score = $this->getDoctrine()->getRepository(Score::class)->findBy(['user' => $this->getUser()->getId(), 'categorie' => $_SESSION["id_quizz"][0]])[0];
            else $score = new Score();
            $score->setCategorie($_SESSION["id_quizz"][0]);
            $score->setScore($result);
            $score->setUser($this->getUser()->getId());
            $entityManager->persist($score);
            $entityManager->flush();
            return $this->render("quizz/result.html.twig", [
                "result" => $result,
                "logout" => $this->isLogged()
            ]);
        }
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

    public function createQuizz(): Response
    {
        $textarea = file_get_contents("textarea.yaml");
        return $this->render("quizz/create.html.twig", [
            "textarea" => $textarea,
            "logout" => $this->isLogged()
        ]);
    }

    public function sendQuizz(Request $request): Response
    {
        if(isset($_FILES["yamlInput"]["tmp_name"]))
            $quizz = Yaml::parseFile($_FILES["yamlInput"]["tmp_name"])["quizz"];
        else $quizz = Yaml::parse($_POST["quizzInput"])["quizz"];
        if (!$this->getDoctrine()->getRepository(Categorie::class)->findBy(["name" => $quizz["title"]]) && count($quizz["questions"]) === 10) {
            $entityManager = $this->getDoctrine()->getManager();
            $categorie = new Categorie();
            $categorie->setName($quizz["title"]);
            $entityManager->persist($categorie);
            $entityManager->flush();
            foreach ($quizz["questions"] as $value) {
                $question = new Question();
                $question->setIdCategorie($categorie->getId())
                    ->setQuestion($value["name"]);
                $entityManager->persist($question);
                $entityManager->flush();
                foreach ($value as $key => $response) {
                    if ($key !== "name") {
                        $r = new QuizResponse();
                        $r->setReponse($response["content"])
                            ->setIdQuestion($question->getId())
                            ->setReponseExpected($response["answer"]);
                        $entityManager->persist($r);
                        $entityManager->flush();
                    }
                }
            }
            return $this->redirectToRoute("home");
        } else dd("deja existant");
    }
}
