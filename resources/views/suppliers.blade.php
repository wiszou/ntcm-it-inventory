<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suppliers</title>

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



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>


<body class="bg-gray-100 py-2">
    @include('components.sidebar')


    <div class="ml-auto px-2 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
        <div class="my-auto flex justify-start">
            <!--Container-->
            <div class="w-full">

                <div class="p-8 my-2 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
                    <h2 class="text-2xl font-bold text-ntccolor">
                        Suppliers
                    </h2>
                </div>
            </div>
        </div>

        <div class="flex flex-row">

            <!-- Add Suppliers -->
            <div class="w-full flex flex-wrap md:space-x-2 md:space-y-0 mb-2 mr-1">
                <form id="supplier-form" class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">
                    @csrf
                    <h2 class="text-gray-900 text-md font-semibold pb-1 px-3">Add Suppliers</h2>
                    <div class="my-1"></div>
                    <div class="bg-ntccolor h-px mb-6"></div>

                    <div class="grid grid-cols-6 gap-6 px-2">

                        <div class="col-span-6 sm:col-span-3 ">
                            <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 ">Supplier
                                Name:</label>
                            <input type="text" name="supplier-name" id="supplier-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" placeholder="Supplier Name" required>
                            <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js">
                            </script>

                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900">Contact
                                Number:</label>
                            <div class="flex flex-row">
                                <input type="telephone" name="contact" id="contact" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" placeholder="Contact Number" required>
                            </div>
                        </div>

                        <div class="col-span-6 sm:col-span-5 ">
                            <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 ">Address:</label>
                            <input type="text" name="address" id="address" class="shadow-sm mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" placeholder="Address">
                            <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js">
                            </script>
                        </div>


                        <div class="col-span-6 sm:col-span-1 flex items-center">
                            <button type="submit" class="text-white w-32 mt-3 bg-ntccolor hover:bg-teal-600 focus:ring-4 focus:outline-none font-medium rounded-full text-sm px-7 py-2 text-center">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- List of Suppliers -->
        <!--Card-->
        <div id='suppliers' class="p-8 lg:mt-0 rounded-lg shadow bg-white">
            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead class="">
                    <tr>
                        <th data-priority="1">Supplier Code</th>
                        <th data-priority="2">Supplier Name</th>
                        <th data-priority="3">Contact Number</th>
                        <th data-priority="2">Address</th>
                        <th data-priority="4">Action</th>
                    </tr>
                </thead>
                <tbody id="suppliers">
                    @foreach ($suppliers as $item)
                    @if ($item->deleted == "false")
                    <tr>
                        <td class="text-center">{{ $item->supplier_id }}</td>
                        <td class="text-center">{{ $item->name }}</td>
                        <td class="text-center">{{ $item->contact }}</td>
                        <td class="text-center">{{ $item->address }}</td>
                        <td class="text-center items-center flex justify-center">
                            <label onclick="openModal('{{ $item->supplier_id }}')" class=" text-ntccolor border border-ntccolor hover:bg-ntccolor hover:text-white font-medium rounded-full text-sm p-1 mr-1 text-center inline-flex items-center cursor-pointer" onclick="">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="edit" width="23" fill="currentcolor">
                                    <path d="M5,18H9.24a1,1,0,0,0,.71-.29l6.92-6.93h0L19.71,8a1,1,0,0,0,0-1.42L15.47,2.29a1,1,0,0,0-1.42,0L11.23,5.12h0L4.29,12.05a1,1,0,0,0-.29.71V17A1,1,0,0,0,5,18ZM14.76,4.41l2.83,2.83L16.17,8.66,13.34,5.83ZM6,13.17l5.93-5.93,2.83,2.83L8.83,16H6ZM21,20H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z">
                                    </path>
                                </svg>
                            </label>
                            <a href="#" data-supplier-id="{{ $item->supplier_id }}" class="supplier-delete-link text-red-700 border border-red-700 hover:bg-red-700 hover:text-white font-medium rounded-full text-sm p-2   text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="w-4" fill="currentcolor" viewBox="0 0 16 16">
                                    <path d="M 6.496094 1 C 5.675781 1 5 1.675781 5 2.496094 L 5 3 L 2 3 L 2 4 L 3 4 L 3 12.5 C 3 13.328125 3.671875 14 4.5 14 L 10.5 14 C 11.328125 14 12 13.328125 12 12.5 L 12 4 L 13 4 L 13 3 L 10 3 L 10 2.496094 C 10 1.675781 9.324219 1 8.503906 1 Z M 6.496094 2 L 8.503906 2 C 8.785156 2 9 2.214844 9 2.496094 L 9 3 L 6 3 L 6 2.496094 C 6 2.214844 6.214844 2 6.496094 2 Z M 5 5 L 6 5 L 6 12 L 5 12 Z M 7 5 L 8 5 L 8 12 L 7 12 Z M 9 5 L 10 5 L 10 12 L 9 12 Z">
                                    </path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--/Card-->


    </div>
    <!-- MODAL -->


    <div class="main-modal fixed w-full h-100  inset-0 z-50 flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
        <div class="modal-container bg-white w-3/6 rounded-xl z-50">
            <div class="modal-content py-4 text-left px-6 max-h-screen overflow-y-auto">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-xl font-semibold text-gray-700 mb-2" name="title" id="title">Supplier Profile:</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" id="exitButton" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>
                <!--Body-->
                <form id="supplier-to-category" class="relative rounded-md bg-white" method="post">

                    <!--  body -->
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">Supplier
                                    Name:</label>
                                <input type="text" name="name" id="nameSupplier" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="Juan Dela Cruz" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">ID
                                    :</label>
                                <input type="text" name="supplier" id="idValue" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" disabled>
                            </div>

                            <div class="col-span-6 sm:col-span-3" hidden>
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">ID
                                    :</label>
                                <input type="text" name="supplier" id="idValue2" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="supplier-name" class="block mb-2 text-sm font-medium text-gray-900">Contact
                                    Number:</label>
                                <input type="text" name="contact" id="contactSupplier" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="09355039007" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-model" class="block mb-2 text-sm font-medium text-gray-900">Address:</label>
                                <input type="text" name="address" id="addressSupplier" class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input" placeholder="Address">
                            </div>


                            <div class="col-span-6 sm:col-span-6">
                                <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900">Categories:</label>
                                <select data-te-select-init data-te-select-filter="true" name="categories[]" class="shadow-sm bg-red-500 bg-custom-color block p-2.5 editable-input" multiple>
                                    @foreach ($categories as $item)
                                    @if ($item->deleted == "false")
                                    <option value="{{ $item->category_id }}" compare="{{ $item->supplier_list }}">
                                        {{ $item->category_name }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>


                            </div>
                        </div>

                        <div class="w-full flex justify-end items-center mt-2 mr-2">
                            <button type="submit" class="text-white bg-ntccolor hover:bg-teal-600 font-medium rounded-full px-5 h-10 mt-3 text-sm text-center">Update</button>
                        </div>


                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js">
    </script>

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

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.supplier-delete-link');

        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default click behavior
                const supplierId = this.getAttribute('data-supplier-id');
                console.log(supplierId);
                // Create a custom confirmation dialog
                const confirmation = confirm(
                    `Are you sure you want to delete this supplier?\n\nClick "OK" to delete or "Cancel" to cancel.`
                );

                if (confirmation) {
                    fetch(`/remove-supplier/${supplierId}`, {
                            method: 'GET', // Change to 'POST' if necessary
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                            },
                        })
                        .then(response => {
                            if (response.ok) {
                                // Handle success (e.g., show a success message)
                                alert('Supplier removed successfully.');
                                // You can also reload the page or update the UI as needed
                                location.reload();
                            } else {
                                // Handle errors (e.g., show an error message)
                                alert('Error: Unable to remove supplier.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('supplier-form');

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Serialize form data
            const formData = new FormData(form);

            fetch('/addSupplier', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Handle a successful response (e.g., show success message)
                        alert('Supplier added successfully.');
                        // You can also reset the form or redirect to another page
                        location.reload();
                    } else {
                        // Handle errors (e.g., show error message)
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('supplier-to-category');

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Serialize form data
            const formData = new FormData(form);

            fetch('/SupplierCategory', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Handle a successful response (e.g., show success message)
                        alert('Supplier Updated successfully.');
                        // You can also reset the form or redirect to another page
                        location.reload();
                    } else {
                        // Handle errors (e.g., show error message)
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>

<script>

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
    const openModal = (supplierID) => {
        // Show the modal - no need to redefine 'modal' here
        modal.classList.remove('fadeOut');
        modal.classList.add('fadeIn');
        modal.style.display = 'flex';
        console.log(supplierID);

        const categoriesSelect = document.querySelector("select[name='categories[]']");


        const selectedSupplierId = supplierID;

        for (const option of categoriesSelect.options) {
            const supplierList = option.getAttribute("compare");

            if (supplierList && supplierList.includes(selectedSupplierId)) {
                option.setAttribute("selected", "selected");
        
            } else {
                option.removeAttribute("selected");
            }
        }

        $.ajax({
            type: 'GET',
            url: `/SupplierInfo/${supplierID}`,
            success: function(response) {
                // Update the modal content with the data received from PHP
                document.getElementById('nameSupplier').value = response.name;
                document.getElementById('idValue2').value = response.supplier_id;
                document.getElementById('idValue').value = response.supplier_id;
                document.getElementById('contactSupplier').value = response.contact;
                document.getElementById('addressSupplier').value = response.address;
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
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

</html>