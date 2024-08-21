/**
 * DataTables Basic
 */

"use strict";

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
                { data: "person_in_charge" },
                { data: "phone_number" },
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

                        // Check the status and conditionally render the buttons
                        if (
                            full.status === "approved" ||
                            full.status === "rejected"
                        ) {
                            return (
                                '<a href="' +
                                downloadUrl +
                                '" class="btn btn-sm btn-text-secondary rounded-pill btn-icon" target="_blank"><i class="ri-download-2-line"></i></a>'
                            );
                        } else {
                            return (
                                '<a href="' +
                                downloadUrl +
                                '" class="btn btn-sm btn-text-secondary rounded-pill btn-icon" target="_blank"><i class="ri-download-2-line"></i></a>' +
                                '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-approve" data-id="' +
                                full.id +
                                '"><i class="ri-check-line"></i></a>' +
                                '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-reject" data-id="' +
                                full.id +
                                '"><i class="ri-close-line"></i></a>'
                            );
                        }
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
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
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
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            },
                        },
                        {
                            extend: "excel",
                            text: '<i class="ri-file-excel-line me-1"></i>Excel',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            },
                        },
                        {
                            extend: "pdf",
                            text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            },
                        },
                    ],
                },
            ],
        });
        $("div.head-label").html(
            '<h5 class="card-title mb-0">Agenda Kegiatan</h5>',
        );

        // Handle approve and reject link clicks
        $(document).on("click", ".item-approve", function (e) {
            e.preventDefault(); // Prevent the default link behavior
            var id = $(this).data("id");
            updateRecordStatus(id, "approved");
        });

        $(document).on("click", ".item-reject", function (e) {
            e.preventDefault(); // Prevent the default link behavior
            var id = $(this).data("id");
            updateRecordStatus(id, "rejected");
        });

        function updateRecordStatus(id, status) {
            $.ajax({
                url: "/dashboard/activities/update-status",
                method: "POST",
                data: {
                    id: id,
                    status: status,
                    _token: $('meta[name="csrf-token"]').attr("content"), // CSRF token
                },
                success: function (response) {
                    if (response.success) {
                        dt_basic.ajax.reload(); // Reload DataTable
                    } else {
                        alert("Error updating record status.");
                    }
                },
                error: function () {
                    alert("Error processing request.");
                },
            });
        }
    }
});
