/** Modulo que contiene llas funciones y variables necesarias para el modulo usuarios
 * @author Camilo Garzon
 * @since 2015-06-10
 */
var User = {};

/**
 * Funcion que define variables y funciones
 */
(function() {

    /** variable para indicar si la informacion de un formulario se debe guardar */
    User.saveForm = null;

    /**
     * Metodo para validar si un nombre de usuario ya existe
     */
    User.onChangeUsername = function(event) {
        var username = event.target.value;
        User.saveForm.username = true;
        Util.errorMessageShowHide('username', false);
        if (username != $('#username_old').val()) {
            User.checkUserNameExist(username);
        }
    };

    /**
     * Metodo para consultar mediante AJAX si un nombre de usuario ya existe en la DB.
     * Si ya existe, no permite guardar los datos
     * @param String username, Nombre de usuario a verificar
     */
    User.checkUserNameExist = function(username) {
        var data = {username: username};
        var url = rootUrl + 'ajax/usernameexist';
        Util.callAjax(data, url, 'POST', User.checkUserNameExistSuccess);

    };

    /**
     * Metodo para procesar la respuesta exitosa de metodo ajax que verifica si un nombre de usuario ya existe
     */
    User.checkUserNameExistSuccess = function(data) {
        if (data.response) {
            User.saveForm.username = false;
            Util.errorMessageShowHide('username', true, 'El nombre de usuario ingresado ya existe, utilice otro');
        }
    };

    /**
     * Metodo para validar si un email es correcto
     */
    User.onChangeEmail = function(event) {
        var email = event.target.value;
        User.saveForm.email = true;
        Util.errorMessageShowHide('email', false);
        if (!Util.isEmail(email)) {
            User.saveForm.email = false;
            Util.errorMessageShowHide('email', true, 'El email ingresado no es valido');
        }
    };

    /**
     * Metodo para validar si un formulario es correcto
     */
    User.onSubmitForm = function(event) {
        var form = event.target.value;
        User.saveForm;
        for (var key in User.saveForm) {
            if (!User.saveForm[key]) {
                Util.errorMessageShowHide('save_button', true, 'El formulario tiene errores');
                return false;
            }
        }
        return true;
    };

    /**
     * Metodo que inicializa el modulo
     */
    User.initialize = function() {
        User.saveForm = {};
        $('#username').change(User.onChangeUsername);
        $('#email').change(User.onChangeEmail);
        $('#form_user').submit(User.onSubmitForm);
    };

})();
/** funcion que se ejecuta al terminar el cargar el documento */
$(function() {
    User.initialize();
});
