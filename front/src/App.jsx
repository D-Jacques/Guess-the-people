import { useEffect, useState } from 'react'
import { RadioInput } from './components/RadioInput';
import { fetchRiddle } from './functions/FetchRiddle';

function App() {

  const urlBase = "https://127.0.0.1:8000/api";

  const [selectedResponse, setSelectedResponse] = useState(null);
  const [isGoodAnswer, setIsGoodAnswer] = useState(false);
  const [isBadAnswer, setIsBadAnswer] = useState(false);
  const [responses, setResponses] = useState({});
  const [isLoadingData, setIsLoadingData] = useState(true);

  /**
   * Reset the game and reload a new riddle
   */
  function handleReloadRiddle(){
    setIsLoadingData(true);
    fetchRiddle(urlBase, setResponses, setIsLoadingData);
    setSelectedResponse(null);
    setIsGoodAnswer(false);
  }

  useEffect(() => {
    fetchRiddle(urlBase, setResponses, setIsLoadingData);
  }, []);


  /**
   * Called when we hit the submit button when we're trying to guess the riddle
   * if the answer is right, we show "good answer screen" 
   */
  function handleSubmit(){
    if(selectedResponse.isGoodAnswer){
      setIsGoodAnswer(true);
      setIsBadAnswer(false);
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

  function displayRiddlePicture(riddlePicture){
    return riddlePicture ? "https://127.0.0.1:8000/images/riddleCard/"+riddlePicture : ""
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
                  responses.map(response =>( 
                    <RadioInput key={response.id} response={response} onCheck={handleResponseCheck} />
                  ))
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
                  backgroundImage: `url(${displayRiddlePicture(selectedResponse.imageName)})`,
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
