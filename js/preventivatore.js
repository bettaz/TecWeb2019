function check(){
    var cf = document.getElementById('cf').value;
    var nomeC= document.getElementById("nomeC").value;
    var cognomeC= document.getElementById("cognomeC").value;
    var nomeD= document.getElementById("nomeD").value;
    var cognomeD= document.getElementById("cognomeD").value;
    var via= document.getElementById("via").value;
    var citta= document.getElementById("citta").value;
    var provincia= document.getElementById('provincia');
    var optionP = provincia.options[provincia.selectedIndex].text;
    var cell= document.getElementById("cell").value;
    var nascita = document.getElementById('nascita').value;
    var decesso = document.getElementById('decesso').value;

    var baraSelect = document.getElementById('bara');
    var bara = baraSelect.options[baraSelect.selectedIndex].text;

    var sicremazione = document.getElementById('sicremazione').checked;
    var nocremazione = document.getElementById('nocremazione').checked;

    var urnaSelect = document.getElementById('urna');
    var urna = urnaSelect.options[urnaSelect.selectedIndex].text;

    var autoSelect = document.getElementById('auto');
    var auto = autoSelect.options[autoSelect.selectedIndex].text;

    var fioriSelect = document.getElementById('fiori');
    var fiori = fioriSelect.options[fioriSelect.selectedIndex].text;

    var expCf= RegExp('^[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$');
    var expChar= new RegExp('^[a-z]+$','i');
    var expNumb = new RegExp('^[0-9]+$');
    var expDate = RegExp('^\\d{4}\\-(0[1-9]|1[012])\\-(0[1-9]|[12][0-9]|3[01])$');

    if(!expCf.test(cf)){
        alert('Codice fiscale non corretto')
    }

    if(!expChar.test(nomeC)){
        alert('Il nome cliente vuoto o contiene una cifra, riprova');
    }

    if(!expChar.test(cognomeC)){
        alert('Il cognome cliente vuoto o contiene una cifra, riprova');
    }

    if(!expChar.test(nomeD)){
        alert('Il nome defunto/a vuoto o contiene una cifra, riprova');
    }

    if(!expChar.test(cognomeD)){
        alert('Il cognome defunto/a vuoto o contiene una cifra, riprova');
    }

    if(!via){
        alert('Il nome della via vuoto o contiene una cifra, riprova');
    }

    if(!expChar.test(citta)){
        alert('Il nome della città vuoto o contiene una cifra, riprova');
    }

    if(optionP==="---"){
        alert('Non è stata selezionata la provincia, riprova');
    }

    if(!expNumb.test(cell)){
        alert('Il numero non inserito o contiene delle lettere, riprova');
    }

    if(bara==='---'){
        alert('Selezionare la bara desiderata, riprova');
    }

    if(!sicremazione && !nocremazione){
        alert('Indicare se si desidera o meno la cremazione, riprova');
    }

    if(sicremazione && urna==='---'){
        alert("Indicare l'urna desiderata, riprova");
    }

    if(auto==='---'){
        alert("Indicare il modello di carro funebre desiderato, riprova");
    }

    if(fiori==='---'){
        alert("Indicare il tipo di composizione floreale desiderata, riprova");
    }



}
