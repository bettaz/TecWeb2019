function checkInsert(){
    let tipoSelect = document.getElementById('tipoAddB');
    let tipo = tipoSelect.options[tipoSelect.selectedIndex].text;

    let nome = document.getElementById('nomeB').value;
    let materiale = document.getElementById('nomeMatB').value;
    let prezzo = document.getElementById('prezzoB');

    let expChar= new RegExp('^[a-z]+$','i');
    let expNumb = new RegExp('^[0-9]+$');

    if(!expChar.test(nome)){
        alert("Il nome della bara non è stata inserito o contiene delle cifre");
    }
    if(!expChar.test(materiale)){
        alert("Il materiale della bara non è stata inserito o contiene delle cifre");
    }
    if(!expNumb.test(prezzo)){
        alert("Il prezzo della bara non è stato inserito o contiene delle lettere");
    }
}