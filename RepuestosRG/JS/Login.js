const inputs = document.querySelectorAll("input");

function addCL(){
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function RemoveCL(){
    let parent = this.parentNode.parentNode;
    if(this.value == ""){
        parent.classList.remove("focus");
    }
}

inputs.forEach(input => {
    input.addEventListener("focus", addCL);
    input.addEventListener("blur", RemoveCL);
});