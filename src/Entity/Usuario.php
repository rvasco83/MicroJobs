<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 * @UniqueEntity("email", message="Esse e-mail já está em uso")
 */
class Usuario implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Campo nome não pode ser vazio!")
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Campo email não pode ser vazio!")
     * @Assert\Email(message="Informe um e-mail válido!")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Informe sua senha!")
     */
    private $senha;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $token;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Gedmo\Timestampable(on="create")
     *
     */
    private $data_cadastro;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Gedmo\Timestampable(on="update")
     *
     */
    private $data_alteracao;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles;

    public function __construct ()
    {
        $this->status = false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    public function setDataCadastro($data_cadastro)
    {
        $this->data_cadastro = $data_cadastro;

        return $this;
    }

    public function getDataAlteracao()
    {
        return $this->data_alteracao;
    }

    public function setDataAlteracao($data_alteracao)
    {
        $this->data_alteracao = $data_alteracao;

        return $this;
    }

    public function setRoles($roles)
    {
        $this->roles[] = $roles;
        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles ()
    {
        return $this->roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword ()
    {
        return $this->senha;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt ()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername ()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials ()
    {
        return null;
    }
}
