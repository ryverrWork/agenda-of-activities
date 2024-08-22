/**
 * DataTables Basic
 */

"use strict";

let fv, offCanvasEl;
document.addEventListener("DOMContentLoaded", function (e) {
    (function () {
        const formAddNewRecord = document.getElementById("form-add-new-record");

        setTimeout(() => {
            const newRecord = document.querySelector(".create-new"),
                offCanvasElement = document.querySelector("#add-new-record");

            // To open offCanvas, to add new record
            if (newRecord) {
                newRecord.addEventListener("click", function () {
                    offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                    // Empty fields on offCanvas open
                    (offCanvasElement.querySelector(".dt-date").value = ""),
                        (offCanvasElement.querySelector(".dt-day").value = ""),
                        (offCanvasElement.querySelector(".dt-time").value = ""),
                        (offCanvasElement.querySelector(".dt-activity").value =
                            ""),
                        (offCanvasElement.querySelector(".dt-location").value =
                            ""),
                        (offCanvasElement.querySelector(
                            ".dt-number-of-participants",
                        ).value = ""),
                        (offCanvasElement.querySelector(".dt-pic").value = ""),
                        (offCanvasElement.querySelector(
                            ".dt-phone-number",
                        ).value = ""),
                        (offCanvasElement.querySelector(".dt-notes").value =
                            ""),
                        (offCanvasElement.querySelector(".dt-file").value = "");
                    // Open offCanvas with form
                    offCanvasEl.show();
                });
            }
        }, 200);

        // Form validation for Add new record
        fv = FormValidation.formValidation(formAddNewRecord, {
            fields: {
                date: {
                    validators: {
                        notEmpty: {
                            message: "Tanggal harus diisi",
                        },
                        date: {
                            format: "DD/MM/YYYY",
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
                file: {
                    validators: {
                        notEmpty: {
                            message: "Silahkan upload undangan",
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
                    if (
                        e.element.parentElement.classList.contains(
                            "input-group",
                        )
                    ) {
                        e.element.parentElement.insertAdjacentElement(
                            "afterend",
                            e.messageElement,
                        );
                    }
                });
            },
        });

        // FlatPickr Initialization & Validation
        const flatpickrDate = document.querySelector('[name="date"]');

        if (flatpickrDate) {
            flatpickrDate.flatpickr({
                enableTime: false,
                // See https://flatpickr.js.org/formatting/
                dateFormat: "d/m/Y",
                // After selecting a date, we need to revalidate the field
                onChange: function () {
                    fv.revalidateField("date");
                },
            });
        }

        formAddNewRecord.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission
            fv.validate().then(function (status) {
                if (status === "Valid") {
                    // Form is valid; you can submit it
                    formAddNewRecord.submit();
                } else {
                    console.log("Form is invalid");
                }
            });
        });
    })();
});

// datatable (jquery)
$(function () {
    var dt_basic_table = $(".datatables-basic"),
        dt_basic;

    // DataTable with buttons
    // --------------------------------------------------------------------

    if (dt_basic_table.length) {
        dt_basic = dt_basic_table.DataTable({
            serverSide: true,
            ajax: "/dashboard/activities/data",
            columns: [
                {
                    data: null, // Auto-numbering column
                    render: function (data, type, row, meta) {
                        return meta.row + 1; // Auto-numbering
                    },
                },
                { data: "date" },
                { data: "day" },
                { data: "time" },
                { data: "name" },
                { data: "location" },
                { data: "number_of_participants" },
                { data: "person_in_charge" },
                { data: "phone_number" },
                { data: "notes" },
                {
                    data: "status",
                    render: function (data, type, row) {
                        // Use ucfirst to capitalize the first letter
                        return data.charAt(0).toUpperCase() + data.slice(1);
                    },
                },
                {
                    data: "approved_by",
                    render: function (data, type, row) {
                        return data && data.name ? data.name : "N/A"; // Adjusted rendering
                    },
                },
                { data: null },
            ],
            columnDefs: [
                {
                    responsivePriority: 1,
                    targets: 4,
                },
                {
                    responsivePriority: 2,
                    targets: 5,
                },
                {
                    // Actions
                    targets: -1,
                    title: "Aksi",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        // Generate the download URL for the file
                        var downloadUrl = "/storage/" + full.file_url; // Assuming 'file_path' is the name of the file in storage

                        return (
                            '<a href="' +
                            downloadUrl +
                            '" class="btn btn-sm btn-text-secondary rounded-pill btn-icon" target="_blank"><i class="ri-download-2-line"></i></a>'
                        );
                    },
                },
            ],
            order: [[1, "desc"]],
            dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 10,
            lengthMenu: [10, 25, 50, 75, 100],
            language: {
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>',
                },
            },
            buttons: [
                {
                    text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Tambah Agenda Kegiatan</span>',
                    className:
                        "create-new btn btn-primary waves-effect waves-light",
                },
            ],
        });
        $("div.head-label").html(
            '<h5 class="card-title mb-0">Agenda Kegiatan</h5>',
        );
    }
});
