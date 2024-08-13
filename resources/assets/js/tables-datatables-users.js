/**
 * DataTables Basic
 */

"use strict";

let fv, offCanvasEl;
document.addEventListener("DOMContentLoaded", function (e) {
    (function () {
        const formAddUser = document.getElementById("form-add-new-user");

        setTimeout(() => {
            const newUser = document.querySelector(".create-new"),
                offCanvasElement = document.querySelector("#add-new-user");

            // To open offCanvas, to add new record
            if (newUser) {
                newUser.addEventListener("click", function () {
                    offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                    // Empty fields on offCanvas open
                    (offCanvasElement.querySelector(".dt-name").value = ""),
                        (offCanvasElement.querySelector(".dt-email").value =
                            ""),
                        (offCanvasElement.querySelector(".dt-password").value =
                            ""),
                        (offCanvasElement.querySelector(
                            ".dt-confirm-password",
                        ).value = ""),
                        (offCanvasElement.querySelector(".dt-role").value = "");
                    // Open offCanvas with form
                    offCanvasEl.show();
                });
            }
        }, 200);

        // Form validation for Add new record
        fv = FormValidation.formValidation(formAddUser, {
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
                password: {
                    validators: {
                        notEmpty: {
                            message: "Password harus diisi",
                        },
                    },
                },
                confirm_password: {
                    validators: {
                        notEmpty: {
                            message: "Konfirmasi password harus diisi",
                        },
                        identical: {
                            compare: function () {
                                return formAddUser.querySelector(
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

        formAddUser.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission
            fv.validate().then(function (status) {
                if (status === "Valid") {
                    // Form is valid; you can submit it
                    formAddUser.submit();
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
            ajax: "/dashboard/users/data",
            columns: [
                {
                    data: null, // Auto-numbering column
                    render: function (data, type, row, meta) {
                        return meta.row + 1; // Auto-numbering
                    },
                },
                { data: "name" },
                { data: "email" },
                { data: "role" },
                { data: "created_at" },
                { data: "updated_at" },
                { data: null },
            ],
            columnDefs: [
                {
                    responsivePriority: 1,
                    targets: 1,
                },
                {
                    responsivePriority: 2,
                    targets: 2,
                },
                {
                    // Actions
                    targets: -1,
                    title: "Aksi",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<a href="/dashboard/users/' +
                            full.id +
                            '/edit" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i class="ri-edit-box-line"></i></a>' +
                            '<a href="javascript:;" data-url="/dashboard/users/delete/' +
                            full.id +
                            '" class="btn btn-sm btn-text-secondary rounded-pill btn-icon text-danger delete-record"><i class="ri-delete-bin-line"></i></a>'
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
                                columns: [0, 1, 2, 3, 4, 5],
                            },
                            customize: function (win) {
                                //customize print view for dark
                                $(win.document.body)
                                    .css("color", config.colors.headingColor)
                                    .css(
                                        "border-color",
                                        config.colors.borderColor,
                                    )
                                    .css(
                                        "background-color",
                                        config.colors.bodyBg,
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
                                columns: [0, 1, 2, 3, 4, 5],
                            },
                        },
                        {
                            extend: "excel",
                            text: '<i class="ri-file-excel-line me-1"></i>Excel',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5],
                            },
                        },
                        {
                            extend: "pdf",
                            text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5],
                            },
                        },
                    ],
                },
                {
                    text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Tambah Pengguna</span>',
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
        $("div.head-label").html('<h5 class="card-title mb-0">Pengguna</h5>');
    }

    $(document).on("click", ".delete-record", function (e) {
        e.preventDefault();

        var url = $(this).data("url"); // Get the URL for the delete action
        var token = $('meta[name="csrf-token"]').attr("content"); // Get the CSRF token

        if (confirm("Are you sure you want to delete this record?")) {
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: token, // Pass the CSRF token
                },
                success: function (response) {
                    if (response.success) {
                        dt_basic.ajax.reload(); // Reload the DataTable
                    } else {
                        alert("Error deleting record.");
                    }
                },
                error: function () {
                    alert("Error processing request.");
                },
            });
        }
    });
});
