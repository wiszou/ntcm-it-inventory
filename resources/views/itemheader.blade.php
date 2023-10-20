<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Item Header</title>

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


    th {
        text-align: center;
        /* Align header text to the left */
    }


    td {
        text-align: center;
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
                        Item Header
                    </h2>
                </div>

                <!--Card-->
                <div id='recipients' class="p-8 lg:mt-0 rounded shadow bg-white">
                    <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead class="">
                            <tr>
                                <th data-priority="1">Brand Code</th>
                                <th data-priority="2">Brand</th>
                                <th data-priority="3">Quantity</th>
                                <th data-priority="4">View Items</th>
                            </tr>
                        </thead>

                        <tbody id="inventoryTableBody">
                            @foreach ($brands as $item)
                            @if ($item->deleted == "false")
                            @php
                            $quantity = DB::table('t_inventory')
                            ->where('category_id', $category_id)
                            ->where('brand_id', $item->brand_id)
                            ->where('deleted', "false")
                            ->count();

                            @endphp
                            <tr class="text-center">
                                <td class="text-center">{{ $item->brand_id }}</td>
                                <td class="text-center">{{ $item->name }}</td>
                                <td class="text-center">{{ $quantity }}</td>
                                <td class="flex justify-center underline underline-offset-1 text-blue-500 hover:text-white">
                                    <label class=" text-ntccolor border border-ntccolor hover:bg-ntccolor hover:text-white font-medium rounded-full text-sm p-1 text-center inline-flex items-center cursor-pointer" onclick="openModal('{{ $item->brand_id }}', '{{ $category_id }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="eye" width="24" fill="currentColor">
                                            <path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z">
                                            </path>
                                        </svg>
                                    </label>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <!--/Card-->


            </div>
            <!--/container-->

            <div class="main-modal fixed w-full h-100  inset-0 z-50 flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
                <div class="modal-container bg-white w-3/6 rounded-xl z-50">
                    <div class="modal-content py-4 text-left px-6 max-h-screen overflow-y-auto">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-xl font-semibold text-gray-700 mb-2" name="title" id="title">Brand: Name</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" id="exitButton" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <!--Body-->
                        <div class="flex justify-center">
                            <div class="rounded-lg w-full">
                                <table id="modalTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                    <thead class="">
                                        <tr>
                                            <th data-priority="1">Item Code</th>
                                            <th data-priority="2">Model</th>
                                            <th data-priority="3">Serial Number</th>
                                            <th data-priority="4">Custodian ID</th>
                                            <th data-priority="5">Status</th>
                                            <th data-priority="5">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="modalTableBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <!-- jQuery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <!--Datatables -->
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

            <script>
                $(document).ready(function() {
                    var table = $('#example').DataTable({
                            responsive: true
                        })
                        .columns.adjust()
                        .responsive.recalc();
                });
            </script>

            <script>
                $(document).ready(function() {
                    var table = $('#modalTable').DataTable({
                            responsive: true,
                            pageLength: 6,
                            lengthMenu: [6]
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
                    }, 0); // Adjust the delay as needed
                };

                // Function to open the modal
                const openModal = (brand_id, category_id) => {
                    fetch(`/getItemDetails/${brand_id}/${category_id}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.items.length > 0) {
                                const modalTable = $('#modalTable').DataTable(); // Initialize DataTable
                                // Clear existing rows and redraw the table
                                modalTable.clear().draw();

                                // Process and add items to the DataTable
                                const itemRows = data.items.map(item => {
                                    const custodianId = item.custodian_id ? item.custodian_id : 'Empty';

                                    const itemModel = item.model; // Use item.model from getItemDetails
                                    const itemSerialNum = item.serial_num; // Use item.serial_num from getItemDetails

                                    return [
                                        item.item_id,
                                        itemModel,
                                        itemSerialNum,
                                        custodianId,
                                        item.item_status,
                                        `<button data-item-id="${item.item_id}" class="btn btn-primary rounded-3xl text-ntccolor border border-ntccolor hover:bg-ntccolor hover:text-white font-medium rounded-full text-sm p-1 text-center inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="edit" class="w-5" fill="currentcolor">
                                <path d="M5,18H9.24a1,1,0,0,0,.71-.29l6.92-6.93h0L19.71,8a1,1,0,0,0,0-1.42L15.47,2.29a1,1,0,0,0-1.42,0L11.23,5.12h0L4.29,12.05a1,1,0,0,0-.29.71V17A1,1,0,0,0,5,18ZM14.76,4.41l2.83,2.83L16.17,8.66,13.34,5.83ZM6,13.17l5.93-5.93,2.83,2.83L8.83,16H6ZM21,20H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"></path>
                            </svg>
                        </button>`,
                                    ];
                                });

                                // Add the item rows to the DataTable
                                modalTable.rows.add(itemRows).draw();

                                // Show the modal - no need to redefine 'modal' here
                                modal.classList.remove('fadeOut');
                                modal.classList.add('fadeIn');
                                modal.style.display = 'flex';
                            } else {
                                // Handle error if item details cannot be fetched or if the array is empty
                                console.error('Error fetching item details.');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching item details:', error);
                        });
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

            <script>
                $('#modalTable').on('click', 'button', function() {
                    const itemID = $(this).data('item-id'); // Get the item_id from the data attribute
                    redirectToEdit(itemID);
                });
            </script>
        </div>
    </div>

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