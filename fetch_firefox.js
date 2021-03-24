fetch("https://restcountries-v1.p.rapidapi.com/alpha/?codes=es", 
    { method:"GET",
    headers : {
        "x-rapidapi-host": "restcountries-v1.p.rapidapi.com", 
        "x-rapidapi-key": "2dfaff8260msh71e2602d2fdd8e0p14307djsn8de366b0a61c"
    }
   }).then((res)=>res.json()).then((data)=>console.log(data))