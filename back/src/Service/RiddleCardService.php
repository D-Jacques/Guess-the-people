<?php

namespace App\Service;

use App\Entity\RiddleCard;
use App\Repository\RiddleCardRepository;

class RiddleCardService {

    public function __construct(private RiddleCardRepository $riddleCardRepository)
    {}

    public function riddleFormatter(): array{
        $riddleIdList = $this->riddleCardRepository->findAllIds();
        shuffle($riddleIdList);
        array_splice($riddleIdList, RiddleCard::RIDDLE_QUESTIONNAIRE_LENGTH);
        $riddles = $this->riddleCardRepository->findRiddlesInIds($riddleIdList);
        if(!empty($riddles)){
            $goodAnswerKey = array_rand($riddles);
            foreach($riddles as $riddleKey => $riddle){
                if($riddleKey === $goodAnswerKey){
                    $riddles[$riddleKey]['isGoodAnswer'] = true;
                } else {
                    $riddles[$riddleKey]['isGoodAnswer'] = false;
                }
            }
        }
        return $riddles;
    }

}