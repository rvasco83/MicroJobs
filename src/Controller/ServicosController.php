<?php

namespace App\Controller;

use App\Entity\Servico;
use App\Form\ServicoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ServicosController extends AbstractController
{
    /**
     * @Route("/servicos", name="servicos")
     */
    public function index()
    {
        return $this->render('servicos/index.html.twig', [
            'controller_name' => 'ServicosController',
        ]);
    }

    /**
     * @Route("/painel/servicos/cadastrar", name="cadastrar_job")
     * @Template("servicos/novo-micro-jobs.html.twig")
     */
    public function cadastrar(Request $request)
    {
        $servico = new Servico();
        $form = $this->createForm(ServicoType::class, $servico);
        $form->handleRequest($request);

        return[
            'form' => $form->createView()
        ];
    }
}
