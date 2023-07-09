let startValue = 1;
let disabledBtn = document.getElementById("disabledBtn");
disabledBtn.disabled = true;
function addValueFunction(valuePar){
    document.getElementById("amount");

    if(valuePar.value == "increase"){
        startValue++;
    }
    else {
        startValue--;
    }


    if (startValue == 1){
        disabledBtn.disabled = true;
    }
    else {
        disabledBtn.disabled = false;
    }
    let input = document.getElementById("amount");
    input.value = startValue.toString();

    document.addEventListener("DOMContentLoaded", ModifyPlaceHolder)
}