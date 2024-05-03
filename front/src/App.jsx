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

  return (
    <div className='app-layout'>
      <div className='w-1/2 mx-auto'>
        {/* Main title */}
        <h1 className='text-6xl text-center my-5 py-2 px-3'> PeopleGuesser </h1>

        {/* Game area */}
        <div className='game-zone w-11/12 mx-auto p-5 bg-stone-200'>
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

            <button className='w-1/2 mx-auto bg-green-200'>submit</button>
          </form>
        </div>        

      </div>
    </div>
  )
}

export default App
