import { useId } from "react"

/**
 * @param {Object} response 
 * @returns 
 */
export function RadioInput({response, onCheck}){

    return <div className='my-3'>
        <label htmlFor={response.id}>
            <input className="response-selector" id={response.id} type='radio' name='riddleResponse' value={response.id} onChange={(e) => onCheck(e.target.value)} /> {response.name}
        </label>
    </div>
}