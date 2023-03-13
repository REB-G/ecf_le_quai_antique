<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Services;
use App\Entity\Users;
use App\Controller\SecurityController;
use App\Form\ReservationFormType;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use App\Repository\ReservationTimeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController //Faire un ou deux controllers ????
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        ReservationRepository $reservationRepository,
        ManagerRegistry $doctrine,
        SecurityController $security
        ): Response
    {
        $entityManager = $doctrine->getManager(); // Gère les entités.
        $reservation = new Reservation();
        $form = $this->createForm(ReservationFormType::class, $reservation);
        //$form->handleRequest($request);


        //NE FONCTIONNE PAS !!!!!!
        //Je récupère les infos de l'utilisateur connecté pour les pré-remplir dans le formulaire.
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $security->getUser();
            $email = $user->getEmail();
            $name = $user->getName();
            $firstname = $user->getFirstname();
            $defaultNumberOfGuests = $user->getDefaultNumberOfGuests();
            //Problème pour gérer les allergies car table de jointure ????
            //$allergy = $user->getAllergy();
            //dd($user, $email, $name, $firstname, $defaultNumberOfGuests);

            //$reservation->setUser($user);
            $reservation->setEmail($email);
            $reservation->setName($name);
            $reservation->setFirstname($firstname);
            $reservation->setNumberOfGuests($defaultNumberOfGuests);
            //$reservation->addAllergy($allergy);
            //dd($reservation);
        }
    
        return $this->render('reservation/reservation.html.twig', [
            'controller_name' => 'ReservationController',
            'reservationForm' => $form->createView(),
        ]);
    }

    #[Route('/reservationAPI', name: 'app_reservationAPI', methods: ['POST', 'GET'])]
    public function API(
        Request $request,
        ManagerRegistry $doctrine,
        EntityManagerInterface $entityManager,
        ReservationRepository $reservationRepository,
        RestaurantRepository $restaurantRepository,
        ReservationTimeRepository $reservationTimeRepository,
        ): JSONResponse
    {
//Je ne sais pas encore si je dois l'utiliser.

        $entityManager = $doctrine->getManager(); // Gère les entités.

        $reservation = new Reservation();

        $form = $this->createForm(ReservationFormType::class, $reservation);
        $form->handleRequest($request); //Récupère les infos du formulaire ???

        // $data = $form->getData(); //POur récupérer les données du formulaire ???
        

        // $numberOfGuests = $form->$this->getNumberOfGuests();
        // dd($numberOfGuests);

//Je fais la logique pour la réservation.

//OK VALIDE
        // //Je récupère le nombre de places total du restaurant.
        $nbrTotalOfPlaces = $restaurantRepository->findOneBy(['name' => 'Le Quai Antique'])->getNbrTotalOfPlaces();

//OK MAIS RECUPERE TOUTES LES RESAS, A VOIR SI FONCTIONNE DANS LE CALCUL
        // //Je récupère l'accès pour la date en bdd.
        $reservationDate = $reservationRepository->findAll();

        // $reservationDate = $reservationRepository->
        // findOneBy(['reservationDate' => 'reservationDate'])->getReservationDate();

//OK MAIS RECUPERE TOUTES LES RESAS, A VOIR SI FONCTIONNE DANS LE CALCUL
        // //Je récupère l'accès pour l'heure en bdd.
        $reservationHour = $reservationTimeRepository->findAll();

        // // $reservationHour = $reservationTimeRepository->
        // // findOneBy(['reservationHour' => 'reservationHour'])->getHour();        

//A VOIR COMMENT S'EN SERVIRE
        // $numberOfGuests = $data ['numberOfGuests']; //Je dois le récupérer du formulaire.
        // dd($numberOfGuests);
        // $resaDate = $data ['reservationDate']; // Je dois le récupérer du formulaire.
        // dd($resaDate);
        // $resaTime = $data ['reservationHour']; //Je dois le récupérer du fomulaire.
        // dd($resaTime);

        // //Je récupère le nombre de places déjà réservées pour la date et l'heure souhaitée.
        // if ($resaDate == $reservationDate && $resaTime == $reservationService) {
        //     $nbrOfReservations = $reservationRepository->
        //     count(['numberOfGuests' => $request->query->get('numberOfGuests')]);
        // }

        // //Je récupère le nombre de places disponibles pour la date souhaitée.
        // $numberOfFreePlaces = $nbrTotalOfPlaces - $nbrOfReservations;

        // //Mettre en BDD un nbrPlacesLunch et un nbrPlacesDinner pour différencier plus facilement les services ???
        // //Travailler avec les services ou les heures ?
        // //Est-ce possible de faire un :
        // // if $resaTime == '12:00', '12h15', '12h30', etc...  alors $nbrTotalOfPlaces = $nbrTotalOfPlacesLunch
        // // elseif $resaTime == '19:00', '19h15', '19h30', etc...  alors $nbrTotalOfPlaces = $nbrTotalOfPlacesDinner
        // //Ou if $resaTime is between '12:00' and '14:00' alors $nbrTotalOfPlaces = $nbrTotalOfPlacesLunch
        // // elseif $resaTime is between '19:00' and '21:00' alors $nbrTotalOfPlaces = $nbrTotalOfPlacesDinner

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation = $form->getData();

            $entityManager->persist($reservation);
            $entityManager->flush();
        
        // Je retourne une réponse en JSON.
        return $this->json([
            'status' => 'ok',
            'message' => 'Réservation effectuée avec succès !',
            ]);
        } else {
            //Si non, je renvoie un message d'erreur.
            return $this->json([
                'status' => 'Nok',
                'message' => 'Impossible d\'effectuer la réservation, nombre de places disponibles insuffisant !',
            ]);
        }
    }
}






//Ancien controller de base: 

// <?php

// namespace App\Controller;

// use App\Entity\Reservation;
// use App\Form\ReservationFormType;
// use App\Repository\RestaurantRepository;
// use Doctrine\ORM\EntityManagerInterface;
// use App\Repository\ReservationRepository;
// use Doctrine\Persistence\ManagerRegistry;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\HttpFoundation\JsonResponse;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// class ReservationController extends AbstractController
// {
    // #[Route('/reservation', name: 'app_reservation')]
    // public function index(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $reservation = new Reservation();
    //     $form = $this->createForm(ReservationFormType::class, $reservation);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $reservation = $form->getData();
    //         $entityManager->persist($reservation);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_home');
    //     }

        

    //     return $this->render('reservation/reservation.html.twig', [
    //         'controller_name' => 'ReservationController',
    //         'reservationForm' => $form->createView(),
    //     ]);
    // }
//}


