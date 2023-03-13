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

        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $security->getUser();
            $email = $user->getEmail();
            $name = $user->getName();
            $firstname = $user->getFirstname();
            $defaultNumberOfGuests = $user->getDefaultNumberOfGuests();
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


    //Permet de récupérer le champ service de manière dynamique en fonction de l'heure sélectionnée.
    // #[Route('/reservationService', name: 'app_reservationService', methods: ['POST', 'GET'])]
    // public function updateService(Request $request, EntityManagerInterface $entityManager, ReservationRepository $reservationRepository): Response
    // {
    //     $reservationHour = $request->query->get('');
    
    //     // Récupérez la réservation correspondant à l'heure sélectionnée à partir de la base de données
    //     $reservation = $reservationRepository->findOneBy(['reservationHour' => $reservationHour]);
    
    //     // Récupérez le service associé à la réservation
    //     $service = $reservation->getService();
    
    //     // Renvoyez le nom du service au format JSON
    //     return new JsonResponse($service->getName());
    // }

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
        //Je récupère les données du formulaire en JSON.
        //$data = $request ->getContent(); Ne fonctionne pas à priori.

        // ou 

        //$data = $request->request->all(); = renvoie un tableau des données.
        //$data = json_decode($request->getContent(), true); = ancienne méthode PHP

        //$data = json_decode($formData['data'], true);

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
        //dd($nbrTotalOfPlaces);


//OK MAIS RECUPERE TOUTES LES RESAS, A VOIR SI FONCTIONNE DANS LE CALCUL
        // //Je récupère l'accès pour la date en bdd.
        $reservationDate = $reservationRepository->findAll();
        //dd($reservationDate);
        // $reservationDate = $reservationRepository->
        // findOneBy(['reservationDate' => 'reservationDate'])->getReservationDate();
        // dd($reservationDate);

//OK MAIS RECUPERE TOUTES LES RESAS, A VOIR SI FONCTIONNE DANS LE CALCUL
        // //Je récupère l'accès pour l'heure en bdd.
        $reservationHour = $reservationTimeRepository->findAll();
        //dd($reservationHour);
        // // $reservationHour = $reservationTimeRepository->
        // // findOneBy(['reservationHour' => 'reservationHour'])->getHour();

        // //Ou
        

//A VOIR COMMENT S'EN SERVIR
        // //Je récupère l'accès pour le service en bdd.
        //$reservationService = $reservationTimeRepository->findAll();
        // $reservationService = $reservationTimeRepository->findOneBy(['hour' => 'hour']);
        // dd($reservationService);
        // $reservationService = $reservationTimeRepository->
        // findOneBy(['reservationHour' => 'reservationHour'])->getService();
        // dd($reservationService);

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
        // //Ou est-ce possible de faire un :
        // // if $resaTime == '12:00', '12h15', '12h30', etc...  alors $nbrTotalOfPlaces = $nbrTotalOfPlacesLunch
        // // elseif $resaTime == '19:00', '19h15', '19h30', etc...  alors $nbrTotalOfPlaces = $nbrTotalOfPlacesDinner
        // //Ou if $resaTime is between '12:00' and '14:00' alors $nbrTotalOfPlaces = $nbrTotalOfPlacesLunch
        // // elseif $resaTime is between '19:00' and '21:00' alors $nbrTotalOfPlaces = $nbrTotalOfPlacesDinner
        // //Du coup modifier table 'restaurant' pour mettre deux services avec un nombre de places pour chaque service ??
        // //Ou encore faire une autre table 'services' avec un id, un nom et un nombre de places ???







        if ($form->isSubmitted() && $form->isValid()) {
            $reservation = $form->getData(); // Utile de le remettre ou pas ????


            $entityManager->persist($reservation);
            $entityManager->flush();
        
        // Je retourne une réponse en JSON.
        //return $this->redirectToRoute('app_home'); (pour tester grâce à la redirection vers la page d'accueil si cela fonctionne)
        return $this->json([
            'status' => 'ok',
            'message' => 'Réservation effectuée avec succès !',
            ]);
        //     return $this->redirectToRoute('app_home');
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


