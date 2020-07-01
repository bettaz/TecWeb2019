let urnLineDefaultVisibility;
window.addEventListener('load',()=>{
    document.getElementById("frmpreventivo").addEventListener("submit",(event)=> {
            event.preventDefault();
            check(event.target);
        }
    );
    document.getElementsByName("cremazione").forEach(element => element.addEventListener("change", event => hideShowUrn(event)));
});
const textRegex = new RegExp("^([A-Z]|[a-z]|\ )+$");
const dateRegex = new RegExp("^\\d{4}\\-(0[1-9]|1[012])\\-(0[1-9]|[12][0-9]|3[01])$");
const selectRegex = new RegExp("^\\d+$");
const telRegex = new RegExp("^[+]?[0-9]+$");
const cfRegex = new RegExp("^([A-Z]|[a-z]){6}[0-9]{2}([A-Z]|[a-z])[0-9]{2}([A-Z]|[a-z])[0-9]{3}([A-Z]|[a-z])$");
const boolRegex = new RegExp("^(true|false)$");
const provRegex = new RegExp("^[A-Z]{2}$");
const roadRegex = new RegExp("^([a-z]|[A-Z]|[0-9]|\ )+");
const suggestions = {
    "cf": {
        "regex": cfRegex,
        "suggestion": "Codice fiscale non corretto"
    },
    "nomeC": {
        "regex": textRegex,
        "suggestion": "Nome cliente vuoto o contenente una cifra"
    },
    "cognomeC": {
        "regex": textRegex,
        "suggestion": "Cognome cliente vuoto o contenente una cifra"
    },
    "nomeD": {
        "regex": textRegex,
        "suggestion": "Nome defunto/a vuoto o contenente una cifra"
    },
    "cognomeD": {
        "regex": textRegex,
        "suggestion": "Cognome defunto/a vuoto o contenente una cifra"
    },
    "decesso": {
        "regex": dateRegex,
        "suggestion": "La data del decesso deve avere formato AAAA-MM-GG"
    },
    "via": {
        "regex": roadRegex,
        "suggestion": "Nome della via vuoto o contenente caratteri speciali"
    },
    "citta": {
        "regex": textRegex,
        "suggestion": "Nome della città vuoto o contenente una cifra"
    },
    "provincia": {
        "regex" : provRegex,
        "suggestion": "Non è stata selezionata la provincia"
    },
    "tel": {
        "regex": telRegex,
        "suggestion": "Numero di telefono non inserito o contenente caratteri non numerici non appartenenti al prefisso internazionale"
    },
    "nascita": {
        "regex": dateRegex,
        "suggestion": "La data di nascita deve avere formato AAAA-MM-GG"
    },
    "cerimonia": {
        "regex": selectRegex,
        "suggestion": "Selezionare una cerimonia"
    },
    "bara": {
        "regex": selectRegex,
        "suggestion": "Selezionare una bara"
    },
    "urna": {
        "regex": selectRegex,
        "suggestion": "Selezionare un urna"
    },
    "auto": {
        "regex": selectRegex,
        "suggestion": "Indicare il modello di carro funebre desiderato"
    },
    "fiori": {
        "regex": selectRegex,
        "suggestion": "Indicare la composizione floreale desiderata"
    },
    "cremazione": {
        "regex": boolRegex,
        "suggestion": "Scegliere se si desidera o meno la cremazione"
    }
}

function check(form){
    let error = false;
    let errorsDiv = document.getElementById("errors");
    const elementList = form.elements;
    for(let i = 0; i< elementList.length; i++){
        let element =elementList[i];
        if('name' in element
            && (element.tagName.toUpperCase() === "INPUT" || element.tagName.toUpperCase() === "SELECT")
            && element.getAttribute("type") !== "submit"){
            let name = elementList[i].name;
            let value = elementList[i].value;
            if(!suggestions[name]['regex'].test(value)){
                if(!error) {
                    error = true;
                    errorsDiv.innerHTML = "";
                }
                errorsDiv.innerHTML += "<p><a tabindex=\"1\" rel=\"tag\" href=\"#"+name+"\" \">"+suggestions[name].suggestion+"</a></p>";
                //TODO ask howto put all the things ok (if href it's ok or if we need to define the onkeyup and the onclick or move all the messages after every field and focus on the first wrong
            }
        }
    }
    if (!error)
        form.submit();
    else{
        errorsDiv.focus();
    }
}

function hideShowUrn(changeEvent) {
    // TODO check if screen readers read the field
    let urnLine = document.getElementById("urnLine");
    if (changeEvent.target.id == "nocremazione"){
        urnLineDefaultVisibility = urnLine.style.visibility;
        urnLine.style.visibility = "hidden";
    }
    else{
        urnLine.style.visibility=urnLineDefaultVisibility;
    }
}
