<?php

namespace App\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Bundle\MainBundle\AppMainBundle;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use App\Bundle\MainBundle\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use App\Bundle\MainBundle\Entity\Group;
use Symfony\Component\HttpFoundation\Request;
use App\Bundle\MainBundle\Form\UserType;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Request\ParamFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class UserController extends FOSRestController
{

	/**
	 * @ApiDoc(
	 *  description="Affichage la liste d'utilisateurs et ces groupes",
	 *  output="App\Bundle\MainBundle\Entity\User"
	 * )
	 */
	public function getUsersAction() {
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery("SELECT u fROM AppMainBundle:User u");
		$result = $query->getResult();
		return $result;
	}
	
	/**
	 * @ApiDoc(
	 *  description="Affichage d'un utilisateur par rapport a son id",
	 *  requirements={
	 *      {
	 *          "name"="id",
	 *          "dataType"="integer",
	 *          "requirement"="\d+",
	 *          "description"="id de l'utilisateur"
	 *      }
	 *  }
	 * )
	 */
	public function getUserAction(User $id) {
		return $id; //returns full user object auto populated by symfony
	}
	
	
	/**
	 * @ApiDoc(
	 *  description="Affichage des groupes d'un utilisateur",
	 *  requirements={
	 *      {
	 *          "name"="id",
	 *          "dataType"="integer",
	 *          "requirement"="\d+",
	 *          "description"="id de l'utilisateur qu'on souhaite voir les groupes"
	 *      }
	 *  }
	 * )
	 */
	
	public function getUsergroupsAction(User $id) {
		return $id->getGroups();
	}
	
	/**
	 * 
	 * @ApiDoc(
	 *  description="Ajoute un groupe a un utilisateur",
	 *  requirements={
	 *      {
	 *          "name"="user",
	 *          "dataType"="integer",
	 *          "requirement"="\d+",
	 *          "description"="id de l'utilisateur qu'on souhaite ajouter un groupe"
	 *      },
	 *      {
	 *          "name"="group",
	 *          "dataType"="integer",
	 *          "requirement"="\d+",
	 *          "description"="id du groupe qu'on souhaite ajouter a l'utilisateur"
	 *      }
	 *  }
	 * )
	 */
	public function postUsergroupsAction($group, User $user) {
		echo $user->getFirstName();
		echo $group->getName();
		exit;
	}
	
	/**
	 * @ApiDoc(
	 *  description="Ajoute un utilisateur dans la base de donnees",
	 *  requirements={
	 *      {
	 *          "name"="id",
	 *          "dataType"="integer",
	 *          "requirement"="\d+",
	 *          "description"="id de l'utilisateur"
	 *      },
	 *      {
	 *          "name"="email",
	 *          "dataType"="string",
	 *          "requirement"="\d+",
	 *          "description"="Adresse Email de l'utilisateur"
	 *      },
	 *      {
	 *          "name"="firstName",
	 *          "dataType"="string",
	 *          "requirement"="\d+",
	 *          "description"="prénom de l'utilisateur"
	 *      },
	 *      {
	 *          "name"="lastName",
	 *          "dataType"="string",
	 *          "requirement"="\d+",
	 *          "description"="Nom de l'utilisateur"
	 *      },
	 *      {
	 *          "name"="isActive",
	 *          "dataType"="boolean",
	 *          "requirement"="\d+",
	 *          "description"="Utilisateur actif?"
	 *      }
	 *      
	 *  }
	 * )
	 */
	public function postUserAction(Request $request) {
		$user = new User();
	
		$form = $this->createForm(new UserType(),
				$user,
				array('method' => $request->getMethod()));
	
		$form->handleRequest($request);
	
		$errors = $this->get('validator')->validate($user);
	
		if(count($errors) > 0) {
			return new View($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
		}
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($user);
		$em->flush();
	
		return new View($user, Response::HTTP_CREATED);
	}
	
	
	/**
	 * @ApiDoc(
	 *  description="Modification d'un utilisateur dans la base de donnees",
	 *  requirements={
	 *      {
	 *          "name"="usr",
	 *          "dataType"="integer",
	 *          "requirement"="\d+",
	 *          "description"="id de l'utilisateur"
	 *      },
	 *      {
	 *          "name"="email",
	 *          "dataType"="string",
	 *          "requirement"="\d+",
	 *          "description"="Adresse Email de l'utilisateur"
	 *      },
	 *      {
	 *          "name"="firstName",
	 *          "dataType"="string",
	 *          "requirement"="\d+",
	 *          "description"="prénom de l'utilisateur"
	 *      },
	 *      {
	 *          "name"="lastName",
	 *          "dataType"="string",
	 *          "requirement"="\d+",
	 *          "description"="Nom de l'utilisateur"
	 *      },
	 *      {
	 *          "name"="isActive",
	 *          "dataType"="boolean",
	 *          "requirement"="\d+",
	 *          "description"="Utilisateur actif?"
	 *      }
	 *
	 *  }
	 * )
	 */
	public function putUserAction(User $id, Request $request) {
		$user = $id;
		
		$form = $this->createForm(new UserType(),
				$user,
				array('method' => $request->getMethod()));
		
		$form->handleRequest($request);
		
		$errors = $this->get('validator')->validate($user);
		
		if(count($errors) > 0) {
			return new View($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
		}
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($user);
		$em->flush();
		
		return '';
	}
	
	/**
	 * @ApiDoc(
	 *  description="Efface un utilisateur de la base de donnees",
	 *  requirements={
	 *      {
	 *          "name"="id",
	 *          "dataType"="integer",
	 *          "requirement"="\d+",
	 *          "description"="id de l'utilisateur qu'on souhaite effacer"
	 *      }
	 *  }
	 * )
	 */
	public function deleteUserAction(User $id) {
		$em = $this->getDoctrine()->getManager();
		$em->remove($id);
		$em->flush();
		return '';
	}
}
