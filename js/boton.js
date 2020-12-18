document.getElementById("boton-pagar").disabled = true;
var checker = document.getElementById('check');
var sendbtn = document.getElementById('boton-pagar');
checker.onchange = function() {
  sendbtn.disabled = !this.checked;
};