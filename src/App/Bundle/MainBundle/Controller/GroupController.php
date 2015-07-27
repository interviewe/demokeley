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

class GroupController extends FOSRestController {
	
	/**
	 * @ApiDoc(
	 *  description="Affichage des utilisateurs d'un groupe",
	 *  requirements={
	 *      {
	 *          "name"="id",
	 *          "dataType"="integer",
	 *          "requirement"="\d+",
	 *          "description"="id du groupe"
	 *      }
	 *  }
	 * )
	 */
	public function getGroupusersAction(Group $id) {
		return $id->getUsers();
	}
	
	/**
	 * @ApiDoc(
	 *  description="Affichage la liste de groupes",
	 *  output="App\Bundle\MainBundle\Entity\User"
	 * )
	 */
	public function getGroupsAction() {
		$em = $this->getDoctrine()->getManager();
		$result = $em->getRepository('AppMainBundle:Group')->findAll();
		return $result;
	}
	
	/**
	 * @ApiDoc(
	 *  description="Affichage d'un groupe par rapport a son id",
	 *  requirements={
	 *      {
	 *          "name"="id",
	 *          "dataType"="integer",
	 *          "requirement"="\d+",
	 *          "description"="id du groupe"
	 *      }
	 *  }
	 * )
	 */
	public function getGroupAction(Group $id) {
		return $id;
	}
}