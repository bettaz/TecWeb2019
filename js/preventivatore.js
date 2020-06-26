window.addEventListener('load',(event)=>{
    document.getElementById("frmpreventivo").addEventListener("submit",(event)=> {
            event.preventDefault();
            check(event.target);
        }
    )});
function check0(){
    let cf = document.getElementById('cf').value;
    let nomeC= document.getElementById("nomeC").value;
    let cognomeC= document.getElementById("cognomeC").value;
    let nomeD= document.getElementById("nomeD").value;
    let cognomeD= document.getElementById("cognomeD").value;
    let via= document.getElementById("via").value;
    let citta= document.getElementById("citta").value;
    let provincia= document.getElementById('provincia');
    let optionP = provincia.options[provincia.selectedIndex].text;
    let cell= document.getElementById("cell").value;
    let nascita = document.getElementById('nascita').value;
    let decesso = document.getElementById('decesso').value;

    let baraSelect = document.getElementById('bara');
    let bara = baraSelect.options[baraSelect.selectedIndex].text;

    let sicremazione = document.getElementById('sicremazione').checked;
    let nocremazione = document.getElementById('nocremazione').checked;

    let urnaSelect = document.getElementById('urna');
    let urna = urnaSelect.options[urnaSelect.selectedIndex].text;

    let autoSelect = document.getElementById('auto');
    let auto = autoSelect.options[autoSelect.selectedIndex].text;

    let fioriSelect = document.getElementById('fiori');
    let fiori = fioriSelect.options[fioriSelect.selectedIndex].text;

    let expCf= RegExp('^[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$');
    let expChar= new RegExp('^[a-z]+$','i');
    let expNumb = new RegExp('^[0-9]+$');
    let expDate = RegExp('^\\d{4}\\-(0[1-9]|1[012])\\-(0[1-9]|[12][0-9]|3[01])$');

    if(!expCf.test(cf)){
        alert('Codice fiscale non corretto');
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
function check(form){
    let suggest = ["Codice fiscale non corretto",
        "Il cognome cliente vuoto o contiene una cifra, riprova",
        'Il cognome cliente vuoto o contiene una cifra, riprova',
        'Il nome defunto/a vuoto o contiene una cifra, riprova',
        'Il cognome defunto/a vuoto o contiene una cifra, riprova',
        'Il nome della via vuoto o contiene una cifra, riprova',
        'Il nome della città vuoto o contiene una cifra, riprova',
        'Non è stata selezionata la provincia, riprova',
        'Il numero non inserito o contiene delle lettere, riprova',
        'Selezionare la bara desiderata, riprova',
        'Indicare se si desidera o meno la cremazione, riprova',
        "Indicare l'urna desiderata, riprova",
        "Indicare il modello di carro funebre desiderato, riprova",
        "Indicare il tipo di composizione floreale desiderata, riprova"];

    let cf = document.getElementById('cf').value;
    /*let nomeC= document.getElementById("nomeC").value;
    let cognomeC= document.getElementById("cognomeC").value;
    let nomeD= document.getElementById("nomeD").value;
    let cognomeD= document.getElementById("cognomeD").value;
    let via= document.getElementById("via").value;
    let citta= document.getElementById("citta").value;
    let provincia= document.getElementById('provincia');
    let optionP = provincia.options[provincia.selectedIndex].text;
    let cell= document.getElementById("cell").value;
    let nascita = document.getElementById('nascita').value;
    let decesso = document.getElementById('decesso').value;

    let baraSelect = document.getElementById('bara');
    let bara = baraSelect.options[baraSelect.selectedIndex].text;

    let sicremazione = document.getElementById('sicremazione').checked;
    let nocremazione = document.getElementById('nocremazione').checked;

    let urnaSelect = document.getElementById('urna');
    let urna = urnaSelect.options[urnaSelect.selectedIndex].text;

    let autoSelect = document.getElementById('auto');
    let auto = autoSelect.options[autoSelect.selectedIndex].text;

    let fioriSelect = document.getElementById('fiori');
    let fiori = fioriSelect.options[fioriSelect.selectedIndex].text;*/

    let expCf= RegExp('^[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$');
    let expChar= new RegExp('^[a-z]+$','i');
    let expNumb = new RegExp('^[0-9]+$');
    let expDate = RegExp('^\\d{4}\\-(0[1-9]|1[012])\\-(0[1-9]|[12][0-9]|3[01])$');
    form.removeAttribute("action");
    console.log("function");
    if(!expCf.test(cf)){
        document.getElementById('cfp').innerHTML=suggest[0];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }

}


