window.onload = () => {
    document.getElementById("frmAuto").onsubmit = event => {
        event.preventDefault();
        checkInsert(event.target);
    };
};

// TODO da controllare

function checkInsert(form){
    const nomeMa = document.getElementById('nomeMarca').value;
    const nomeMo = document.getElementById('nomeModello').value;
    const cilindr = document.getElementById('cilindr').value;
    const prezzo = document.getElementById('prezzoA').value;
    // TODO migliorare la regex aggiungendo punto e virgola
    let expNumb = new RegExp('[0-9]+$');

    let errorDiv = document.getElementById("errors");
    if(errorDiv)
        document.getElementById("errors").remove();
    errorDiv = document.createElement("div");
    errorDiv.id = "errors";
    errorDiv.className = "linea";
    errorDiv.tabIndex = -1;
    let errorAnchor = document.createElement("a");
    errorAnchor.tabIndex = 0;
    if(nomeMa == ''){
        errorAnchor.innerText = "Inserire il nome della marca dell'auto";
        errorAnchor.onclick = () => clickFocus("nomeMarca");
        errorAnchor.onkeyup = event => keyFocus(event,"nomeMarca");
        errorDiv.appendChild(errorAnchor);
    } else {
        if(nomeMo == ''){
            errorAnchor.innerText = "Inserire il nome del modello dell'auto";
            errorAnchor.onclick = () => clickFocus("nomeModello");
            errorAnchor.onkeyup = event => keyFocus(event,"nomeModello");
            errorDiv.appendChild(errorAnchor);
        } else {
            if(prezzo == ''){
                errorAnchor.innerText = "Inserire il prezzo dell'auto";
                errorAnchor.onclick = () => clickFocus("prezzoA");
                errorAnchor.onkeyup = event => keyFocus(event,"prezzoA");
                errorDiv.appendChild(errorAnchor);
            } else {
                if(!expNumb.test(prezzo)){
                    errorAnchor.innerText = "Il prezzo inserito non e' corretto";
                    errorAnchor.onclick = () => clickFocus("prezzoA");
                    errorAnchor.onkeyup = event => keyFocus(event,"prezzoA");
                    errorDiv.appendChild(errorAnchor);
                } else {
                    if(cilindr == ''){
                        errorAnchor.innerText = "Inserire la cilindrata dell'auto";
                        errorAnchor.onclick = () => clickFocus("cilindr");
                        errorAnchor.onkeyup = event => keyFocus(event,"cilindr");
                        errorDiv.appendChild(errorAnchor);
                    } else {
                        if(!expNumb.test(cilindr)){
                            errorAnchor.innerText = "la cilindrata inserita non e' corretta";
                            errorAnchor.onclick = () => clickFocus("cilindr");
                            errorAnchor.onkeyup = event => keyFocus(event,"cilindr");
                            errorDiv.appendChild(errorAnchor);
                        } 
                    }
                }
            }
        }
    }
    if(errorDiv.hasChildNodes()){
        form.prepend(errorDiv);
        errorDiv.focus();
    }
    else{
        form.submit();
    }
}