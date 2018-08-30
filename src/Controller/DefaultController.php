<?php

namespace App\Controller;


use App\Entity\Servico;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;

class DefaultController extends Controller
{
    protected  $em;

    public function __construct (EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/", name="default")
     * @Template("default/index.html.twig")
     */
    public function index()
    {
        $micro_jobs = $this->em->getRepository(Servico::class)->findByListagem();

        return [
            'micro_jobs' => $micro_jobs
        ];
    }

    /**
     * @Route("/painel", name="painel")
     * @Template("default/painel.html.twig")
     * @param UserInterface $user
     * @return array
     */
    public function painel(UserInterface $user, Request $request)
    {
        $status = $request->get("busca_filtro");
        $micro_jobs = $this->em->getRepository(Servico::class)
            ->findByUsuarioAndStatus($user, $status);

        return [
            'micro_jobs' => $micro_jobs,
            'status' => $status
        ];
    }
}
