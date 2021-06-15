require('./bootstrap');

$(document).ready(function(){
    $('form.confirmed').submit(function(e){
        if(!confirm('Подтвердите действие')){
            e.preventDefault()
            return false
        }
    })
})