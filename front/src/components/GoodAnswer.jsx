export function GoodAnswer({displayRiddlePicture, handleReloadRiddle, selectedResponse}){
    return(
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
    )
}