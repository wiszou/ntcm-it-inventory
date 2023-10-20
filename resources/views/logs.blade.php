<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inventory Logs</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->



</head>
<style>
/*Overrides for Tailwind CSS */

/*Form fields*/

.dataTables_wrapper select,
.dataTables_wrapper .dataTables_filter input {
    color: #4a5568;
    /*text-gray-700*/
    padding-left: 1rem;
    /*pl-4*/
    padding-right: 1rem;
    /*pl-4*/
    padding-top: .5rem;
    /*pl-2*/
    padding-bottom: .5rem;
    /*pl-2*/
    line-height: 1.25;
    /*leading-tight*/
    border-width: 1px;
    /*border-2*/
    border-radius: .25rem;
    border-color: #4d4d4d;
    /*border-gray-200*/
    background-color: #ffffff;
    /*bg-gray-200*/
}


/*Row Hover*/
table.dataTable.hover tbody tr:hover,
table.dataTable.display tbody tr:hover {
    background-color: #4facb6;
    /*bg-indigo-100*/
    color: #ffffff;
    font-weight: 400;
}


/*Pagination Buttons*/

.dataTables_wrapper .dataTables_paginate .paginate_button {

    font-weight: 500;
    /*font-bold*/
    border-radius: .25rem;
    /*rounded*/
    border: 1px solid transparent;
    /*border border-transparent*/

}


/*Pagination Buttons - Current selected */

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    color: #5c5c5c !important;
    /*text-white*/
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    /*shadow*/
    font-weight: 200;
    /*font-bold*/
    border-radius: .25rem;
    /*rounded*/
    background: #d6d6d6 !important;
    /*bg-indigo-500*/
    border: 1px solid transparent;
    /*border border-transparent*/

}


/*Pagination Buttons - Hover */

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    color: #ffffff;
    /*text-white*/
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    /*shadow*/
    font-weight: 400;
    /*font-bold*/
    border-radius: .25rem;
    /*rounded*/
    background: #d6d6d6 !important;
    /*bg-indigo-500*/
    border: 1px;
    /*border border-transparent*/

}


/*Change colour of responsive icon*/
table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
    background-color: #4facb6 !important;
    /*bg-indigo-500*/
}


th {
    text-align: left;
    /* Align header text to the left */
}


td {
    text-align: left;
    /* Align cell text to the left */
}


input[disabled] {
    background-color: #E9ECEF;
    /* Change the text color to gray */
}
</style>


<body class="bg-gray-100 py-2">

    @include('components.sidebar')

    <div class="ml-auto px-2 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
        <div class="my-auto flex justify-start">
            <!--Container-->
            <div class="w-full">

                <div class="p-8 my-2 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
                    <h2 class="text-2xl font-bold text-ntccolor">
                        Inventory Logs
                    </h2>
                </div>
                <!--Card-->
                <div id='recipients' class="p-8 lg:mt-0 rounded shadow bg-white">
                    <table id="logs" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th data-priority="1" class="text-center">Log ID</th>
                                <th data-priority="2" class="text-center">Description</th>
                                <th data-priority="3" class="text-center">User</th>
                                <th data-priority="4" class="text-center">Date</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTableBody">
                            @foreach ($logs as $log)
                            <tr class="text-center">
                                <td class="text-center">{{ $log->log_id }}</td>
                                <td class="text-center">{{ $log->description }}</td>
                                <td class="text-center">{{ $log->user }}</td>
                                <td class="text-center">{{ $log->date_added }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
                <!--/Card-->

            </div>
            <!--/container-->

            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <!-- jQuery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

            <!--Datatables -->
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
            
            <script>
            $(document).ready(function() {
                var table = $('#logs').DataTable({
                    responsive: true,
                    order: [
                        [3, 'desc']
                    ]
                }).columns.adjust().responsive.recalc();
            });
            </script>


        </div>
    </div>

</body>

</html>