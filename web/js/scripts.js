window.addEventListener('load', function () {

    const form = document.querySelector('form')

    form.addEventListener('submit', function (e) {
        e.preventDefault()
        const url = form.action;
        
        const formData = new FormData(form);
        
        axios.post(url, formData).then(function (response){
            console.log(response.data)
        });
    })

})
