<?php

namespace App\Controller;

use App\Entity\Usuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UsuariosController extends Controller
{
    /**
     * @Route("/usuarios", name="usuarios")
     */
    public function index()
    {
        return $this->render('usuarios/index.html.twig', [
            'controller_name' => 'UsuariosController',
        ]);
    }

    /**
     * @Route("/usuarios/login", name="login")
     * @Template("usuarios/login.html.twig")
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $user_name = $authUtils->getLastUsername();

        return [
            'last_username' => $user_name,
            'error' => $error
        ];
    }

    /**
     * @Route("/usuario/cadastrar", name="cadastrar_usuario")
     * @Template("usuarios/registro.html.twig")
     */
    public function cadastrar(Request $request)
    {
        $usuario = new Usuario();
        $form = $this->createForm(Usuario::class, $usuario);
        $form->handleRequest($request);

        return [
            'form' => $form->createView()
        ];
    }
}
