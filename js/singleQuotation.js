function check(){
    var totale = document.getElementById('finalTot').value;

    var expNumb = new RegExp('^[0-9]+$');

    if(!expNumb.test(totale)){
        alert("Importo mancante o inserito non correttamente");
    }
}