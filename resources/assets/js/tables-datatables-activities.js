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
                        (offCanvasElement.querySelector(".dt-pic").value = ""),
                        (offCanvasElement.querySelector(
                            ".dt-phone-number"
                        ).value = ""),
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
                            "input-group"
                        )
                    ) {
                        e.element.parentElement.insertAdjacentElement(
                            "afterend",
                            e.messageElement
                        );
                    }
                });
            },
        });

        // FlatPickr Initialization & Validation
        const flatpickrDate = document.querySelector('[name="basicDate"]');

        if (flatpickrDate) {
            flatpickrDate.flatpickr({
                enableTime: false,
                // See https://flatpickr.js.org/formatting/
                dateFormat: "m/d/Y",
                // After selecting a date, we need to revalidate the field
                onChange: function () {
                    fv.revalidateField("basicDate");
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
                { data: "no" },
                { data: "date" },
                { data: "day" },
                { data: "time" },
                { data: "name" },
                { data: "location" },
                { data: "person_in_charge" },
                { data: "phone_number" },
                { data: "" },
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
                        return (
                            '<div class="d-inline-block">' +
                            '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ri-more-2-line"></i></a>' +
                            '<ul class="dropdown-menu dropdown-menu-end m-0">' +
                            '<li><a href="javascript:;" class="dropdown-item">Details</a></li>' +
                            '<div class="dropdown-divider"></div>' +
                            '<li><a href="javascript:;" class="dropdown-item text-danger delete-record">Hapus</a></li>' +
                            "</ul>" +
                            "</div>" +
                            '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i class="ri-edit-box-line"></i></a>'
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
                    extend: "collection",
                    className:
                        "btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light",
                    text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    buttons: [
                        {
                            extend: "print",
                            text: '<i class="ri-printer-line me-1" ></i>Print',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7],
                            },
                            customize: function (win) {
                                //customize print view for dark
                                $(win.document.body)
                                    .css("color", config.colors.headingColor)
                                    .css(
                                        "border-color",
                                        config.colors.borderColor
                                    )
                                    .css(
                                        "background-color",
                                        config.colors.bodyBg
                                    );
                                $(win.document.body)
                                    .find("table")
                                    .addClass("compact")
                                    .css("color", "inherit")
                                    .css("border-color", "inherit")
                                    .css("background-color", "inherit");
                            },
                        },
                        {
                            extend: "csv",
                            text: '<i class="ri-file-text-line me-1" ></i>Csv',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7],
                            },
                        },
                        {
                            extend: "excel",
                            text: '<i class="ri-file-excel-line me-1"></i>Excel',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7],
                            },
                        },
                        {
                            extend: "pdf",
                            text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7],
                            },
                        },
                    ],
                },
                {
                    text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Tambah Agenda Kegiatan</span>',
                    className:
                        "create-new btn btn-primary waves-effect waves-light",
                },
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data["full_name"];
                        },
                    }),
                    type: "column",
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== "" // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                      col.rowIndex +
                                      '" data-dt-column="' +
                                      col.columnIndex +
                                      '">' +
                                      "<td>" +
                                      col.title +
                                      ":" +
                                      "</td> " +
                                      "<td>" +
                                      col.data +
                                      "</td>" +
                                      "</tr>"
                                : "";
                        }).join("");

                        return data
                            ? $('<table class="table"/><tbody />').append(data)
                            : false;
                    },
                },
            },
        });
        $("div.head-label").html(
            '<h5 class="card-title mb-0">Agenda Kegiatan</h5>'
        );
    }
});
