function showhide(){
    const trieur=document.getElementById("tri").value;
    const type=document.getElementById("typetri");
    if(trieur == "prix" || trieur == "durete"){
        type.style.display="inline";
        //console.log('show');
    } else{ //cas de valeur non identifiée inclu ici pour plus de sécurité
        type.style.display="none";
        //console.log('hide');
    }
}





async function filter(){
    // debug console.log("Filter function called!"); //temp

    const filtres=document.getElementById("filters").value.toLowerCase();
    // debug console.log("Filters value:", filters); //temp permet de savoir si les valeurs de filtre sont bien reçues
    const tri1=document.getElementById("tri").value;
    const tri2=document.getElementById("typetri").value;
    const response=await fetch(getDomain() + '/php/filtre.php?filtres=' + filtres + '&tri=' + tri1 + '&ordre=' + tri2);

    if(!response.ok) throw new Error("could not fetch resource");

    let carte = await response.json();

    const box = document.getElementById("box"); //récupération de l'adresse de la zone d'écriture des liens de plat
    box.innerHTML = '';
    carte= Array.isArray(carte) ? carte : Object.values(carte); //retourne la réponse json sous format de tableau

    //processus de tri
    switch(tri1){
        case "prix":
            if(tri2 == "2"){    //décroissant
                carte.sort((a,b) => b.prix - a.prix);
            } else if (tri2 == "1"){    //croissant
                carte.sort((a,b) => a.prix - b.prix);
            }
            break;
        case "durete":
            if(tri2 == "2"){    //décroissant
                carte.sort((a,b) => b.durete - a.durete);
            } else if (tri2 == "1"){    //croissant
                carte.sort((a,b) => a.durete - b.durete);
            }
            break;
        case "0":
        default:
            //rien ne se passe
            carte;
            break;
    }


    for (const id in carte) {
        box.innerHTML += "<a href=\"plat.php?plat=" + carte[id].name + "\">" + "<img src=\"" + carte[id].image + "\" alt=\"" + carte[id].name + "\" width='50' + height='50'>" + "<div>" + carte[id].name + "</div> </a>"
        //                <a href="plat.php?plat=Savouroche">            <img src=(Savouroche[image]=)"../savouroche.webp" alt="Savouroche" width='50' height='50'> <div> Savouroche </div> </a>
        
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