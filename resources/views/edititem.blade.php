<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Item</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!--Replace with your tailwind.css once created-->
    <!-- Tailwind Elements CSS-->
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


    th {
        text-align: left;
        /* Align header text to the left */
    }

    td {
        text-align: left;
        /* Align cell text to the left */
    }
</style>

<body class="bg-gray-100 py-2">

    @include('components.sidebar')

    <div class="ml-auto px-2 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
        <div class="my-auto flex justify-start">
            <!--Container-->
            <div class="w-full">
                <!--Card-->
                <form id="update-item-form" class="relative rounded-md bg-white" method="post">
                    @csrf
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <h2 class="text-2xl font-bold text-ntccolor border-b">
                            Edit Item : {{ $specs->model}}-{{$specs->serial_num}}
                        </h2>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="inventory-id" class="block mb-2 text-sm font-medium text-gray-900">Item
                                    Code</label>
                                <input type="text" name="inventory-id" id="inventory-id" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="{{ $dataitem->item_id }}" disabled>
                                <input name="id" value="{{$dataitem->item_id}}" hidden>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-brand" class="block mb-2 text-sm font-medium text-gray-900">Brand</label>
                                <select data-te-select-init data-te-select-filter="true" name="item-brand" id="category" class="shadow-sm  bg-custom-color block w-full p-2.5 editable-input">
                                    @foreach ($brands as $brand)
                                    @if ($brand->deleted == "false")
                                    <option value="{{ $brand->brand_id }}" {{ $dataitem->brand_id == $brand->brand_id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                    @endif
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-dateE" class="block mb-2 text-sm font-medium text-gray-900">Date
                                    Acquired</label>
                                <input type="date" value="{{ $specs->date_acquired}}" name="item-acquired" id="item-acquired" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="4CE0460D0G" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-dateE" class="block mb-2 text-sm font-medium text-gray-900">Date
                                    Expiration (Optional)</label>
                                <input type="date" value="{{ $specs->date_end}}" name="item-expired" id="item-expired" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="4CE0460D0G">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-model" class="block mb-2 text-sm font-medium text-gray-900">Model</label>
                                <input type="text" name="item-model" id="item-model" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" value="{{ $specs->model }}" placeholder="X250" required="">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">Serial
                                    Number: (Optional)</label>
                                <input type="text" name="item-serial" id="item-serial" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" value="{{ $specs->serial_num }}" placeholder="4CE0460D0G">
                            </div>



                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-price" class="block mb-2 text-sm font-medium text-gray-900 ">Price:</label>
                                <input type="Number" name="item-price" id="item-price" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" value="{{ $specs->price }}" placeholder="₱00,000 (Optional)">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                                <select data-te-select-init data-te-select-filter="true" name="item-category" id="categorySelector" class="shadow-sm bg-custom-color block w-full p-2.5 editable-input">
                                    <option selected hidden>Select your option</option>
                                    @foreach ($categories as $category)
                                    @if ($category->deleted == "false")
                                    <option data-specs="{{ $category->specs }}" value="{{ $category->category_id }}" {{ $dataitem->category_id == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-span-6 sm:col-span-3">
                                <label for="supplier-name" class="block mb-2 text-sm font-medium text-gray-900">Supplier</label>
                                <select data-te-select-init data-te-select-filter="true" name="supplier-name" id="supplier-name" class="shadow-sm w-full p-2.5  editable-input">
                                    @foreach ($suppliers as $supplier)
                                    @if ($supplier->deleted == "false")
                                    <option value="{{ $supplier->supplier_id }}" {{ $dataitem->supplier_id == $supplier->supplier_id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            @unless ($dataitem->item_status == "Borrowed" || $dataitem->item_status == "Deployed")
                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-status" class="block mb-2 text-sm font-medium text-gray-900">Status:</label>
                                <select data-te-select-init data-te-select="true" name="item-status" id="item-status" class="shadow-sm w-full p-2.5 editable-input">
                                    <option value="Stock" {{ $dataitem->item_status == "Stock" ? 'selected' : '' }}>Stock</option>
                                    <option value="Spare" {{ $dataitem->item_status == "Spare" ? 'selected' : '' }}>Spare</option>
                                    <option value="Missing" {{ $dataitem->item_status == "Missing" ? 'selected' : '' }}>Missing</option>
                                    <option value="Defective" {{ $dataitem->item_status == "Defective" ? 'selected' : '' }}>Defective</option>
                                </select>
                            </div>
                            @endunless


                            <div class="col-span-6 sm:col-span-3">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 ">Remarks:</label>
                                <textarea class="px-2 py-3 border w-full h-15 rounded-md" name="remarks"></textarea>
                            </div>



                            <div class="mt-3 col-span-6 sm:col-span-6 text-medium text-center font-medium border-dashed border-t-2 border-gray-300 pt-4" id="spacer" hidden>
                                Item Specification </div>

                            <div class="col-span-6 sm:col-span-3" id="cpuInput" hidden>
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">CPU</label>
                                <input type="text" value="{{ $specs->cpu}}" name="item-cpu" id="item-serial-cpu" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="I7 - 12300">
                            </div>


                            <div class="col-span-6 sm:col-span-3" id="gpuInput" hidden>
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">GPU</label>
                                <input type="text" value="{{ $specs->gpu}}" name="item-gpu" id="item-serial-gpu" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="GTX 3050">
                            </div>

                            <div class="col-span-6 sm:col-span-3" id="ramInput" hidden>
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">RAM</label>
                                <input type="text" value="{{ $specs->ram}}" name="item-ram" id="item-serial-ram" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="8x2 16GB DDR4">
                            </div>

                            <div class="col-span-6 sm:col-span-3" id="storageInput" hidden>
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">STORAGE</label>
                                <input type="text" value="{{ $specs->storage}}" name="item-storage" id="item-serial-storage" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="128GB SSD, 1TB HDD">
                            </div>





                        </div>


                        <div class=" w-full">

                        </div>
                        <!-- Modal footer -->
                        <div class="flex space-x-2 border-t border-gray-200 rounded-b">
                            <div class=" w-full flex justify-end pt-4">
                                <button onclick="removeItemWithAjax('{{ $dataitem->item_id }}')" class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-full px-5 h-10 mt-3 mb-3 text-sm text-center mr-2">Delete</button>
                                <button type="submit" class="text-white bg-ntccolor hover:bg-teal-600 font-medium rounded-full px-5 h-10 mt-3 mb-3 text-sm text-center">Update</button>
                            </div>
                        </div>
                </form>

            </div>
            <!--/container-->

            <!-- jQuery -->
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

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
                function removeItemWithAjax(item_id) {
                    // Ask the user for confirmation
                    var confirmation = confirm("Are you sure you want to remove this item?");

                    if (confirmation) {
                        // If the user confirms, proceed with item removal

                        // Construct the URL based on the item ID
                        var url = "/remove-item/" + item_id;

                        // Create a fetch request
                        fetch(url, {
                                method: "get", // or "GET" depending on your server-side logic
                            })
                            .then(function(response) {
                                if (response.ok) {
                                    // Handle success (e.g., show a success message)
                                    alert("Item removed successfully!");
                                    // You can also reload the page or update the UI as needed
                                    window.location.href = "/updated-inventory";
                                } else {
                                    // Handle errors (e.g., show an error message)
                                    alert("Error removing item!");
                                }
                            })
                            .catch(function(error) {
                                // Handle network or other errors
                                console.error("Request failed:", error);
                            });
                    } else {
                        // If the user cancels, do nothing
                        alert("Item removal canceled.");
                    }
                }
            </script>

            <script>
                $(document).ready(function() {
                    $('#update-item-form').submit(function(e) {
                        e.preventDefault(); // Prevent the default form submission

                        // Serialize the form data
                        var formData = $(this).serialize();

                        // Send an AJAX POST request to the server
                        $.ajax({
                            type: 'POST',
                            url: '/update-item',
                            data: formData,
                            success: function(response) {
                                // Handle the response from the server (e.g., show a success message)
                                if (response.success) {
                                    alert('Item updated successfully.');
                                    location.reload();
                                } else {
                                    alert('Item update failed.');
                                }
                            },
                            error: function() {
                                alert('An error occurred while updating the item.');
                            }
                        });
                    });
                });
            </script>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const categorySelect = document.getElementById('categorySelector');
                    const cpuInput = document.getElementById('cpuInput');
                    const gpuInput = document.getElementById('gpuInput');
                    const ramInput = document.getElementById('ramInput');
                    const storageInput = document.getElementById('storageInput');
                    const spacer = document.getElementById('spacer');

                    // Function to check the selected option periodically
                    function checkSelectedOption() {
                        const selectedOption = categorySelect.options[categorySelect.selectedIndex];
                        const specsValue = selectedOption.getAttribute('data-specs');

                        // Show or hide input fields based on specs value
                        if (specsValue === '1') {
                            cpuInput.style.display = 'block';
                            gpuInput.style.display = 'block';
                            ramInput.style.display = 'block';
                            storageInput.style.display = 'block';
                            spacer.style.display = 'block';
                        } else {
                            cpuInput.style.display = 'none';
                            gpuInput.style.display = 'none';
                            ramInput.style.display = 'none';
                            storageInput.style.display = 'none';
                            spacer.style.display = 'none';
                        }
                    }

                    // Call the function initially
                    checkSelectedOption();

                    // Check for changes every 2 seconds (adjust the interval as needed)
                    const interval = setInterval(checkSelectedOption, 2000);

                    // Stop checking when the page is unloaded (optional)
                    window.addEventListener('unload', function() {
                        clearInterval(interval);
                    });

                    categorySelect.addEventListener('change', checkSelectedOption);
                });
            </script>
            <!-- Tailwind Elements Script -->
            <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
        </div>
    </div>
</body>


</html>