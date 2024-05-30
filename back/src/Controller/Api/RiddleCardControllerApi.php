<?php

namespace App\Controller\Api;

use App\Entity\RiddleCard;
use App\Repository\RiddleCardRepository;
use App\Service\RiddleCardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api/riddle", name : "backoffice_api_riddle_")]
class RiddleCardControllerApi extends AbstractController {

    public function __construct(private RiddleCardService $riddleCardService){
    }

    #[Route("/get-riddle-questionnaire", name : "get_riddle_questionnaire")]
    public function getRiddleQuestionnaire(): JsonResponse{
        return new JsonResponse($this->riddleCardService->riddleFormatter());
    }

}