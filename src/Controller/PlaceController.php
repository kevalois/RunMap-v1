<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Place;

use App\Entity\Review;
use App\Form\CityType;
use App\Form\PlaceType;

use App\Form\ReviewType;
use App\Form\PlaceEditType;
use App\Repository\CityRepository;

use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlaceController extends AbstractController
{
    /**
     * @Route("/places", name="allPlaces")
     */
    public function allPlaces(PlaceRepository $repository)
    {
        $places = $repository->findAll();

        return $this->render('place/index.html.twig', [
            'places' => $places,
        ]);
    }

    /**
     * @Route("/place/{id}", name="place")
     */
    public function showPlace(Place $place, Request $request) 
    {
        $reviews = $place->getReviews();
        $review = new Review();
        $user = $this->getUser();
        // create form
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $review->setUser($user);
            $review->setPlace($place);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            $entityManager->flush();
        
            // return message
            $this->addFlash('success', 'Avis ajouté');
            return $this->redirectToRoute('place', ['id' => $place->getId()]);
        }

        return $this->render('place/show.html.twig', [
            'reviews' => $reviews,
            'place' => $place,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/create/place", name="new_place")
     * @IsGranted("ROLE_USER")
     */
    public function newPlace(Request $request, CityRepository $cityRepository, EntityManagerInterface $manager)
    {
        //form city
        $newCity = new City();
        $formCity = $this->createForm(CityType::class, $newCity);
        $formCity->handleRequest($request);
        //form place
        $newPlace = new Place();
        $formPlace = $this->createForm(PlaceType::class, $newPlace);
        $formPlace->handleRequest($request);
        //request name in $city
        $city = $formCity["name"]->getData();
        //search $city in bdd and return in the result $cityNameBdd
        $cityNameBdd = $cityRepository->findOneByName($city);
        if ($formCity->isSubmitted() && $formCity->isValid()){
            //$cityNameBdd is null, register city request on bdd
            if ($cityNameBdd === null){
                $cityName = $formCity["name"]->getData();
                $cityPostal = $formCity["postalcode"]->getData();

                $newCity->setName($cityName);
                $newCity->setPostalcode($cityPostal);

                $manager->persist($newCity);
                $manager->flush();
                //take the new object in $cityId
                $cityId = $newCity;

            } else {
                //$cityNameBdd exist, take the object
                $cityId = $cityNameBdd;
            }

        if ($formPlace->isSubmitted() && $formPlace->isValid()){
            $placeName = $formPlace["name"]->getData();
            $placeAdress = $formPlace["adress"]->getData();
            $placeSchedule = $formPlace["schedule"]->getData();
            $placeComplementInfo = $formPlace["complementinfo"]->getData();

            $newPlace->setName($placeName);
            $newPlace->setAdress($placeAdress);
            $newPlace->setSchedule($placeSchedule);
            $newPlace->setComplementinfo($placeComplementInfo);
            //set $cityId
            $newPlace->setCity($cityId);
            $manager->persist($newPlace);
            $manager->flush();
            
            return $this->redirectToRoute('place', ['id' => $newPlace->getId()]);
        }
    }        

        return $this->render('place/new_place.html.twig', [
            'formCity' => $formCity->createView(),
            'formPlace' => $formPlace->createView(),
        ]);
    }

    /**
     * @Route("/edit/place/{id}", name="edit_place")
     * @IsGranted("ROLE_USER")
     */
    public function edit_place($id, Request $request)
    {
        $place = $this->getDoctrine()->getRepository(Place::class)->find($id);
        $form = $this->createForm(PlaceEditType::class, $place);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('warning', 'lieu modifié');
            return $this->redirectToRoute('place', ['id' => $place->getId()]);
        }
        return $this->render('place/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
