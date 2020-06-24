function checkInsert(){
    var tipoSelect = document.getElementById('tipoAddP');
    var tipo = tipoSelect.options[tipoSelect.selectedIndex].text;

    var nome = document.getElementById('nomeP').value;
    var prezzo = document.getElementById('prezzoP');

    var expChar= new RegExp('^[a-z]+$','i');
    var expNumb = new RegExp('^[0-9]+$');

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
    var tipoSelect = document.getElementById('tipoRemoveP');
    var tipo = tipoSelect.options[tipoSelect.selectedIndex].text;

    var nomeSelect = document.getElementById('nomeRemoveP');
    var nome = nomeSelect.options[nomeSelect.selectedIndex].text;

    if(tipo==="---"){
        alert("Tipo prodotto non selezionto");
    }
    if(nome==="---"){
        alert("Nome prodotto non selezionato");
    }

}