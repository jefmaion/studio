

dataTable('#table-instructor', {
    ajax:'/instructor',
    columns: [
        {data: 'name'},
        {data: 'profession'},
        {data: 'phone_wpp'},
        {data: 'created_at'},
    ]
})


dataTable('#table-instructor-modality',{})