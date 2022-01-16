window.addEventListener('load', function () {

    const form = document.querySelector('form')
    const url = form.action;


    form.addEventListener('submit', function (e) {
        e.preventDefault()
        
        if(validarForm()){
            const formData = new FormData(form);
            axios.post(url, formData).then(function (response){
                var html = '<ul>';
                var myAlert = document.getElementById('toast');//select id of toast
                for(m of response.data){
                    html += '<li>'+m.message+'</li>';
                }
                html += '</ul>'
                myAlert.innerHTML = html;
                var bsAlert = new bootstrap.Toast(myAlert);//inizialize it
                bsAlert.show();//show it
            });
        }else{
            const alert = document.getElementById('alert-errors');
            alert.classList.remove('d-none');
            setTimeout(function () {
                alert.classList.add('d-none');
            }, 10000);
        }
        
    })

})

function validarForm(){
    //Formulario
    const form = document.querySelector('form');

    //Expresion regular email
    const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let errores = 0;
    //inputs formulario
    const nombre = document.getElementById('nombre');
    const email = document.getElementById('email');
    const sexo = document.querySelector('input[name="sexo"]:checked');
    const area = document.getElementById('area');
    const descripcion = document.getElementById('descripcion');
    const roles = document.querySelectorAll('input[name="rol_id[]"]:checked');

    //Validaciones
    if(nombre.value == ''){
        nombre.classList.add('is-invalid');
        errores++;
    }else{
        nombre.classList.remove('is-invalid');
        nombre.classList.add('is-valid');
    }

    if(!email.value.match(mailformat) && email.value == ''){
        email.classList.add('is-invalid');
        errores++;
    }else{
        email.classList.remove('is-invalid');
        email.classList.add('is-valid');

    }

    if(sexo.value == ''){
        sexo.classList.add('is-invalid');
        errores++;
    }else{
        sexo.classList.remove('is-invalid');
        sexo.classList.add('is-valid');
    }

    if(area.value == ''){
        area.classList.add('is-invalid');
        errores++;
    }else{
        area.classList.remove('is-invalid');
        area.classList.add('is-valid');
    }

    if(descripcion.value == ''){
        descripcion.classList.add('is-invalid');
        errores++;
    }else{
        descripcion.classList.remove('is-invalid');
        descripcion.classList.add('is-valid');
    }

    if(roles.length == 0){
        const alerta = document.getElementById('alert');
        alerta.classList.remove('d-none');
        errores++;
        setTimeout(function () {
            alerta.classList.add('d-none');
        }, 5000);
    }

    if(errores > 0){
        return false;
    }else{
        return true
    }

}
