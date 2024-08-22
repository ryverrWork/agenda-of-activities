"use strict";

(function () {
    const datepickerList = document.querySelectorAll(".date-picker");
    const formEditActivity = document.getElementById("form-edit-activity");

    // Flat Picker Date
    if (datepickerList) {
        datepickerList.forEach(function (datepicker) {
            datepicker.flatpickr({
                enableTime: false,
                monthSelectorType: "static",
            });
        });
    }

    // Form validation for Edit activity
    FormValidation.formValidation(formEditActivity, {
        fields: {
            date: {
                validators: {
                    notEmpty: {
                        message: "Tanggal harus diisi",
                    },
                    date: {
                        format: "YYYY-MM-DD",
                        message: "Format tanggal salah",
                    },
                },
            },
            day: {
                validators: {
                    notEmpty: {
                        message: "Hari harus diisi",
                    },
                },
            },
            time: {
                validators: {
                    notEmpty: {
                        message: "Jam harus diisi",
                    },
                },
            },
            activity: {
                validators: {
                    notEmpty: {
                        message: "Kegiatan harus diisi",
                    },
                },
            },
            location: {
                validators: {
                    notEmpty: {
                        message: "Lokasi harus diisi",
                    },
                },
            },
            number_of_participants: {
                validators: {
                    notEmpty: {
                        message: "Jumlah peserta harus diisi",
                    },
                    numeric: {
                        message: "Jumlah peserta harus angka",
                    },
                },
            },
            pic: {
                validators: {
                    notEmpty: {
                        message: "PIC harus diisi",
                    },
                },
            },
            phone_number: {
                validators: {
                    notEmpty: {
                        message: "No HP harus diisi",
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
                rowSelector: ".form-floating",
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
