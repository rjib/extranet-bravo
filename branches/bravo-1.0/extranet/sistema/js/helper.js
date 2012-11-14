/**
 * Helper com metodos uteis em javascript
 * 
 * @author Ricardo S. Alvarenga
 * @since 26/10/2012
 */

/**
 * Metodo para selecionar todos checkboxes
 * 
 * @param String
 *            nameCheckbox nome do checkbox
 * @author Ricardo S. Alvarenga
 * @since 26/10/2012
 */
function MarcarTodosCheckbox(nameCheckbox) {

	$(nameCheckbox).each(function() {
		if (!this.checked) {
			$(this).attr("checked", "checked");
		} else {
			$(this).removeAttr("checked");
		}
	});

}

/**
 * Metodo para validar o CPF *
 * 
 * @param String
 *            c cpf
 * @author Ricardo S. Alvarenga
 * @since 26/10/2012
 */
function validaCPF(c) {
	var i;
	s = c;
	var temp = s.substr(0, 3) + s.substr(4, 3) + s.substr(8, 3)
			+ s.substr(12, 2);
	c = temp;
	s = c;

	var c = s.substr(0, 9);
	var dv = s.substr(9, 2);
	var d1 = 0;
	var v = false;

	for (i = 0; i < 9; i++) {
		d1 += c.charAt(i) * (10 - i);
	}
	if (d1 == 0) {
		v = true;
		return false;
	}
	d1 = 11 - (d1 % 11);
	if (d1 > 9)
		d1 = 0;
	if (dv.charAt(0) != d1) {
		v = true;
		return false;
	}

	d1 *= 2;
	for (i = 0; i < 9; i++) {
		d1 += c.charAt(i) * (11 - i);
	}
	d1 = 11 - (d1 % 11);
	if (d1 > 9)
		d1 = 0;
	if (dv.charAt(1) != d1) {
		v = true;
		return false;
	}
	if (!v) {
		return true;
	}
}

/**
 * Metodo para verificar se uma string é vazia
 * @author Ricardo S. Alvarenga
 * @since 12/11/2012
 * @param string x
 * */
function notNull(x) {
	if (a != "" && !(a.match(/^\s+$/))) {
		return true;
	} else {
		return false;
	}
}

function marcarTodosModuloSelecao() {
		$("input[name='modulo_selecao[]']").each(function() {

			if (!this.checked) {

				$(this).attr("checked", "checked");
			} else {
				$(this).removeAttr("checked");

			}

		});
}
function marcarTodosIncluir() {
	$("input[name='modulo_incluir[]']").each(function() {

		if (!this.checked) {

			$(this).attr("checked", "checked");
		} else {
			$(this).removeAttr("checked");

		}

	});
}
function marcarTodosEditar() {
	$("input[name='modulo_editar[]']").each(function() {

		if (!this.checked) {

			$(this).attr("checked", "checked");
		} else {
			$(this).removeAttr("checked");

		}

	});
}

function marcarTodosExcluir() {
	$("input[name='modulo_excluir[]']").each(function() {

		if (!this.checked) {

			$(this).attr("checked", "checked");
		} else {
			$(this).removeAttr("checked");

		}

	});
}
