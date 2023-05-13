<script>
    $(function() {
            var dynamicObjectArray = tabelDataArray.map(function(item) {
                return {
                    data: item,
                    name: item
                };
            });
            dataTable =
                $('#datatable').dataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: get_data_url,

                    columns: dynamicObjectArray
                });
        });
</script>
