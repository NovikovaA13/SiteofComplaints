<?php

namespace App\Controller;

use App\Repository\ComplaintRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ComplaintRepository $complaintRepository, Request $request): Response
    {
        $complaints = Pagerfanta::createForCurrentPageWithMaxPerPage(new QueryAdapter($complaintRepository->getAll()), $request->query->get('page', 1), 10);
        return $this->render('complaint/index.html.twig', [
            'complaints' => $complaints,
        ]);
    }
}
