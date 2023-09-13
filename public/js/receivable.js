

dataTable('.datatable', {
    ajax:'/account/receivable',
    columns: [
        {data: 'data'},
        {data: 'amount'},
        {data: 'status'},
        
        {data: 'description'},
        {data: 'actions'},
    ]
})