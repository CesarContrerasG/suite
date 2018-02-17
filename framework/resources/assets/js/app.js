
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: 'body'
});


    $("#delete").click(function(){
        var url = $(this).data('url');
        var token = $(this).data('token');
        var res = confirm("¿Desea eliminar el registro?");
        if (res == true) {
            $.post({
                type: $(this).data("method"),
                url: url,
                data: {_token :token},
            }).done(function (data) {
                window.location= data['redirect'];
            });
        }
    });
