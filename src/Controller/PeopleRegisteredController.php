<?php

namespace App\Controller;

use App\Entity\PeopleRegistered;
use App\Form\PeopleRegisteredType;
use App\Form\PeopleConsultedType;
use App\Repository\PeopleRegisteredRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeopleRegisteredController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index() : Response
    {
        $data['titulo']  = 'Sistema de Cadastro e Consulta NIS';

        return $this->render('people/index.html.twig', $data);
    }

    #[Route('/adicionar', name: 'adicionar', methods: ['GET', 'POST'])]
    public function adicionar(Request $request, EntityManagerInterface $em, PeopleRegisteredRepository $peopleRegisteredRepository) : Response
    {
        $message = "";

        $peopleRegistered = new PeopleRegistered();

        $form = $this->createForm(PeopleRegisteredType::class, $peopleRegistered);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $nis = $this->gerarNIS();
            $peopleRegistered->setNis($nis);

            $em->persist($peopleRegistered);
            $em->flush();

            $nome = $form->get('nome')->getData();

            $people =$peopleRegisteredRepository->findOneBy(['nome' => $nome]);
            $nisFound = $people->getNis();

            $message = "Código do NIS Gerado com Sucesso! NIS nº ".$nisFound;

            if ($request->isXmlHttpRequest()) {
                $response = [
                    'success' => true,
                    'message' => $message
                ];
                return new JsonResponse($response);
            }
        }

        $data['titulo']  = 'Criar Novo Cadastro NIS';
        $data['form']    = $form;
        $data['message'] = $message;

        if ($request->isXmlHttpRequest()) {
            $response = [
                'success' => false,
                'message' => 'Erro ao processar o formulário'
            ];
            return new JsonResponse($response, JsonResponse::HTTP_BAD_REQUEST);
        }

        return $this->renderForm('people/form.html.twig', $data);
    }

    #[Route('/consultar', name: 'consultar', methods: ['GET', 'POST'])]
    public function consultar(Request $request, EntityManagerInterface $em, PeopleRegisteredRepository $peopleRegisteredRepository) : Response
    {
        $message = "";

        $peopleRegistered = new PeopleRegistered();

        $form = $this->createForm(PeopleConsultedType::class, $peopleRegistered);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $nis = $form->get('nis')->getData();

            $people = $peopleRegisteredRepository->findOneBy(['nis' => $nis]);

            if($people !== null) {
                $message = "Cidadão Encontrado: ".$people->getNome();
            } else {
                $message = "Cidadão não encontrado.";
            }

            if ($request->isXmlHttpRequest()) {
                $response = [
                    'message' => $message
                ];
                return new JsonResponse($response);
            }
        }

        $data['titulo']  = 'Buscar Usuário pelo NIS';
        $data['form']    = $form;
        $data['message'] = $message;

        if ($request->isXmlHttpRequest()) {
            $response = [
                'message' => 'Erro ao processar o formulário'
            ];
            return new JsonResponse($response, JsonResponse::HTTP_BAD_REQUEST);
        }

        return $this->renderForm('people/search.html.twig', $data);
    }

    private function gerarNIS(): string
    {
        $nis = '';
        for ($i = 0; $i < 11; $i++) {
            $nis .= mt_rand(0, 9);
        }
        return $nis;
    }
}