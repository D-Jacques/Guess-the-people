import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'

function App() {
  const responses = [
    {"id" : "repA", "label" : "Réponse A", "isGoodAnswer" : false},
    {"id" : "repB", "label" : "Réponse B", "isGoodAnswer" : false},
    {"id" : "repC", "label" : "Réponse C", "isGoodAnswer" : true},
    {"id" : "repD", "label" : "Réponse D", "isGoodAnswer" : false}
  ];

  // Ici j'aimerais que lorsque je coche un de mes radiobutton être au courant de la réponse que j'ai coché
  // ex : quand je coche réponse A : setCurrentResponse({"id" : "repA", "label" : "Réponse A", "isGoodAnswer" : false}) 
  // (Essayer de stocker l'objet qui est dans responses);

  // Pour vérifier les réponses : je regarde ma currentResponse => est-ce que j'ai isGoodAnswer a true ?

  return (
    <div className='app-layout'>
      <div className='w-1/2 mx-auto'>
        {/* Main title */}
        <h1 className='text-6xl text-center my-5 py-2 px-3'> PeopleGuesser </h1>

        {/* Game area  A METTRE DANS UN COMPONENT */}
        <div className='game-zone w-11/12 mx-auto p-5 bg-slate-50'>
          <p className='my-15 py-10'>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio iste, sequi, cupiditate provident fugit ipsum officia aperiam itaque reprehenderit error nostrum deleniti pariatur beatae? Aperiam voluptatum dolores suscipit explicabo. Quidem.
          </p>

          <form action="">
            
            {
              responses.map((response) => 
                <div key={response.id} className='my-3'>
                  <label htmlFor={response.id}><input id={response.id} type='radio' name='riddleResponse'/>{response.label}</label>
                </div>
              )
            }
            <div className='w-1/4 mx-auto'>
              <button className='w-full bg-cyan-200 py-2 hover:bg-cyan-300'>submit</button>
            </div>
          </form>
        </div>        

      </div>
    </div>
  )
}

export default App
