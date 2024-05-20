<?php

namespace App\Controller\Api;

use App\Entity\RiddleCard;
use App\Repository\RiddleCardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api/riddle", name : "backoffice_api_riddle_")]
class RiddleCardControllerApi extends AbstractController {

    public function __construct(private RiddleCardRepository $riddleCardRepository){
    }

    #[Route("/get-riddle-questionnaire", name : "get_riddle_questionnaire")]
    public function getRiddleQuestionnaire(){
        $riddleIdList = $this->riddleCardRepository->findAllIds();
        shuffle($riddleIdList);
        array_splice($riddleIdList, RiddleCard::RIDDLE_QUESTIONNAIRE_LENGTH);
        $riddles = $this->riddleCardRepository->findRiddlesInIds($riddleIdList);
        $goodAnswerKey = array_rand($riddles);
        foreach($riddles as $riddleKey => $riddle){
            if($riddleKey === $goodAnswerKey){
                $riddles[$riddleKey]['isGoodAnswer'] = true;
            } else {
                $riddles[$riddleKey]['isGoodAnswer'] = false;
            }
        }
        // dd(json_encode($riddles));
        return new JsonResponse($riddles);
    }

}