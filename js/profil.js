async function modifymode(){


    //console.log("amorcing change of the page");
    let box=document.getElementById("box");
    //console.log("Got attribute: type is " + mode);
    if (!box) { //sécurité
        console.error("profil.js: missing #box element");
        return;
    }


    let mode=box.getAttribute("mode");
    if(mode== "display"){   //basculer en mode modification
        //récupération des données, pour les rentrer dans le formulaire
        //console.log("collecting user data");
        let data=[];
        data["name"]=document.getElementById("name").getAttribute("value");
        data["firstname"]=document.getElementById("firstname").getAttribute("value");
        data["email"]=document.getElementById("email").getAttribute("value");
        data["favorite_rock"]=document.getElementById("favorite_rock").getAttribute("value");
        data["tel"]=document.getElementById("tel").getAttribute("value");
        data["address"]=document.getElementById("address").getAttribute("value1");
        data["code"]=document.getElementById("address").getAttribute("value2");
        data["city"]=document.getElementById("address").getAttribute("value3");
        //for(index in data){console.log("Recovered data[\""+index+"]\":"+data[index]);}

        //console.log("changing from display to modify mode");
        //écriture de la page, avec valeurs incorporées dedans
        box.innerHTML=`
            <!-- Informations personnelles -->
            <h3> Modifier le profil </h3>
            <form method="post">
                <div id="data">
                    <div>
                        <input type="text" id="name" name="name" placeholder="name" value="`+data["name"]+`" required>
                    </div>
                    <br>
                    <div>
                        <input type="text" id="firstname" name="firstname" placeholder="Prénom" value="`+data["firstname"]+`" required>
                    </div>
                    <br>
                        <input type="hidden" id="email" name="email" value="`+data["email"]+`">
                    
                    <div>
                        <input type="tel" id="tel" name="tel" pattern="[0-9]{10}" placeholder="Numéro de téléphone" value="`+data["tel"]+`" required>
                    </div>
                    <br>
                    <div>
                        <input type="text" id="address" name="address" placeholder="Adresse" value="`+data["address"]+`" required>
                    </div>
                    <br>
                    <div>
                        <input type="text" id="city" name="city" placeholder="Ville" value="`+data["city"]+`" required>
                    </div>
                    <br>
                    <div>
                        <input type="number" id="code" name="code" placeholder="Code postal" value="`+data["code"]+`" required>
                    </div>
                    <br>
                    <div>
                        Pierre préférée :
                        <select name="favorite_rock" id="favorite_rock">
                            '<option value="Aucune" id="o0"> Aucune </option>'
                            <option value="Rubis" id="o1"> Rubis </option>
                            <option value="Saphir" id="o2"> Saphir </option>
                            <option value="Améthyste" id="o3"> Améthyste </option>
                            <option value="Émeraude" id="o4"> Émeraude </option>
                        </select>
                    </div>
                    <br><br>
                </div>
            </form>
            `;
        
        //ajout de select à la balise option appropriée
        let option;
        //console.log("identifying current preferred rock");
        switch (data["favorite_rock"]){
            case "Aucune":
                //console.log("None is selected");
                option=document.getElementById("o0");
            default:
                //console.log("Value not recognized:"+data["favorite_rock"] +"proceeding to default procedure");
                option=document.getElementById("o0");
                break;
            case "Améthyste":
                //console.log("Amethyst is selected");
                option=document.getElementById("o3");
                break;
            case "Rubis":
                //console.log("Ruby is selected");
                option=document.getElementById("o1");
                break;
            case "Émeraude":
                //console.log("Emerald is selected");
                option=document.getElementById("o4");
                break;
            case "Saphir":
                //console.log("Saphire is selected");
                option=document.getElementById("o2");
                break;
        }
        option.setAttribute("selected","");
        
        
        //finishing elements
        box.setAttribute("mode","modify");  //changes attribute to indicate the current mode
        //console.log("changed to 'modify' mode");    



    } else {    //basculer en mode display (et envoi des données au php qui merge le tout)
        //récupération des données, pour les rentrer dans le formulaire
        //console.log("collecting user data");
        let data={
            "name": document.getElementById("name").value,
            "firstname": document.getElementById("firstname").value,
            "email": document.getElementById("email").value,
            "favorite_rock": document.getElementById("favorite_rock").value,
            "tel": document.getElementById("tel").value,
            "address": document.getElementById("address").value,
            "code": document.getElementById("code").value,
            "city": document.getElementById("city").value
        };
            //console.log("data.name="+data.name);
            //console.log("data.firstname="+data.firstname);
            //console.log("data.email="+data.email);
            //console.log("data.favorite_rock="+data.favorite_rock);
            //console.log("data.tel="+data.tel);
            //console.log("data.city="+data.city);
            //console.log("data.code="+data.code);
            //console.log("data.address="+data.address);
        
        //console.log("changing from modify to display mode");

        box.innerHTML=`
            <!-- Informations personnelles -->
            <h3> Informations personnelles </h3>
            <form method="post">
                <div id="data">
                    <p>
                        <strong>Nom :</strong> <span id="name" value="`+data.name+`"> `+data.name+` </span>
                    </p>
                    <p>
                        <strong>Prénom :</strong> <span id="firstname" value="`+data.firstname+`">`+data.firstname+` </span>
                    </p>
                    <p>
                        <strong>Mail :</strong> <span id="email" value="`+data.email+`">`+data.email+` </span>
                    </p>
                    <p>
                        <strong>Pierre préférée :</strong> <span id="favorite_rock" value="`+data.favorite_rock+`">`+data.favorite_rock+` </span>
                    </p>
                    <p>
                        <strong>Numéro de téléphone :</strong> <span id="tel" value="`+ data.tel +`">`+ data.tel +` </span>
                    </p>
                    <p>
                        <strong>Adresse :</strong> <span id="address" value1="`+ data.address +`" value2="`+ data.code +`" value3="`+ data.city +`" >`+ data.address + `,` + data.code + ` `+ data.city + `</span>
                    </p>
                </div>
            </form>
            `;
        box.setAttribute("mode","display");  //changes attribute to indicate the current mode
        //console.log("changed to 'display' mode");

        //console.log("Sending recovered data to the database");
        updateJson(data);
        
    
    }
    //console.log("Ending changes to the page");
    
}

async function updateJson(data){
    //console.log("beginning fetch function");
    const response = await fetch(getDomain() + '/php/fuser.php',{
            method: "POST",
            headers: {
                "Content-Type":"application/json ; charset=utf-8"
            },
            body: JSON.stringify(data)
        });

        if(response.ok){
            console.log("Modifications appliquées avec succès");
            //alert("Vos données ont été correctement récupérées.")
            return 1;
        } else {
            console.log("Erreur lors de l'application des changements");
            alert("Vos modifications n'a pa pu être sauvegardées. Il est recommandé de contacter le restaurant.")
            return 0;
        }
}

async function statuschange(){
    let data= {
        status: document.getElementById('status').value,
        email: document.getElementById('email').getAttribute('value')
    };
    updateJson(data);
}

async function statuscheck(id){
    let answer = await fetch(getDomain() + '/php/status.php?id=' + id); //requête GET
    let status = await answer.text();
    console.log("current status:" + status);
    if(status == 5){
        //console.log("looks like you shouldn't be here");
        //procédure d'ejection de l'utilisateur

        //si l'utilisateur est bloqué, on l'envoie ailleurs.
        let number=Math.floor(Math.random() * 2);
        switch(number){
            case 0: location.replace(getDomain() + '/pages/timeout.php');
                break;
            case 1: location.replace('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
                break;
        }

    } else{
        //console.log("bienvenue dans la boîte");
    }
}

function levideur(){
    //récupération de l'id de l'utilisateur
    let getter=document.getElementById("IDIDID");
    let id="none";
    if(getter){
        id=getter.value;
        //boucle de vérification que l'utilisateur est valide
        setInterval(()=> {
            statuscheck(id);
        }, 1000);   //s'exécute avec un intervalle de 1 seconde
    }
}


window.addEventListener("DOMContentLoaded", () => {
    console.log("DOM is loaded");

    levideur();

});
