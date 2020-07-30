function checkInsert(){
    let tipoSelect = document.getElementById('tipoAddF');
    let tipo = tipoSelect.options[tipoSelect.selectedIndex].text;

    let nome = document.getElementById('nomeF').value;
    let prezzo = document.getElementById('prezzoF');

    let expChar= new RegExp('^[a-z]+$','i');
    let expNumb = new RegExp('^[0-9]+$');

    if(!expChar.test(nome)){
        alert("Il nome della composizione non è stata inserito o contiene delle cifre");
    }
    if(!expNumb.test(prezzo)){
        alert("Il prezzo della composizione non è stato inserito o contiene delle lettere");
    }
}