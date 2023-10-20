<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Archives</title>

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
                        Custodian Forms Archives
                    </h2>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-teal-500 hover:bg-teal-600 font-medium rounded-xl text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">Status <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-xl shadow w-44">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#" id="allStatus" class="block px-4 py-2 hover:bg-gray-100">All</a>
                            </li>
                            <li>
                                <a href="#" id="spareStatus" class="block px-4 py-2 hover:bg-gray-100 ">Spare</a>
                            </li>
                            <li>
                                <a href="#" id="deployedStatus" class="block px-4 py-2 hover:bg-gray-100">Deployed</a>
                            </li>
                            <li>
                                <a href="#" id="borrowedStatus" class="block px-4 py-2 hover:bg-gray-100">Borrowed</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!--Card-->
                <div id='recipients' class="p-8 lg:mt-0 rounded shadow bg-white">
                    <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead class="">
                            <tr>
                                <th class="text-center" data-priority="1">Custodian</th>
                                <th class="text-center" data-priority="2">Holder</th>
                                <th class="text-center" data-priority="3">Custodian Type</th>
                                <th class="text-center" data-priority="4">Purpose</th>
                                <th class="text-center" data-priority="5">Date Returned</th>
                                <th class="text-center" data-priority="6">Action</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTableBody">
                            @foreach ($custodian as $item)
                            @if ($item->deleted == "false")
                            <tr item-id="{{ $item->custodian_id }}">
                                <td class="text-center">{{ $item->custodian_id}}</td>
                                @foreach ($employees as $itemE)
                                @if ($itemE->employee_id == $item->name)
                                <td class="text-center">{{ $itemE->name }}</td>
                                @endif
                                @endforeach
                                <td class="text-center">{{ $item->type}}</td>
                                <td class="text-center">{{ $item->description}}</td>
                                <td>{{ $item->end_date}}</td>
                                <td class="text-center items-center flex justify-center">
                                    <label onclick="toPrint('{{ $item->custodian_id}}')" class=" text-blue-500 border border-blue-500 hover:bg-blue-500 hover:text-white font-medium rounded-full text-sm p-1 mr-1 text-center inline-flex items-center cursor-pointer">
                                        <svg viewBox="-2.64 -2.64 29.28 29.28" fill="ntccolor" width="24px" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M17 7H7V6h10v1zm0 12H7v-6h10v6zm2-12V3H5v4H1v8.996C1 17.103 1.897 18 3.004 18H5v3h14v-3h1.996A2.004 2.004 0 0 0 23 15.996V7h-4z" fill="#000000"></path>
                                            </g>
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
                <div class="modal-container bg-white w-2/6 rounded-xl z-50">
                    <div class="modal-content py-4 text-left px-6 max-h-screen overflow-y-auto">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-xl font-semibold" name="title" id="title"></p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" id="exitButton" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <!--Body-->
                        <div class="flex justify-center">
                            <div class="px-2 py-2 rounded-lg w-full ">
                                <h1 class="text-gray-900 text-3xl title-font font-medium mb-7">Custodian Name</h1>
                                <div class="flex border-t border-gray-200 py-2">
                                    <span class="text-gray-700">Item 1</span>
                                </div>
                                <div class="flex border-t border-gray-200 py-2">
                                    <span class="text-gray-700">Item 2</span>
                                </div>
                                <div class="flex border-t border-gray-200 py-2">
                                    <span class="text-gray-700">Item 3</span>
                                </div>
                                <div class="flex border-t border-gray-200 py-2">
                                    <span class="text-gray-700">Item 4</span>
                                </div>
                                <div class="flex border-t border-b border-gray-200 py-2">
                                    <span class="text-gray-700">Item 5</span>
                                </div>
                                <div class="flex mt-6 mb-2">

                                    <button class="ml-auto mr-4 rounded-lg w-16 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-700 hover:bg-gray-300">
                                        <span>View</span>
                                    </button>
                                    <button class="text-white bg-orange-400 border-0 py-2 px-6 focus:outline-none hover:bg-orange-600 rounded-lg">Returned</button>
                                </div>
                            </div>

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
            const modal = document.querySelector('.main-modal');
            const closeButton = document.querySelectorAll('.modal-close');
            const modalClose = () => {
                modal.classList.remove('fadeIn');
                modal.classList.add('fadeOut');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 0);
            }

            const openModal = () => {

                modal.classList.remove('fadeOut');
                modal.classList.add('fadeIn');
                modal.style.display = 'flex';

            }

            for (let i = 0; i < closeButton.length; i++) {
                const elements = closeButton[i];
                elements.onclick = (e) => modalClose();
                modal.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target == modal) modalClose();
            }

            document.getElementById('removeButton').addEventListener('click', function() {
                // Assuming you have a variable with the item ID you want to remove
                var itemId = this.value; // Replace with your actual item ID

                // Send a POST request to the 'remove' route
                axios.post('/remove-item/' + itemId)
                    .then(function(response) {
                        if (response.status === 200) {
                            // Handle success
                            console.log('Item removed successfully');
                        } else {
                            // Handle error
                            console.error('Error removing item');
                        }
                    })
                    .catch(function(error) {
                        // Handle network or other errors
                        console.error('Network error:', error);
                    });
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

    <script>
        const inputFields = document.querySelectorAll('.editable-input');
        const editButton = document.getElementById('editButton');
        const exitButton = document.getElementById('exitButton');
        const saveButton = document.getElementById('saveButton');
        saveButton.style.backgroundColor = 'grey';
        // Initialize the button text to "Edit"
        let isEditing = false;

        editButton.addEventListener('click', () => {
            inputFields.forEach(inputField => {
                inputField.disabled = isEditing;
            });

            // Change the text of the button based on the state
            if (isEditing) {
                editButton.textContent = 'Edit';
                saveButton.disabled = true; // Disable the "Save" button
                saveButton.style.backgroundColor = 'grey'; // Change the color to grey
            } else {
                editButton.textContent = 'Stop Editing';
                saveButton.disabled = false; // Enable the "Save" button
                saveButton.style.backgroundColor = ''; // Reset the color
            }

            // Toggle the editing state
            isEditing = !isEditing;
        });

        exitButton.addEventListener('click', () => {
            inputFields.forEach(inputField => {
                inputField.disabled = true; // Disable the input fields
            });
            editButton.textContent = 'Edit'; // Reset the "Edit" button text
            saveButton.disabled = true; // Disable the "Save" button
            saveButton.style.backgroundColor = 'grey'; // Change the color to grey
            isEditing = false; // Reset the editing state
        });
    </script>
    <script>
        function toPrint(custodianId) {
            var url = "{{ route('print', ['custodianID' => '__toPrint__']) }}";
            url = url.replace('__toPrint__', custodianId);

            // // Redirect to the URL
            // window.location.href = url;
            window.open(url, '_blank');
        }
    </script>

    <!-- Tailwind Elements Script -->
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>


</html>