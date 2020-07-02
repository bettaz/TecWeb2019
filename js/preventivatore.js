let urnLineDefaultVisibility;
window.onload= ()=>{
    document.getElementById("frmpreventivo").onsubmit = event => {
            event.preventDefault();
            check(event.target);
    };
    document.getElementsByName("cremazione").forEach(element => element.onchange = event => hideShowUrn(event));
};
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
        "suggestion": "Selezionare un'urna"
    },
    "auto": {
        "regex": selectRegex,
        "suggestion": "Selezionare un carro funebre"
    },
    "fiori": {
        "regex": selectRegex,
        "suggestion": "Selezionare una composizione floreale"
    },
    "cremazione": {
        "regex": boolRegex,
        "suggestion": "Scegliere se si desidera o meno la cremazione"
    }
}

function check(form){
    let errorsDiv = document.getElementById("errors");
    if(errorsDiv)
        errorsDiv.remove();
    errorsDiv= document.createElement("div");
    errorsDiv.id ="errors";
    errorsDiv.className= "linea";
    errorsDiv.tabIndex = 0;
    const elementList = form.elements;
    for(let i = 0; i< elementList.length; i++){
        let element =elementList[i];
        if('name' in element
            && (element.tagName.toUpperCase() === "INPUT" || element.tagName.toUpperCase() === "SELECT")
            && element.getAttribute("type") !== "submit"){
            let name = elementList[i].name;
            let value = elementList[i].value;
            if(!suggestions[name]['regex'].test(value)){
                let errorAnchor = document.createElement("a");
                errorAnchor.id = name+"error";
                errorAnchor.innerHTML= suggestions[name].suggestion;
                errorAnchor.onkeydown = event => keyEventFocus(event, name);
                errorAnchor.onclick = event => clickFocus(name);
                errorAnchor.tabIndex=0;
                let paragraph = document.createElement("p");
                paragraph.appendChild(errorAnchor);
                errorsDiv.appendChild(paragraph);
            }
        }
    }
    if (errorsDiv.hasChildNodes()){
        document.getElementById("content").insertBefore(errorsDiv,form);
        errorsDiv.focus();
    }
    else
        form.submit();
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

function keyEventFocus(keyEvent, name) {
    if (keyEvent.key === "Enter"){
        keyEvent.preventDefault();
        clickFocus(name);
    }
}
function clickFocus(name) {
    document.getElementById(name).focus();
}
