function checkInsert(){
    let tipoSelect = document.getElementById('tipoAddU');
    let tipo = tipoSelect.options[tipoSelect.selectedIndex].text;

    let nome = document.getElementById('nomeU').value;
    let materiale = document.getElementById('nomeMatU').value;
    let prezzo = document.getElementById('prezzoU');

    let expChar= new RegExp('^[a-z]+$','i');
    let expNumb = new RegExp('^[0-9]+$');

    if(!expChar.test(nome)){
        alert("Il nome dell'urna non è stata inserito o contiene delle cifre");
    }
    if(!expChar.test(materiale)){
        alert("Il materiale dell'urna non è stata inserito o contiene delle cifre");
    }
    if(!expNumb.test(prezzo)){
        alert("Il prezzo dell'urna non è stato inserito o contiene delle lettere");
    }
}