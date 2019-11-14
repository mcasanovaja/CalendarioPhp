$(function(){
  var n = new nuevo_Usuario();
})


class nuevo_Usuario {
  constructor() {
    this.submitEvent()
  }

  submitEvent(){
    $('form').submit((event)=>{
      event.preventDefault()
      this.sendForm()
    })
  }

  sendForm(){
    let form_data = new FormData();
    form_data.append('nombres', $('#nombres').val())
    form_data.append('apellidos', $('#apellidos').val())
    form_data.append('correo', $('#correo').val())
    form_data.append('password', $('#password').val())
    
      $.ajax({
      url: '../server/create_user.php',
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      data: form_data,
      type: 'POST',
      success: function(php_response){
        if (php_response.conexion == "OK") {
          window.location.href = 'main.html';
          //console.log(php_response)
        }else {
          alert(php_response.msg);
        }
      },
      error: function(e){
        alert("error en la comunicación con el servidor" + e);
        console.log(e);
      }
     })   
    
  }
}
