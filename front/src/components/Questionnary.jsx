import { RadioInput } from "./RadioInput";

export function Questionnary({displayRiddleDescription, responses, selectedResponse, handleSubmit, handleResponseCheck}){
    return (
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
    )
}