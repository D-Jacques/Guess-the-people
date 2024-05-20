import { useEffect, useState } from "react";


export function UseFetch(url, options = {}){
    const [isLoading, setIsLoadingData] = useState(true);
    const [data, setData] = useState({});

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
            setData(data);
            setIsLoadingData(false);
        });
    }, [])

    return {data, isLoading}
}