<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>

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

<body class="bg-gray-100 py-2 h-screen">

    @include('components.sidebar')
    <div class="ml-auto px-2 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
        <div class="my-auto flex justify-start">
            <!--Container-->
            <div class="w-full">

                <div class="p-8 my-2 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
                    <h2 class="text-2xl font-bold text-ntccolor">
                        Dashboard
                    </h2>
                </div>
            </div>
        </div>

        <div class="flex flex-row h-3/5 mb-1 mt-1 mr-1">
            <!-- LEFT CONTAINER -->
            <div class="w-1/2 mb-1 mr-1 bg-white rounded-md py-3 px-5">
                <h1 class="mb-3 mt-1 text-lg font-bold text-gray-700 pt-1">Items near retirement:</h1>
                <div class="bg-ntccolor h-px mb-0"></div>
                <table id="retire" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead class="">
                        <tr>
                            <th data-priority="1">Item Code</th>
                            <th data-priority="2">Model</th>
                            <th data-priority="3">Retire Date</th>
                        </tr>
                    </thead>
                    <tbody id="suppliers">
                        @foreach ($details as $item)
                        @php
                        try {
                        $dateEnd = \Carbon\Carbon::createFromFormat('Y-m-d', $item->date_end, 'Asia/Manila');
                        // Rest of your code for date comparisons
                        } catch (Exception $e) {
                        // Handle the exception (e.g., log it, skip the current item, etc.)
                        }
                        @endphp

                        @if (isset($dateEnd))
                        <tr onclick="redirectToEdit('{{ $item->item_id }}')" class="cursor-pointer">
                            <td class="text-center">{{ $item->item_id }}</td>
                            <td class="text-center">{{ $item->model }}</td>
                            <td class="text-center">{{ $item->date_end }}</td>
                        </tr>
                        @endif
                        @php
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>


            <!-- End LEFT CONTAINER -->

            <!-- RIGHT CONTAINER -->
            <div class="w-1/2 mb-1 mr-1 ml-1 bg-white rounded-md py-3 px-5">
                <h1 class="mb-3 mt-1 text-lg font-bold text-gray-700 pt-1">Low Stocks:</h1>
                <div class="bg-ntccolor h-px mb-0"></div>
                <table id="lowstocks" class="stripe hover" style="width:100%;  padding-bottom: 1em;">
                    <thead class="">
                        <tr>
                            <th data-priority="1">Inventory Code</th>
                            <th data-priority="2">Item Category</th>
                            <th data-priority="3">Stock Required</th>
                            <th data-priority="4">Stock Actual</th>
                        </tr>
                    </thead>
                    <tbody id="suppliers">
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

                        $statusClass = 'text-red-500 font-bold'; // Default to red

                        if ($stock_actual == $item->stock_req) {
                        $statusClass = 'text-yellow-500 font-bold';
                        } else if ($stock_actual >= $item->stock_req) {
                        $statusClass = 'text-green-500 font-bold';
                        }
                        @endphp

                        @if ($stock_actual <= $item->stock_req)
                            <!-- Only display rows when stock_actual is less than or equal to stock_req -->
                            <tr class="text-center">
                                <td class="text-center">{{ $item->inventory_id }}</td>
                                <td class="text-center">{{ $item->category_name }}</td>
                                <td class="text-center">{{ $item->stock_req }}</td>
                                <td class='{{ $statusClass }}'>{{ $stock_actual }}</td>
                            </tr>
                            @endif
                            @endif
                            @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End RIGHT CONTAINER -->
        </div>

        <div class="flex flex-row h-3/4 mr-1 pb-1">
            <!-- Add Suppliers -->
            <div class="w-full px-4 pt-2 mb-2 mr-1 bg-white rounded-md">
                <h1 class="mb-3 mt-1 text-lg font-bold text-gray-700 pt-1">Recent Logs:</h1>
                <div class="bg-ntccolor h-px mb-0"></div>
                <table id="logs" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead class="">
                        <tr>
                            <th data-priority="1">Log ID</th>
                            <th data-priority="2">Description</th>
                            <th data-priority="3">User</th>
                            <th data-priority="4">Date</th>
                        </tr>
                    </thead>
                    <tbody id="suppliers">
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
            <!-- End Suppliers -->

        </div>


    </div>





    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    </div>
    <!-- Tailwind Elements Script -->
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    
    
    <script>
    $(document).ready(function() {
        var table = $('#retire').DataTable({
                responsive: true,
                pageLength: 5,
                lengthMenu: [5], // Restrict to one option for 5 rows per page
                bLengthChange: false, // Disable the page length menu
                order: [
                    [2, 'asc']
                ],
                searching: false
            })
            .columns.adjust()
            .responsive.recalc();
    });
    </script>

    <script>
    $(document).ready(function() {
        var table = $('#lowstocks').DataTable({
                responsive: true,
                pageLength: 5,
                lengthMenu: [5], // Restrict to one option for 5 rows per page
                bLengthChange: false, // Disable the page length menu
                order: [
                    [3, 'asc']
                ],
                searching: false
            })
            .columns.adjust()
            .responsive.recalc();
    });
    </script>

    <script>
    $(document).ready(function() {
        var table = $('#logs').DataTable({
                responsive: true,
                pageLength: 9, // Set the page length to 10
                lengthMenu: [9], // Restrict to one option for 10 rows per page
                bLengthChange: false, // Disable the page length menu
                order: [
                    [3, 'desc']
                ],
                searching: false,
                paging: false,
            })
            .columns.adjust()
            .responsive.recalc();
    });
    </script>
    <script>
    // Define the modal and closeButton variables
    const modal = document.querySelector('.main-modal');
    const closeButton = document.querySelectorAll('.modal-close');

    // Function to close the modal
    const modalClose = () => {
        modal.classList.remove('fadeIn');
        modal.classList.add('fadeOut');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 10); // Adjust the delay as needed
    };

    // Function to open the modal
    const openModal = () => {
        // Show the modal - no need to redefine 'modal' here
        modal.classList.remove('fadeOut');
        modal.classList.add('fadeIn');
        modal.style.display = 'flex';
    };

    // Attach click event listeners to close buttons
    for (let i = 0; i < closeButton.length; i++) {
        const element = closeButton[i];
        element.onclick = () => modalClose();
    }

    // Get the button element by its ID
    const openModalButton = document.getElementById('open-modal-button');
    if (openModalButton) {
        openModalButton.addEventListener('click', () => openModal());
    }

    // Initially hide the modal
    modal.style.display = 'none';

    // Click outside the modal to close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modalClose();
        }
    };
    </script>

    <script>
    function redirectToEdit(itemID) {

        // Generate the URL using Laravel's route helper with the 'itemID' parameter
        var url = "{{ route('editItem', ['itemID' => '__itemID__']) }}";

        // Replace the '__itemID__' placeholder in the URL with the actual 'itemID' value
        url = url.replace('__itemID__', itemID);

        // Redirect to the URL
        window.location.href = url;
    }
    </script>



</body>

</html>