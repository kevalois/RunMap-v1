<?php

namespace App\Controller\Admin;

use App\Entity\Place;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlaceController extends AbstractController
{
    /**
    * @Route("/delete/place/{id}", name="delete_place")
    * @IsGranted("ROLE_ADMIN")
    */
    public function deletePlace($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $place = $entityManager->getRepository(Place::class)->find($id);

        $entityManager->remove($place);
        $entityManager->flush();
        return $this->redirectToRoute('allPlaces');

    }
}
