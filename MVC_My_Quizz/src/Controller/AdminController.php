<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Question;
use App\Entity\Reponse as QuizResponse;
use App\Entity\Score;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    public function adminList(): Response
    {
        $admins = array_filter($this->getDoctrine()->getRepository(User::class)->findAll(), function ($user) {
            return $user->getRoles() === ["ROLE_ADMIN"];
        });
        if ($this->getUser() !== null && $this->getUser()->getRoles() === ["ROLE_ADMIN"]) {
            return $this->render('admin/adminList.html.twig', [
                "users" => $admins
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
        if ($this->getUser() !== null && $this->getUser()->getRoles() === ["ROLE_ADMIN"]) {
            $info = $this->getDoctrine()->getRepository(Score::class)->findInfo();
            return $this->render("admin/quizzInfo.html.twig", [
                "info" => $info
            ]);
        } else return $this->redirectToRoute("home");

    }

    public function showQuizz(int $id): Response
    {
        if ($this->getUser() !== null && $this->getUser()->getRoles() === ["ROLE_ADMIN"]) {
            $questions = $this->getDoctrine()->getRepository(Question::class)->findBy(["idCategorie" => $id]);
            $played = count((array)$this->getDoctrine()->getRepository(Score::class)->find($id));
            return $this->render("admin/showQuizz.html.twig", [
                "questions" => $questions,
                "played" => $played
            ]);
        } else return $this->redirectToRoute("home");
    }

    public function quizzList(): Response
    {
        if ($this->getUser() !== null && $this->getUser()->getRoles() === ["ROLE_ADMIN"]) {
            $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
            return $this->render("admin/quizzList.html.twig", [
                "categories" => $categories
            ]);
        } else return $this->redirectToRoute("home");
    }

    public function deleteQuizz(int $id): Response
    {
        if ($this->getUser() !== null && $this->getUser()->getRoles() === ["ROLE_ADMIN"]) {
            $entityManager = $this->getDoctrine()->getManager();
            $quizz = $this->getDoctrine()->getRepository(Categorie::class)->find($id);
            $questions = $this->getDoctrine()->getRepository(Question::class)->findBy(["idCategorie" => $id]);
            $scores = $this->getDoctrine()->getRepository(Score::class)->findBy(["categorie" => $id]);
            $entityManager->remove($quizz);
            foreach ($questions as $question)
                $entityManager->remove($question);
            foreach ($scores as $score)
                $entityManager->remove($score);
            $entityManager->flush();
            return $this->redirectToRoute("admin_quizz_list");
        } else return $this->redirectToRoute("home");
    }

    public function createAdmin(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        if ($this->getUser() !== null && $this->getUser()->getRoles() === ["ROLE_ADMIN"])
            if($request->getMethod() === "POST")
                if (filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL) && strlen($_POST["password"]) >= 8 && $_POST["username"] !== ""){
                    $entityManager = $this->getDoctrine()->getManager();
                    $admin = new User();
                    $admin->setRoles(["ROLE_ADMIN"])
                        ->setEmail($_POST["mail"])
                        ->setUsername($_POST["username"])
                        ->setPassword($passwordEncoder->encodePassword($admin, $_POST["password"]));
                    $entityManager->persist($admin);
                    $entityManager->flush();
                    return $this->render("admin/createAdmin.html.twig", [
                        "msg" => "Admin successfully created!"
                    ]);
                }
                else return $this->render("admin/createAdmin.html.twig", [
                    "msg" => "Error in the information!"
                ]);
            else return $this->render("admin/createAdmin.html.twig");
        else return $this->redirectToRoute("home");
    }

    public function deleteUser(int $id): Response
    {
        if ($this->getUser() !== null && $this->getUser()->getRoles() === ["ROLE_ADMIN"]) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $this->getDoctrine()->getRepository(User::class)->find($id);
            $entityManager->remove($user);
            $entityManager->flush();
            return $this->redirectToRoute("admin");
        } else return $this->redirectToRoute("home");
    }

    public function showQuestion(int $id): Response
    {
        if ($this->getUser() !== null && $this->getUser()->getRoles() === ["ROLE_ADMIN"]) {
            $question = $this->getDoctrine()->getRepository(Question::class)->find($id);
            $responses = $this->getDoctrine()->getRepository(QuizResponse::class)->findBy(["idQuestion" => $question->getId()]);
            return $this->render("admin/question.html.twig", [
                "question" => $question,
                "responses" => $responses
            ]);
        } else return $this->redirectToRoute("home");
    }
}
