$(document).ready(function() {
    type: 'POST',
		dataType: 'json',
		url: 'tabla/showInstituciones',
		success: function(data) {
            if (data.error) {
				console.error(data.message);
				M.toast({
					html: `<span class='red-text'>${data.message} </span>`
				});
			} else {
                
                $('#tabla').append(`
						<table>
							<tr>
								<th >ID Institucion</th>
							</tr>
							${data.institucionData
								.map(institucion => {
									return `
									<tr>
										<td>${institucion.id_institucion} </td>
									</tr>`;
								})
								.join('')}
						</table>
				`);
            }

        }//End Success AJAX
} //End JS