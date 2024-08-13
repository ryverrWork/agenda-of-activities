"use strict";

(function () {
    const formEditUser = document.getElementById("form-edit-user");

    // Form validation for Edit user
    FormValidation.formValidation(formEditUser, {
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: "Nama harus diisi",
                    },
                },
            },
            email: {
                validators: {
                    notEmpty: {
                        message: "Email harus diisi",
                    },
                    emailAddress: {
                        message: "Format email tidak valid",
                        requireGlobalDomain: true,
                    },
                },
            },
            confirm_password: {
                validators: {
                    identical: {
                        compare: function () {
                            return formEditUser.querySelector(
                                '[name="password"]',
                            ).value;
                        },
                        message:
                            "Konfirmasi password tidak sama dengan password",
                    },
                },
            },
            role: {
                validators: {
                    notEmpty: {
                        message: "Silahkan pilih role",
                    },
                },
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                // Use this for enabling/changing valid/invalid class
                // eleInvalidClass: '',
                eleValidClass: "",
                rowSelector: ".col-sm-12",
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
            autoFocus: new FormValidation.plugins.AutoFocus(),
        },
        init: (instance) => {
            instance.on("plugins.message.placed", function (e) {
                if (e.element.parentElement.classList.contains("input-group")) {
                    e.element.parentElement.insertAdjacentElement(
                        "afterend",
                        e.messageElement,
                    );
                }
            });
        },
    });
})();
