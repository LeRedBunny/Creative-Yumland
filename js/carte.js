async function filter(){
    // debug console.log("Filter function called!"); //temp

    const filters=document.getElementById("filters").value.toLowerCase();
    // debug console.log("Filters value:", filters); //temp permet de savoir si les valeurs de filtre sont bien reçues
    const response=await fetch('../pages_php/filtre.php?filtres=' + filters);
    if(!response.ok) throw new Error("could not fetch resource");
    const carte = await response.json();
    const box = document.getElementById("box");
    box.innerHTML = '';
    //const items = Array.isArray(data) ? data : Object.values(data);
    for (const nomplat in carte) {
        box.innerHTML += "<a href=\"plat.php?plat=" + nomplat + "\">" + "<img src=\"" + carte[nomplat].image + "\" alt=\"" + nomplat + "\" width='50' + height='50'>" + "<div>" + nomplat + "</div> </a>"
        //                <a href=plat.php?plat=Savouroche>            <img src=(Savouroche[image]=)"../savouroche.webp" alt="Savouroche" width='50' height='50'> <div> Savouroche </div> </a>
        
    }
    /*    .then( response => {
            // debug console.log("Fetch response received:", response.status); //temp confirme que la réponse est reçue
            if(!response.ok){
                throw new Error("could not fetch ressource");
            }
            return response.text();
        })
        .then( data => {
            console.log("Raw response:", data);
            if(data){
                return JSON.parse(data);
            }
            throw new Error("Empty response from server");  //else is implied through return
        })
        //.then( data => console.log(data))
        .then( data => {
            for (const value of data){
                box.innerHTML+=value;
            }
        })
        .catch( error => console.error(error));
        */
    //console.log(response);
}