<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Custodian Form</title>

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->
</head>

<style>
    /* select 2 css */

    .form-control:focus {
        border: 1px solid #34495e;
    }

    .select2.select2-container {
        width: 100% !important;
    }

    .select2.select2-container .select2-selection {
        border: 1px solid #ccc;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        height: 34px;
        margin-bottom: 15px;
        outline: none !important;
        transition: all .15s ease-in-out;
    }

    .select2.select2-container .select2-selection .select2-selection__rendered {
        color: #333;
        line-height: 32px;
        padding-right: 33px;
    }

    .select2.select2-container .select2-selection .select2-selection__arrow {
        background: #f8f8f8;
        border-left: 1px solid #ccc;
        -webkit-border-radius: 0 3px 3px 0;
        -moz-border-radius: 0 3px 3px 0;
        border-radius: 0 3px 3px 0;
        height: 32px;
        width: 33px;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
        background: #f8f8f8;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
        -webkit-border-radius: 0 3px 0 0;
        -moz-border-radius: 0 3px 0 0;
        border-radius: 0 3px 0 0;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
        border: 1px solid #34495e;
    }

    .select2.select2-container .select2-selection--multiple {
        height: auto;
        min-height: 34px;
    }

    .select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
        margin-top: 0;
        height: 32px;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__rendered {
        display: block;
        padding: 0 4px;
        line-height: 29px;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__choice {
        background-color: #f8f8f8;
        border: 1px solid #ccc;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        margin: 4px 4px 0 0;
        padding: 0 6px 0 22px;
        height: 24px;
        line-height: 24px;
        font-size: 12px;
        position: relative;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
        position: absolute;
        top: 0;
        left: 0;
        height: 22px;
        width: 22px;
        margin: 0;
        text-align: center;
        color: #e74c3c;
        font-weight: bold;
        font-size: 16px;
    }

    .select2-container .select2-dropdown {
        background: transparent;
        border: none;
        margin-top: -5px;
    }

    .select2-container .select2-dropdown .select2-search {
        padding: 0;
    }

    .select2-container .select2-dropdown .select2-search input {
        outline: none !important;
        border: 1px solid #34495e !important;
        border-bottom: none !important;
        padding: 4px 6px !important;
    }

    .select2-container .select2-dropdown .select2-results {
        padding: 0;
    }

    .select2-container .select2-dropdown .select2-results ul {
        background: #fff;
        border: 1px solid #34495e;
    }

    .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
        background-color: #3498db;
    }
</style>

<body class="bg-gray-100 py-2">

    @include('components.sidebar')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="ml-auto px-2 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
        <div class="my-auto flex justify-start">
            <!--Container-->
            <div class="w-full">

                <div class="p-8 my-2 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
                    <h2 class="text-2xl font-bold text-ntccolor">
                        Custodian Form
                    </h2>

                    <div>
                        <button id="open-modal-button" class="text-white bg-teal-500 hover:bg-teal-600 font-medium rounded-xl text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">

                            <span>Create Form</span>
                        </button>

                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-teal-500 hover:bg-teal-600 font-medium rounded-xl text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">Custodian Type <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg></button>
                       
                    </div>
                </div>
                <!--Card-->
                <div id='recipients' class="p-8 lg:mt-0 rounded shadow bg-white">
                    <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>

                            <tr>
                                <th class="text-center" data-priority="1">Custodian ID</th>
                                <th class="text-center" data-priority="2">Current Holder</th>
                                <th class="text-center" data-priority="3">Custodian Type</th>
                                <th class="text-center" data-priority="4">Purpose</th>
                                <th class="text-center" data-priority="5">Date Created</th>
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
                                <td>{{ $item->start_date}}</td>
                                <td class="text-center items-center flex justify-center">
                                    <button onclick="openModal2('{{ $item->custodian_id}}')" class=" text-green-500 border border-green-500 hover:bg-green-500 hover:text-white font-medium rounded-full text-sm p-1 mr-1 text-center inline-flex items-center cursor-pointer">
                                        <svg fill="ntccolor" viewBox="-9.6 -9.6 51.20 51.20" version="1.1" width="24px" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <title>return</title>
                                                <path fill="currentColor" d="M0 21.984q0.032-0.8 0.608-1.376l4-4q0.448-0.48 1.056-0.576t1.12 0.128 0.864 0.736 0.352 1.12v1.984h18.016q0.8 0 1.408-0.576t0.576-1.408v-8q0-0.832-0.576-1.408t-1.408-0.608h-16q-0.736 0-1.248-0.416t-0.64-0.992 0-1.152 0.64-1.024 1.248-0.416h16q2.464 0 4.224 1.76t1.76 4.256v8q0 2.496-1.76 4.224t-4.224 1.76h-18.016v2.016q0 0.64-0.352 1.152t-0.896 0.704-1.12 0.096-1.024-0.544l-4-4q-0.64-0.608-0.608-1.44z">
                                                </path>
                                            </g>
                                        </svg>
                                    </button>
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


            <div class="main-modal fixed w-full h-150px inset-0 z-50 flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
                <div class="modal-container bg-white w-1/2 h-4/6  relative rounded-xl z-50">
                    <div class="modal-content py-4 text-left px-6 ">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-xl font-semibold" name="title" id="title">Custodian Form</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" id="exitButton" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <!--Body-->
                        <div class="flex justify-center max-h-96 overflow-y-auto mt-2">
                            <div class="rounded-lg w-full">
                                <form id="create-form" method="post" class="relative bg-white">
                                    @csrf
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="custodian-name" class="block mb-2 text-sm font-medium text-gray-900">Employee</label>
                                                <select data-te-select-init data-te-select-filter="true" name="handlerName" id="handlerName" class="shadow-sm bg-custom-color block w-full p-2.5  editable-input" required="">
                                                    <option value="none" selected hidden>Select your option</option>
                                                    @foreach ($employees as $employee)
                                                    @if ($employee->deleted == "false")
                                                    <option value="{{ $employee->employee_id }}">{{ $employee->name }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="custodian-name" class="block mb-2 text-sm font-medium text-gray-900">Custodian
                                                    Type</label>
                                                <select data-te-select-init data-te-select-filter="true" name="type" id="type" class="shadow-sm bg-custom-color block w-full p-2.5  editable-input" required="">
                                                    <option value="none" selected hidden>Select your option</option>
                                                    <option value="Borrow">Borrow</option>
                                                    <option value="Deploy   ">Deploy</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="">
                                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 ">Purpose:</label>
                                            <textarea class="px-2 py-3 border w-full h-14 rounded-md" name="remarks"></textarea>
                                        </div>
                                        <div class="mt-3 col-span-6 sm:col-span-6 text-medium text-center font-medium border-dashed border-b-2 border-t-2 border-gray-300 py-2">
                                            Items</div>
                                        <div id="container12">
                                            <select name="item1" id="item1" class="js-example-basic-single" required="">
                                                <option value="none" selected hidden>Select Item</option>
                                                @foreach ($details as $item)
                                                @if ($item->deleted == "false" && $item->item_status == "Spare" ||
                                                $item->item_status == "Stock")
                                                <option value="{{ $item->item_id }}"> {{ $item->serial_num }} -
                                                    {{ $item->item_id }} - {{ $item->name }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <input type="text" name="itemArray" id="itemArray" hidden>
                                        </div>

                                        <div class="flex justify-end items-center">
                                            <a class="w-6" href="#" id="appendButton">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="28">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M12 6C12.5523 6 13 6.44772 13 7V11H17C17.5523 11 18 11.4477 18 12C18 12.5523 17.5523 13 17 13H13V17C13 17.5523 12.5523 18 12 18C11.4477 18 11 17.5523 11 17V13H7C6.44772 13 6 12.5523 6 12C6 11.4477 6.44772 11 7 11H11V7C11 6.44772 11.4477 6 12 6Z" fill="#4FACB6"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 4.5C2 3.11929 3.11929 2 4.5 2H19.5C20.8807 2 22 3.11929 22 4.5V19.5C22 20.8807 20.8807 22 19.5 22H4.5C3.11929 22 2 20.8807 2 19.5V4.5ZM4.5 4C4.22386 4 4 4.22386 4 4.5V19.5C4 19.7761 4.22386 20 4.5 20H19.5C19.7761 20 20 19.7761 20 19.5V4.5C20 4.22386 19.7761 4 19.5 4H4.5Z" fill="#4FACB6"></path>
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>


                                    <div class="mt-3 col-span-6 sm:col-span-6 text-medium text-center font-medium border-dashed border-b-2 border-t-2 border-gray-300 py-2">
                                        Persons Involved </div>

                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3 mt-3" bind>
                                            <label for="item1" class="block mb-2 text-sm font-normal text-gray-900">Issued
                                                By:</label>
                                            <select data-te-select-init data-te-select-filter="true" name="issued" id="issued" class="shadow-sm w-full p-2.5 editable-input" required>
                                                <option value="none" selected hidden>Select your option</option>
                                                @foreach ($employees as $employee)
                                                @if ($employee->deleted == "false")
                                                <option value="{{ $employee->employee_id }}">{{ $employee->name }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 mt-3" bind>
                                            <label for="item1" class="block mb-2 text-sm font-normal text-gray-900">Noted
                                                By:</label>
                                            <select data-te-select-init data-te-select-filter="true" name="noted" id="noted" class="shadow-sm w-full p-2.5 editable-input" required>
                                                <option value="none" selected hidden>Select your option</option>
                                                @foreach ($employees as $employee)
                                                @if ($employee->deleted == "false")
                                                <option value="{{ $employee->employee_id }}">{{ $employee->name }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->

                                    <div class="w-full justify-end flex space-x-2 border-gray-200 rounded-b">
                                        <button type="submit" class="mt-4 mr-2 w-32 text-white bg-ntccolor  hover:bg-teal-600  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center" id="/update-item">Create Form</button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="main2-modal fixed w-full h-150px inset-0 z-50 flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
                <div class="modal-container bg-white w-1/2 h-4/6  relative rounded-xl z-50">
                    <div class="modal-content py-4 text-left px-6 ">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-xl font-semibold" name="title" id="title">Custodian Form</p>
                            <div class="modal2-close cursor-pointer z-50">
                                <svg class="fill-current text-black" id="exitButton" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>


                        <!--Body-->
                        <div class="flex justify-center h-96 max-h-96 overflow-y-auto mt-2">
                            <div class="rounded-lg w-full">
                                <form id="create-form" method="post" class="relative bg-white">
                                    @csrf
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">
                                        <div class="grid grid-cols-6">

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="custodian-name" class="block text-sm font-medium text-gray-900">Items:</label>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="custodian-name" class="block text-sm font-medium text-gray-900">Status:</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="parentElement">

                                    </div>
                            </div>
                            </form>
                        </div>

                        <div class="w-full justify-end flex space-x-2 border-gray-200 rounded-b">
                            <button type="button" id="buttonReturn" class=" mr-2 w-32 text-white bg-ntccolor hover:bg-teal-600  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                // Initialize a counter to generate unique IDs
                var divCount = 1;

                // When the "Add Input" button is clicked
                $("#add-input-button").click(function() {
                    // Clone the entire div with id="input-container"
                    var clonedDiv = $("#input-container").clone();

                    // Generate unique IDs for the cloned elements
                    clonedDiv.find('label[for^="item"]').each(function() {
                        var originalFor = $(this).attr('for');
                        var newFor = originalFor + '-' + divCount;
                        $(this).attr('for', newFor);
                    });

                    clonedDiv.find('select[name^="supplier-name"]').each(function() {
                        var originalName = $(this).attr('name');
                        var newName = originalName + '-' + divCount;
                        $(this).attr('name', newName);

                        var originalId = $(this).attr('id');
                        var newId = originalId + '-' + divCount;
                        $(this).attr('id', newId);
                    });

                    // Increment the counter
                    divCount++;

                    // Append the cloned div below the original one
                    $("#input-container").after(clonedDiv);
                });

            });
        </script>






        <!-- Tailwind Elements Script -->
        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <!--Datatables -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let counter = 1;

                function addSelectInput() {
                    counter++;
                    console.log(counter);
                    const container = document.getElementById('container12');

                    const div = document.createElement('div');

                    // Create a new select element
                    const selectClone = document.createElement('select');
                    selectClone.name = `item${counter}`;
                    selectClone.id = `item${counter}`;
                    selectClone.classList.add('js-example-basic-single');

                    // Clone and add the options from the original select
                    const originalSelect = document.getElementById('item1');
                    for (const originalOption of originalSelect.options) {
                        const cloneOption = document.createElement('option');
                        cloneOption.value = originalOption.value;
                        cloneOption.text = originalOption.text;
                        selectClone.appendChild(cloneOption);
                    }

                    // Append the newly created select element to the div
                    div.appendChild(selectClone);

                    // Append the div to the container
                    container.appendChild(div);

                    // Initialize Select2 on the newly created select element
                    $(selectClone).select2();
                }

                // Add an event listener to the button element with the ID "appendButton"
                document.getElementById('appendButton').addEventListener('click', addSelectInput);

                // Add an event listener to the form to collect select values when the form is submitted
                const form = document.getElementById(
                    'create-form'); // Replace 'yourFormId' with the actual form ID
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent the form from actually submitting

                    // Collect and process the select values here
                    const selectValues = [];
                    for (let i = 1; i <= counter; i++) {
                        const selectId = `item${i}`;
                        const selectElement = document.getElementById(selectId);
                        if (selectElement) {
                            selectValues.push(selectElement.value);
                        }
                    }
                    console.log(selectValues);
                    // Set the value of the hidden input field "itemArray" to the collected values
                    const itemArrayInput = document.getElementById('itemArray');
                    itemArrayInput.value = JSON.stringify(selectValues); // Convert to JSON if needed
                });
            });
        </script>
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
                }, 1); // Adjust the delay as needed
            };

            const openModal = () => {
                modal.classList.remove('fadeOut');
                modal.classList.add('fadeIn');
                modal.style.display = 'flex';
            };

            for (let i = 0; i < closeButton.length; i++) {
                const element = closeButton[i];
                element.onclick = (e) => modalClose();
            }

            // Get the button element by its ID
            const openModalButton = document.getElementById('open-modal-button');
            if (openModalButton) {
                openModalButton.addEventListener('click', () => openModal());
            }

            // Initially hide the modal
            modal.style.display = 'none';

            window.onclick = function(event) {
                if (event.target == modal) modalClose();
            };
        </script>

        <!-- Add this code for the second modal -->
        <script>
            const modal2 = document.querySelector('.main2-modal');
            const closeButton2 = document.querySelectorAll('.modal2-close');

            const modalClose2 = () => {
                modal2.classList.remove('fadeIn');
                modal2.classList.add('fadeOut');
                $('#parentElement').empty();
                setTimeout(() => {
                    modal2.style.display = 'none';
                }, 1); // Adjust the delay as needed
            };

            const openModal2 = (custodianID) => {
                modal2.classList.remove('fadeOut');
                modal2.classList.add('fadeIn');
                modal2.style.display = 'flex';
                console.log(custodianID);

                $.ajax({
                    type: 'GET',
                    url: `/CustodianInfo2/${custodianID}`,
                    success: function(response) {
                        index = 1;
                        var sampleArray = [];
                        var currentStatus;
                        response.forEach(function(element) {
                            console.log(element);
                            // Create a container div for the element
                            var container = $(
                                '<div class="grid grid-cols-6 flex-row items-center"></div>');
                            // Create the first input field
                            var inputField = $(
                                '<div class="col-span-6 sm:col-span-3 pr-2" hidden>' +
                                '<input type="text"" name="itemDetail' + index + '" value ="' +
                                element.item_id + '" id="itemDetail' + index +
                                '" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-1.5">' +
                                '</div>'
                            );

                            var textfieldField = $(
                                '<div class="col-span-6 sm:col-span-3 pr-2">' +
                                '<p class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-1.5">' +
                                element.item_id + " - " + element.name + '</p>' +
                                '</div>'
                            );

                            var selectField;

                            // Create the second select field
                            if (element.custodian_id == element.current_custodianID && element
                                .item_status == element.item_currentStatus) {
                                selectField = $(
                                    '<div class="col-span-6 sm:col-span-3 pr-2 space-y-2">' +
                                    '<button type="button" class="mr-2 w-24 text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm py-1.5 text-center" ' +
                                    'onclick="toUpdate(\'' + element.item_id +
                                    '\', \'Spare\')" id="/update-item">Returned</button>' +
                                    '<button type="button" class="mr-2 w-24 text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm py-1.5 text-center" ' +
                                    'onclick="toUpdate(\'' + element.item_id +
                                    '\', \'Missing\')" id="/update-item">Missing</button>' +
                                    '<button type="button" class="mr-2 w-24 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm py-1.5 text-center" ' +
                                    'onclick="toUpdate(\'' + element.item_id +
                                    '\', \'Defective\')" id="/update-item">Defect</button>' +
                                    '</div>'
                                );
                                sampleArray.push(element.item_status);
                                currentStatus = element.item_currentStatus;
                            } else {
                                selectField = $(
                                    '<div class="col-span-6 sm:col-span-3 pr-2 space-y-2">' +
                                    '<button type="button" class="mr-2 w-24 text-white bg-gray-300 rounded-full text-sm py-1.5 text-center" ' +
                                    'disabled>Returned</button>' +
                                    '<button type="button" class="mr-2 w-24 text-white bg-gray-300 rounded-full text-sm py-1.5 text-center" ' +
                                    'disabled>Missing</button>' +
                                    '<button type-="button" class="mr-2 w-24 text-white bg-gray-300 rounded-full text-sm py-1.5 text-center" ' +
                                    'disabled>Defect</button>' +
                                    '</div>'
                                );
                            }

                            // Append the input and select fields to the container
                            container.append(inputField, textfieldField, selectField);

                            // Append the container to your desired parent element (e.g., a form or a div)
                            $('#parentElement').append(container);
                            $('#buttonReturn').attr('custodian-id', element.current_custodianID);

                            index++; // Increment the index for unique IDs
                        });

                        if (sampleArray.includes(currentStatus)) {
                            console.log(`'${currentStatus}' is in the array.`);
                            $('#buttonReturn')
                                .attr('type', 'button')
                                .addClass(
                                    'mr-2 w-24 text-white bg-gray-300 rounded-full text-sm py-1.5 text-center'
                                )
                                .css('color', 'grey')
                                .prop('disabled', true)
                                .removeClass('hover:bg-teal-600');
                        } else {
                            console.log(`'${currentStatus}' is not in the array.`);

                        }

                    },
                    error: function(error) {
                        // Handle error
                        console.error(error);
                    }
                });
            };

            for (let i = 0; i < closeButton2.length; i++) {
                const element = closeButton2[i];
                element.onclick = (e) => modalClose2();
            }

            // Initially hide the second modal
            modal2.style.display = 'none';

            window.onclick = function(event) {
                if (event.target == modal2) modalClose2();
            };
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
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('create-form');
            const loadingOverlay = createLoadingOverlay();

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Show the loading overlay
                document.body.appendChild(loadingOverlay);

                // Serialize form data
                const formData = new FormData(form);
                fetch('/insert-custodian', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            // Handle errors (e.g., show error message)
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
                    .finally(() => {
                        // Hide the loading overlay after the request is complete
                        document.body.removeChild(loadingOverlay);
                    });
            });
        });

        // Function to create a loading overlay with a spinner
        function createLoadingOverlay() {
            const overlay = document.createElement('div');
            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(255, 255, 255, 0.8)'; // White background
            overlay.style.zIndex = '9999';

            const loadingDiv = document.createElement('div');
            loadingDiv.style.position = 'fixed';
            loadingDiv.style.top = '50%';
            loadingDiv.style.left = '50%';
            loadingDiv.style.transform = 'translate(-50%, -50%)';
            loadingDiv.style.zIndex = '10000';

            const spinner = document.createElement('div');
            spinner.className = 'spinner'; // Add a CSS class for the spinner
            spinner.style.border = '4px solid #f3f3f3'; /* Light gray */
            spinner.style.borderTop = '4px solid #3498db'; /* Blue */
            spinner.style.borderRadius = '50%';
            spinner.style.width = '40px';
            spinner.style.height = '40px';
            spinner.style.animation = 'spin 2s linear infinite'; // Add CSS animation for spinning

            loadingDiv.appendChild(spinner);
            overlay.appendChild(loadingDiv);

            return overlay;
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
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
    <script>
        function toUpdate(itemID, status) {

            console.log(itemID);
            console.log(status);
            const confirmation = confirm(
                `Are you sure you want to update this custodian form?\n\nClick "OK" to confirm or "Cancel" to cancel.`
            );

            if (confirmation) {
                fetch(`/UpdateCustodianForm/${itemID}/${status}`, {
                        method: 'GET', // Change to 'POST' if necessary
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            // Handle success (e.g., show a success message)
                            alert('item updated successfully.');
                            // You can also reload the page or update the UI as needed
                            location.reload();
                        } else {
                            // Handle errors (e.g., show an error message)
                            alert('Error: Unable to update item.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }
    </script>


    <script>
        // Get the button element by its ID
        var button = document.getElementById("buttonReturn");

        // Add a click event listener to the button
        button.addEventListener("click", async function() {
            var custodianId = button.getAttribute("custodian-id");
            console.log(custodianId);

            const confirmation = confirm(
                `Are you sure you want to end this custodian form?\n\nClick "OK" to confirm or "Cancel" to cancel.`
            );

            if (confirmation) {
                // Create a full-page loading overlay with a white background
                var overlay = document.createElement('div');
                overlay.style.position = 'fixed';
                overlay.style.top = '0';
                overlay.style.left = '0';
                overlay.style.width = '100%';
                overlay.style.height = '100%';
                overlay.style.backgroundColor = 'rgba(255, 255, 255, 0.8)'; // White background
                overlay.style.zIndex = '9999';

                // Create a loading message div with a spinning loading animation
                var loadingDiv = document.createElement('div');
                loadingDiv.style.position = 'fixed';
                loadingDiv.style.top = '50%';
                loadingDiv.style.left = '50%';
                loadingDiv.style.transform = 'translate(-50%, -50%)';
                loadingDiv.style.zIndex = '10000';

                // Add a spinning loading animation (e.g., a spinner icon)
                var spinner = document.createElement('div');
                spinner.className = 'spinner'; // Add a CSS class for the spinner
                spinner.style.border = '4px solid #f3f3f3'; /* Light gray */
                spinner.style.borderTop = '4px solid #3498db'; /* Blue */
                spinner.style.borderRadius = '50%';
                spinner.style.width = '40px';
                spinner.style.height = '40px';
                spinner.style.animation = 'spin 2s linear infinite'; // Add CSS animation for spinning
                loadingDiv.appendChild(spinner);

                overlay.appendChild(loadingDiv);
                document.body.appendChild(overlay);

                try {
                    const response = await fetch(`/markCustodianForm/${custodianId}`, {
                        method: 'GET', // Change to 'POST' if necessary
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                        },
                    });

                    if (response.ok) {
                        // Wait for the update and then show the success message
                        await new Promise(resolve => setTimeout(resolve, 1000)); // Adjust the delay time as needed
                        alert('Custodian updated successfully.');
                        // You can also reload the page or update the UI as needed
                        location.reload();
                    } else {
                        // Handle errors (e.g., show an error message)
                        alert('Error: Unable to update custodian.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                } finally {
                    // Remove the loading overlay
                    document.body.removeChild(overlay);
                }
            }
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>


</html>