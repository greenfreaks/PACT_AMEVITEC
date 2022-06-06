// alert("JS conectado");

$(document).ready(function(){
  $.ajax({
      type: 'POST',
      dataType: 'json',
      url: 'buscadorPropiedadIntelectual/getAllPropiedadIntelectualController',
      success: function(data){
          console.log(data);
          if(data.error){
              console.error(data.message);
          }else{
              console.log(data);
              console.log(data.msg);
              let propiedadIntelectual = [];
              let niveltrl = [];
              for (pi of data.propiedadesIntelectuales){
                // $('#report').html(propiedadIntelectual +=
                let tablaProp =   
                  `<tr class = "active-row">
                  <td class = "center"> ${pi.nombreTec}</td>
                  <td class = "center"> ${pi.titular}</td>
                  <td class = "center"> ${pi.inventores}</td>  
                  <td class = "center"> ${pi.tipo} </td>
                  <td class = "center"> ${pi.titulo}</td>
                  <td class = "center"> ${pi.resumen}</td>
                  <td class = "center"> ${pi.estatus}</td>
                  
                  <td class = "center">`;
                  let uiNvl = "";
                  uiNvl += '<ul>'
                  for(var i = 0; i < (pi.nivelTrl).length; i++){
                    uiNvl += `<li><a href = "userTech/verproyecto/${pi.fk_tecnologia}">
                    ` + pi.nivelTrl[i].nivel+ `
                    </a></li>
                    `
                  }
                  uiNvl += `</ul>`
                  tablaProp += uiNvl +  
                  `</td>

                  <td class = "center">`;
                    ulReg = "";
                    ulReg += '<ul>'
                    for(let i = 0; i < (pi.regionPropiedad).length; i++){
                      ulReg += `<li> ${pi.regionPropiedad[i].fk_regionPropiedad} </li>`
                    }
                    ulReg += '</ul>'
                    tablaProp += ulReg +
                  ` </td>

                  <td class = "center"> ${pi.numeroPatente}</td>
                  <td class = "center">${pi.link}</td>
                  </tr>`
                  $('#report').html(propiedadIntelectual += tablaProp
                  );
                  
              }
              // $('#propiedadIntelectual__table').append(propiedadIntelectual);
              // $('#report').append(propiedadIntelectual);
          }
      },
      error: function(e) {
    console.error(e);
    M.toast({
      html:
        '⚠ Ocurrio un error al enviar sus datos, por favor recargue la pagina e intente de nuevo ⚠'
    });
  },
      beforeSend: function() {
    console.log('Inicio de envio de datos');
    console.group();
  },
      complete: function() {
    console.groupEnd();
    console.log('Fin de envio de datos');
  }
  });
  
  // M.AutoInit();
  var $rows = $('tbody#report tr')
 
   var $filters = $('.table-filter').change(function(){
     var filterArr = $filters.filter(function(){
        return this.value
     }).map(function(){
        var $el = $(this);
        var value = $el.is('select') ? $el.find(':selected').text() :$el.val()  
        return {
          col: $el.data('col'),
          value: value.toLowerCase()
        }
     }).get();
     if(!filterArr.length){
       $rows.show()
     }else{
       $rows.hide().filter(function(){
          var $row = $(this)
          return filterArr.every(function(filterObj, i){
             var cellText = $row.find('td').eq(filterObj.col).text().toLowerCase();             
            return  cellText.includes(filterObj.value);
          })
       }).show()
     }
   })
});