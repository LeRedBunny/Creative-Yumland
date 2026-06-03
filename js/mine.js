
class Ore {
    /* An ore has a name, a color when its name is displayed, a weight in the random choice and a value in fidelity points */

    constructor(name, color, weight, value) {
        this.name = name;
        this.color = color;
        this.weight = weight;
        this.value = value;
    }
}

const ORES = [
    new Ore('Pierre', '#5e5e5e', 400, 0),
    new Ore('Émeraude', '#30ff53', 2, 25),
    new Ore('Diamant', '#abfcff', 1, 100),
    new Ore('Rubis', '#ff142c', 5, 10),
    new Ore('Amethyste', '#a041bf', 2, 25),
    new Ore('Or', '#dade00', 10, 5)
]


function mine (user_id) {
    /* Mines. */
    const ore = randomOre();
    playSound();
    updateNotification(ore);
    updatePoints(user_id, ore.value);
}


function playSound () {
    /* Plays a stone sound */
    var audio = new Audio('../sounds/mining_sound.mp3');
    audio.play();
}

function randomInt (max) {
    /* Returns a random integer between 0 and max */
    return Math.floor(Math.random() * max);
}


function randomOre () {
    /* Returns a randomly selected ore, or stone. */

    let weights = [];
    let total_weight = 0;
    for (let ore of ORES) {
        weights.push(ore.weight);
        total_weight += ore.weight;
    }

    let i = 0;
    let value = randomInt(total_weight);
    while (value != 0) {
        weights[i]--;
        if (!weights[i]) {
            i++;
        }
        value--;
    }

    return ORES[i];
}


function updateNotification (ore) {
    /* Displays the last obtained ore and its value. */

    let div = document.getElementById('notification');

    div.innerHTML = 'Vous avez obtenu ';
    switch (ore.name) {
        case 'Pierre' :
            div.innerHTML += 'de la ';
            break;
        case 'Diamant' :
        case 'Rubis' :
            div.innerHTML += 'du ';
            break;
        default :
            div.innerHTML += 'de l\'';
            break;
    }
    div.innerHTML += '<b style="color:' + ore.color + '">' + ore.name + '</b>';
    div.innerHTML += '<br> +' + ore.value + 'pts !';
}


async function updatePoints (user_id, points_obtained) {
    /* Updates the fidelity points of the user and displays it. */
    
    const response = await fetch('../php/mine.php?user=' + user_id + '&points=' + points_obtained);
    if (!response.ok) {
        throw new Error('Could not fetch resource.');
    }
    const points = parseInt(await response.text());

    let div = document.getElementById('fidelity_points');
    div.innerText = 'Points actuels: ' + points + 'pts';
    
}


