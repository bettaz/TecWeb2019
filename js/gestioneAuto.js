function checkInsert(){
    let tipoSelect = document.getElementById('tipoAddA');
    let tipo = tipoSelect.options[tipoSelect.selectedIndex].text;

    let marca = document.getElementById('nomeMarca').value;
    let modello = document.getElementById('nomeModello').value;
    let prezzo = document.getElementById('prezzoA');
    let cilindrata = document.getElementById('cilindr').value;

    let expChar= new RegExp('^[a-z]+$','i');
    let expNumb = new RegExp('^[0-9]+$');

    if(!expChar.test(marca)){
        alert("la marca dell'auto non è stato inserita o contiene delle cifre");
    }
    if(!expNumb.test(prezzo)){
        alert("Il prezzo dell'auto non è stato inserito o contiene delle lettere");
    }
    if(!expNumb.test(cilindrata)){
        alert("La cilindrata dell'auto non è stato inserito o contiene delle lettere");
    }
}