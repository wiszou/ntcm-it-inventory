@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IT Equipments</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!--Replace with your tailwind.css once created-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />

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
                        IT Equipments
                    </h2>
                </div>
                <!--Card-->
                <div id='recipients' class="p-8 lg:mt-0 rounded shadow bg-white">
                    <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead class="">
                            <tr>
                                <th data-priority="1">Inventory Code</th>
                                <th data-priority="2">Item Category</th>
                                <th data-priority="3">Quantity</th>
                                <th data-priority="4">Stock Req.</th>
                                <th data-priority="5">Stock Actual</th>
                                <th data-priority="6">Date Added</th>
                                <th data-priority="7">Last Date Modified</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTableBody">
                            @foreach ($categories as $item)
                            @if ($item->deleted == "false")
                            @php
                            $stock_actual1 = DB::table('t_inventory')
                            ->where('category_id', $item->category_id)
                            ->where('item_status', "Stock")
                            ->where('deleted', "false")
                            ->count();

                            $stock_actual2 = DB::table('t_inventory')
                            ->where('category_id', $item->category_id)
                            ->where('item_status', "Spare")
                            ->where('deleted', "false")
                            ->count();

                            $stock_actual = $stock_actual1 + $stock_actual2;
                            if ($stock_actual == $item->stock_req) {
                            $statusClass = 'text-yellow-500 font-bold';
                            } else if ($stock_actual >= $item->stock_req) {
                                $statusClass = 'text-green-500 font-bold';
                                }
                            else if ($stock_actual <= $item->stock_req) {
                                $statusClass = 'text-red-500 font-bold';
                                }

                                @endphp
                                <tr onclick="redirectToBrand('{{ $item->category_id }}')" class="text-center">
                                    <td class="text-center">{{ $item->inventory_id }}</td>
                                    <td class="text-center">{{ $item->category_name }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-center">{{ $item->stock_req }}</td>
                                    <td class='{{$statusClass}}'>{{ $stock_actual }}</td>
                                    <td class="text-center">{{ $item->date_created }}</td>
                                    <td>{{ $item->date_change }}</td>
                                </tr>
                                @endif
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
                    var table = $('#example').DataTable({
                        responsive: true,
                        order: [
                        [2, 'desc']
                    ],
                        
                    }).columns.adjust().responsive.recalc();
                });
            </script>
        </div>
    </div>
    <script>
        function redirectToBrand(categoryId) {
            // Construct the URL based on the category ID
            var url = "/check-brand/" + categoryId;

            // Redirect to the URL
            window.open(url, '_blank');
        }
    </script>
    <script>
        $(document).ready(function() {
            // Function to show/hide rows based on the selected status
            function filterInventoryTable(statusClass) {
                $('#example tbody tr').hide(); // Hide all rows initially
                if (statusClass === 'all') {
                    $('#example tbody tr').show(); // Show all rows for "All" option
                } else {
                    $(`.${statusClass}`).show(); // Show rows with the selected status class
                }
            }

            // Initialize filtering with "All" status selected
            filterInventoryTable('all');

            // Handle status option clicks
            $('#allStatus').click(function() {
                filterInventoryTable('all');
            });

            $('#spareStatus').click(function() {
                filterInventoryTable('bg-green-500'); // Adjust the class as needed
            });

            $('#deployedStatus').click(function() {
                filterInventoryTable('bg-blue-500'); // Adjust the class as needed
            });

            $('#borrowedStatus').click(function() {
                filterInventoryTable('bg-orange-500'); // Adjust the class as needed
            });
        });
    </script>

    <!-- Tailwind Elements Script -->
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>


</html>