
/**
* Theme: Velonic Admin Template
* Author: Coderthemes
* Form Validator
*/
!function($) {
    "use strict";

    var FormValidator = function() {
        this.$formDefault = $("form[validate='true']");
    };

    //init
    FormValidator.prototype.init = function() {
        //validator plugin
        $.validator.setDefaults({
            submitHandler: function() {
                //if($("#formDefault").is('.sendbyjs')){
                //    forms.sendForms($("#formDefault")); return false;
                //}else{
                //    $("#formDefault").submit(); return false;
                //}
                return true;
            }
        });

        // validate signup form on keyup and submit
        this.$formDefault.validate({
            required: "Este campo é obrigatório.",
            rules: {
                firstname: "required",
                lastname: "required",
                username: {
                    required: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength: 2
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
                agree: "required"
            },
            messages: {
                firstname: "Por favor, preencha seu nome.",
                lastname: "Por favor, preencha seu sobrenome.",
                username: {
                    required: "Por favor, preencha seu usuário.",
                    minlength: "Seu nome de usuário é muito curto, utilize um nome maior."
                },
                password: {
                    required: "Por favor, preencha seu sua senha.",
                    minlength: "Sea senha é muito curta, utilize uma senha maior."
                },
                confirm_password: {
                    required: "Por favor, confirme sua senha.",
                    minlength: "Seu nome de usuário é muito curto, utilize um nome maior.",
                    equalTo: "As suas senhas não conferem, preencha novamente"
                },
                email: "Por favor, preencha um endereço de e-mail correto.",
                agree: "Você deve aceitar nossa política."
            }
        });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });

    },
    //init
    $.FormValidator = new FormValidator, $.FormValidator.Constructor = FormValidator
}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.FormValidator.init()
}(window.jQuery);