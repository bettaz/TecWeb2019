function checkInsert(){
    let tipoSelect = document.getElementById('tipoAddC');
    let tipo = tipoSelect.options[tipoSelect.selectedIndex].text;

    let tipologia = document.getElementById('tipolog').value;
    let prezzo = document.getElementById('prezzoC');

    let expChar= new RegExp('^[a-z]+$','i');
    let expNumb = new RegExp('^[0-9]+$');

    if(!expChar.test(tipologia)){
        alert("La tipologia del rito non è stata inserita o contiene delle cifre");
    }
    if(!expNumb.test(prezzo)){
        alert("Il prezzo del rito non è stato inserito o contiene delle lettere");
    }
}