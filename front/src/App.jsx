import { useEffect, useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import { RadioInput } from './components/RadioInput';

function App() {

  const urlBase = "https://127.0.0.1:8000/api";

  const [selectedResponse, setSelectedResponse] = useState(null);
  const [isGoodAnswer, setIsGoodAnswer] = useState(false);
  const [isBadAnswer, setIsBadAnswer] = useState(false);
  const [responses, setResponses] = useState({});
  const [isLoadingData, setIsLoadingData] = useState(true);
  // const responses = [
  //   {"id" : "repA", "label" : "Réponse A", "isGoodAnswer" : false, "description": "Je suis un inventeur"},
  //   {"id" : "repB", "label" : "Réponse B", "isGoodAnswer" : false, "description": "Je suis un chanteur"},
  //   {"id" : "repC", "label" : "Réponse C", "isGoodAnswer" : true, "description": "Je suis un célèbre médecin", "picture" : "https://127.0.0.1:8000/images/riddleCard/raccoon-6645f6b9db401105818082.jpg"},
  //   {"id" : "repD", "label" : "Réponse D", "isGoodAnswer" : false, "description": "Je suis un aviateur"}
  // ];

  // useEffect(() => {
  //   console.log(selectedResponse)
  // }, [selectedResponse]);

  /**
   * Reset the game and reload a new riddle
   */
  function handleReloadRiddle(){
    // LANCER UNE QUERY POUR CHERCHER UNE DEVINETTE ET 3 AUTRES REPONSES
    setSelectedResponse(null);
    setIsGoodAnswer(false);
  }

  useEffect(() => {
    fetch(urlBase+"/riddle/get-riddle-questionnaire",
      {
        method: "GET",
        headers: {
          'Content-type' : 'application/json'
        },
      }
    ).then((res) => {
      return res.json()
    }).then((data) => {
      setResponses(data);
      setIsLoadingData(false);
    });
  }, []);


  /**
   * Called when we hit the submit button when we're trying to guess the riddle
   * if the answer is right, we show "good answer screen" 
   * @returns 
   */
  function handleSubmit(){
    if(selectedResponse.isGoodAnswer){
      setIsGoodAnswer(true);
      setIsBadAnswer(false);
      return true;
    } else {
      setIsBadAnswer(true);
    }
  }

  /**
   * set the selectedResponse state by setting it with the selectedResponseId
   * @param {string} selectedResponseId 
   */
  function handleResponseCheck(selectedResponseId){
    setSelectedResponse(responses.find((response) => response.id === parseInt(selectedResponseId)));
  }

  function displayRiddleDescription(){
    return responses.find((response) => response.isGoodAnswer === true).description;
  }

  return (
    !isLoadingData &&
    <div className='app-layout'>
      <div className='w-1/2 mx-auto'>
        {/* Main title */}
        <h1 className='text-6xl text-center my-5 py-2 px-3'> PeopleGuesser </h1>

        { isBadAnswer && 
          // placer dans un composant ? => alert-component 
          <div className='wrong-answer-alert w-11/12 bg-red-200 text-red-600 text-center py-5 py-2 mx-auto mb-5 rounded-xl'> MAUVAISE REPONSE </div>
        }

        {/* Game area  A METTRE DANS UN COMPONENT */}
        <div className='game-zone w-11/12 mx-auto p-5 bg-slate-50'>
          { !isGoodAnswer &&
            // Placer dans un composant ?
            <>
              <p className='my-15 py-10'>
                { displayRiddleDescription() }
              </p>

                {
                  responses.map((response) => 
                    <RadioInput key={response.id} response={response} onCheck={handleResponseCheck} />
                  )
                }
                
                { selectedResponse && 
                  <div className='w-1/4 mx-auto'>
                    <button className='w-full bg-cyan-200 py-2 hover:bg-cyan-300' onClick={handleSubmit}>submit</button>
                  </div> 
                }
            </>
          }
          {
            isGoodAnswer &&
            // Placer dans un composant ?
            <>
              <h1 className='text-center my-3 w-2/3 mx-auto px-5 py-3'>BONNE REPONSE</h1>
              
              <div className='w-1/2 flex justify-around mx-auto mb-5'>
                <div className='photo-area' style={{
                  backgroundImage: `url(${"https://127.0.0.1:8000/images/riddleCard/"+selectedResponse.imageName})`,
                  backgroundRepeat: "none",
                  backgroundSize: "cover"
                }}>

                </div>

                <h2 className='content-center text-2xl'>{selectedResponse.name}</h2>
              </div>

              <div className='w-1/4 mx-auto'>
                <button className='w-full bg-cyan-200 py-2 hover:bg-cyan-300' onClick={handleReloadRiddle}> Une autre ! </button>
              </div>
            </> 
          }
        </div>        

      </div>
    </div>
  )
}

export default App
