let urnLineDefaultVisibility;
window.addEventListener('load',(event)=>{
    document.getElementById("frmpreventivo").addEventListener("submit",(event)=> {
            event.preventDefault();
            check(event.target);
        }
    );
    document.getElementsByName("cremazione").forEach(element => element.addEventListener("change", event => hideShowUrn(event)));
});

function check(form){
    let suggest = ["Codice fiscale non corretto",
        "Il nome cliente vuoto o contiene una cifra, riprova",
        'Il cognome cliente vuoto o contiene una cifra, riprova',
        'Il nome defunto/a vuoto o contiene una cifra, riprova',
        'Il cognome defunto/a vuoto o contiene una cifra, riprova',
        'La data deve avere formato AAAA-MM-GG',
        'Il nome della via vuoto o contiene una cifra, riprova',
        'Il nome della città vuoto o contiene una cifra, riprova',
        'Non è stata selezionata la provincia, riprova',
        'Il numero non inserito o contiene delle lettere, riprova',
        'Selezionare la cerimonia desiderata, riprova',
        'Selezionare la bara desiderata, riprova',
        'Indicare se si desidera o meno la cremazione, riprova',
        "Indicare l'urna desiderata, riprova",
        "Indicare il modello di carro funebre desiderato, riprova",
        "Indicare il tipo di composizione floreale desiderata, riprova"];

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

    let cerimoniaSelect = document.getElementById('cerimonia');
    let cerimonia = cerimoniaSelect.options[cerimoniaSelect.selectedIndex].text;

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
    if(!expChar.test(nomeC)){
        document.getElementById('ncp').innerHTML=suggest[1];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(!expChar.test(cognomeC)){
        document.getElementById('ccp').innerHTML=suggest[2];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(!expChar.test(nomeD)){
        document.getElementById('ndp').innerHTML=suggest[3];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(!expChar.test(cognomeD)){
        document.getElementById('cdp').innerHTML=suggest[4];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(!expDate.test(nascita)){
        document.getElementById('np').innerHTML=suggest[5];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(!expDate.test(decesso)){
        document.getElementById('dp').innerHTML=suggest[5];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(!via){
        document.getElementById('vp').innerHTML=suggest[6];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(!expChar.test(citta)){
        document.getElementById('cp').innerHTML=suggest[7];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(!expChar.test(provincia)){
        document.getElementById('pp').innerHTML=suggest[8];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(!expNumb.test(cerimonia)){
        document.getElementById('clp').innerHTML=suggest[9];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(cerimonia==="---"){
        document.getElementById('cerp').innerHTML=suggest[10];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(bara==="---"){
        document.getElementById('barap').innerHTML=suggest[11];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(urna==="---"){
        document.getElementById('up').innerHTML=suggest[13];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(auto==="---"){
        document.getElementById('autop').innerHTML=suggest[14];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }
    if(fiori==="---"){
        document.getElementById('fp').innerHTML=suggest[15];
        form.preventDefault=true;
    }
    else {
        form.setAttribute("action","quotator.php");
        console.log()
        form.submit();
    }

}

function hideShowUrn(changeEvent) {
    let urnLine = document.getElementById("urnLine");
    if (changeEvent.target.id == "nocremazione"){
        urnLineDefaultVisibility = urnLine.style.visibility;
        urnLine.style.visibility = "hidden";
    }
    else{
        urnLine.style.visibility=urnLineDefaultVisibility;
    }
}
