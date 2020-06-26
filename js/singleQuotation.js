function check(){
    let totale = document.getElementById('finalTot').value;

    let expNumb = new RegExp('^[0-9]+$');

    if(!expNumb.test(totale)){
        alert("Importo mancante o inserito non correttamente");
    }
}