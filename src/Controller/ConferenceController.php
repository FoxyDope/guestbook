<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Conference;
use App\Form\CommentFormType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ConferenceRepository;

class ConferenceController extends AbstractController
{
    private Environment $twig;
    private EntityManagerInterface $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'homepage')]
    public function index(ConferenceRepository $conferenceRepository): Response
    {
        return new Response($this->twig->render('conference/index.html.twig', []));
    }

    #[Route('/conference/{slug}', name: 'conference')]
    public function show(
        Conference $conference,
        Request $request,
        CommentRepository $commentRepository,
        string $photoDir
    ): Response {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setConference($conference);
            if ($photo = $form['photo']->getData()) {
                $filename = bin2hex(random_bytes(6)).'.'.$photo->guessExtension();

                try {
                    $photo->move($photoDir, $filename);
                } catch (FileException $e) {

                }

                $comment->setPhoto($filename);
            }
            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            return $this->redirectToRoute('conference', ['slug' => $conference->getSlug()]);
        }

        return new Response($this->twig->render('conference/show.html.twig', [
            'conference' => $conference,
            'comments' => $commentRepository->findBy(['conference' => $conference], ['createdAt' => 'DESC']),
            'comment_form' => $form->createView(),
        ]));
    }
}

