function checkInsert(){
    let tipoSelect = document.getElementById('tipoAddP');
    let tipo = tipoSelect.options[tipoSelect.selectedIndex].text;

    let nome = document.getElementById('nomeP').value;
    let prezzo = document.getElementById('prezzoP');

    let expChar= new RegExp('^[a-z]+$','i');
    let expNumb = new RegExp('^[0-9]+$');

    if(tipo==="---"){
        alert("Selezionare il tipo di prodotto");
    }
    if(!expChar.test(nome)){
        alert("Il nome del prodotto non è stato inserito o contiene delle cifre");
    }
    if(!expNumb.test(prezzo)){
        alert("Il prezzo del prodotto non è stato inserito o contiene delle lettere");
    }
}

function checkRemove(){
    let tipoSelect = document.getElementById('tipoRemoveP');
    let tipo = tipoSelect.options[tipoSelect.selectedIndex].text;

    let nomeSelect = document.getElementById('nomeRemoveP');
    let nome = nomeSelect.options[nomeSelect.selectedIndex].text;

    if(tipo==="---"){
        alert("Tipo prodotto non selezionto");
    }
    if(nome==="---"){
        alert("Nome prodotto non selezionato");
    }

}