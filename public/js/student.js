

dataTable('.datatable', {
    ajax:'/student',
    columns: [
        {data: 'name'},
        
        {data: 'phone_wpp'},
        {data: 'created_at'},
        {data: 'age'},
        {data: 'gender'},
        {data: 'has_registration'},
        {data: 'modalities'},
    ]
})