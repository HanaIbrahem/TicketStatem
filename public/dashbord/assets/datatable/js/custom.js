$(document).ready(function(){
    var table = $('#example').DataTable({
        buttons: [
            { extend: 'copy', text: 'Copy', attr: { id: 'btncus' } },
            { extend: 'csv', text: 'CSV', attr: { id: 'btncus' } },
            { extend: 'excel', text: 'Excel', attr: { id: 'btncus' } },
            { extend: 'pdf', text: 'PDF', attr: { id: 'btncus' } },
            { extend: 'print', text: 'Print', attr: { id: 'btncus' } }
        ]
    });
    
    // Move buttons container to the desired location
    table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    
});
