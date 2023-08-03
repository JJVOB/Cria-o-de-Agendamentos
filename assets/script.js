let btnEdit = document.querySelectorAll('.btn-edit');

btnEdit.forEach(btn => {
  btn.addEventListener('click', e => {
    let modal = document.getElementById('editarModal');
    let valorDoBotao = e.target.value;

    if (valorDoBotao !== undefined) {
      var novoInput = document.createElement("input");
      novoInput.setAttribute("type", "hidden");
      novoInput.setAttribute("name", "idEdit");
      novoInput.setAttribute("value", valorDoBotao);
      var form = document.getElementById("formEdit");
      var inputExcluir = form.querySelector("input[name='idEdit']");

      if (inputExcluir) {
        form.removeChild(inputExcluir);
      }
      form.appendChild(novoInput);
    }

    $(modal).modal('show');
  });
});

let btnDelete = document.querySelectorAll('.btn-delete');
btnDelete.forEach(btn => {
    btn.addEventListener('click', e => {
        let modal = document.getElementById('confirmarExclusaoModal');
        let valorDoBotao = e.target.value;

        // Verifica se o valorDoBotao é definido
        if (valorDoBotao !== undefined) {
            var novoInput = document.createElement("input");
            novoInput.setAttribute("type", "hidden");
            novoInput.setAttribute("name", "idDelete");
            novoInput.setAttribute("value", valorDoBotao);
            var form = document.getElementById("formDelete");
            var inputExcluir = form.querySelector("input[name='idDelete']");

            if (inputExcluir) {
            form.removeChild(inputExcluir);
            }
            form.appendChild(novoInput);
        }

        $(modal).modal('show');
    });
  });
