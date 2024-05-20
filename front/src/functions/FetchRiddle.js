export function fetchRiddle(urlBase, setResponses, setIsLoadingData){
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
}