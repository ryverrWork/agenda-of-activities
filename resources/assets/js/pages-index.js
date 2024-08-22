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
            ajax: "/data",
            columns: [
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
                    data: "file_url",
                    render: function (data, type, row) {
                        return (
                            '<a href="/storage/' +
                            data +
                            '" download>Download</a>'
                        );
                    },
                },
                {
                    data: "approved_by",
                    render: function (data, type, row) {
                        return data && data.name ? data.name : "N/A"; // Adjusted rendering
                    },
                },
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
            ],
            orderable: false,
            displayLength: 15,
            paging: false, // Hide pagination
            searching: false, // Hide search box
            lengthChange: false,
            bInfo: false,
        });
    }
});
