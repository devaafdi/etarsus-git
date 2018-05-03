<?php

namespace App\Controller;

use App\Entity\TarsusUser;
use App\Entity\TarsusDivision;
use App\Form\TarsusUserType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class UserController extends Controller
{
    /**
     * @Route("/", name="user")
     */
    public function homepage()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/user/create", name="createUser")
     */
    public function createUser( Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        Debug::enable();
        $tUser = new TarsusUser;
        $form = $this->createForm(TarsusUserType::class,$tUser);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $password = $passwordEncoder->encodePassword($tUser, $tUser->getCPassword());
            $tUser->setPassword($password);
            $time = date('Y-m-d H:i');
            $tUser->setCreateDate(\DateTime::createFromFormat('Y-m-d H:i',$time));
            $tUser->setUpdateDate(\DateTime::createFromFormat('Y-m-d H:i',$time));
            $tUser->setUsername($tUser->getEmailAddress());
            dump($tUser);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tUser);
            $entityManager->flush();

            return $this->redirectToRoute('user');
        }

        return $this->render('user/createUser.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/list", name="listUser")
     */
    public function listUser()
    {
        $listUsers = $this->getDoctrine()
            ->getRepository(TarsusUser::class)
            ->findAll();

        $listDivision = $this->getDoctrine()
            ->getRepository(TarsusDivision::class)
            ->findAll();

        if(!$listUsers){
            return $this->render('user/listUser.html.twig', [
                'controller_name' => 'UserController',
                'dataUser' => $listUsers
            ]);
            /*throw $this->createNotFoundException(
                'No user has been registered by the administrator'
            );*/
        }else{
            dump($listUsers);
            return $this->render('user/listUser.html.twig', [
                'controller_name' => 'UserController',
                'dataUser' => $listUsers
            ]);
        }
    }

    /**
     * @Route("/user/{idUser}", name="updateUser", requirements={"idUser"="\d+"})
     */
    public function updateUser($idUser, Request $request, UserInterface $user)
    {
        if($idUser == 0){
            $idUser = $user->getId();
        }
        $listUsers = $this->getDoctrine()
            ->getRepository(TarsusUser::class)
            ->find($idUser);

        if(!$listUsers){
            throw $this->createNotFoundException(
                'No user has been registered by the administrator'
            );
        }else {

            $form = $this->createForm(TarsusUserType::class,$listUsers, array(
                'validation_groups' => array('updateUser'),
                'set_button_label' => "Update User"
            ))
                ->remove('cPassword');
            //dump($form);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $time = date('Y-m-d H:i');
                $listUsers->setUpdateDate(\DateTime::createFromFormat('Y-m-d H:i',$time));
                $entityManager = $this->getDoctrine()->getManager();
                dump($listUsers);
                $updateUser = $entityManager->getRepository(TarsusUser::class)->find($idUser);
                if (!$updateUser) {
                    throw $this->createNotFoundException(
                        'No product found for id '.$idUser
                    );
                }
                //$entityManager->persist($listUsers);
                $entityManager->flush();

                return $this->redirectToRoute('listUser');
            }
            return $this->render('user/updateUser.html.twig', [
                'controller_name' => 'UserController',
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/user/delete/{idUser}", name="deleteUser", requirements={"idUser"="\d+"})
     */
    public function deleteUser($idUser)
    {
        $listUsers = $this->getDoctrine()
            ->getRepository(TarsusUser::class)
            ->find($idUser);

        if(!$listUsers){
            throw $this->createNotFoundException(
                'No user has been registered by the administrator'
            );
        }else {
            $entityManager = $this->getDoctrine()->getManager();
            $removeUser = $entityManager->getRepository(TarsusUser::class)->find($idUser);
            if (!$removeUser) {
                throw $this->createNotFoundException(
                    'No product found for id '.$idUser
                );
            }
            $entityManager->remove($removeUser);
            $entityManager->flush();

            return $this->redirectToRoute('listUser');
        }
    }

    /**
     * @Route("/login", name="login")
     */
    public function userLogin(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername  = $authenticationUtils->getLastUsername();


        return $this->render('user/loginUser.html.twig', array(
            'last_emailaddress' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function userLogout()
    {
        throw new \RuntimeException('This should never be called directly.');
    }
}
