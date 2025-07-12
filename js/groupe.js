function closeAllDivs(){
    let peopleSections = document.getElementsByClassName("peopleSection")
    for (let section of peopleSections) {
        section.style.display="none";
    }
}

function  openDiv(div){
    closeAllDivs();
    document.getElementById(div).style.display="flex";
}

function  closeDiv(div){
    document.getElementById(div).style.display="none";
}
