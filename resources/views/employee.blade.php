<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee</title>

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


<body class="bg-gray-100 py-2">
    @include('components.sidebar')


    <div class="ml-auto px-2 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] h-full">
        <div class="my-auto flex justify-start">
            <!--Container-->
            <div class="w-full mb-1">

                <div class="p-8 my-1 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
                    <h2 class="text-2xl font-bold text-ntccolor">
                        Employee
                    </h2>
                </div>
            </div>
        </div>

        <div class="w-full mb-2">
            <!--Card-->
            <form id="employee-form" class="relative rounded-md bg-white" method="post">

                <!--  body -->
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6 sm:col-span-3">
                            <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">Employee
                                Name:</label>
                            <input type="text" name="name" id="item-serial"
                                class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                placeholder="Employee Name" required="">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="supplier-name"
                                class="block mb-2 text-sm font-medium text-gray-900">Department:</label>
                            <input type="text" name="department" id="item-model"
                                class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                placeholder="Department" required="">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="item-model"
                                class="block mb-2 text-sm font-medium text-gray-900">Position:</label>
                            <input type="text" name="position" id="item-model"
                                class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                placeholder="Position" required="">
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="item-model" class="block mb-2 text-sm font-medium text-gray-900">Email:</label>
                            <input type="email" name="email" id="item-model"
                                class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                placeholder="Email" required="">
                        </div>

                        <div class="col-span-6 sm:col-span-1 flex justify-end items-center mt-4">
                            <button type="submit"
                                class="text-white bg-ntccolor hover:bg-teal-600 font-medium rounded-full px-5 h-10 mt-3 mb-3 text-sm text-center">Add
                                Employee</button>
                        </div>



                    </div>

            </form>

        </div>
    </div>


    <!--Card-->
    <div id='suppliers' class="p-8 lg:mt-0 rounded-lg shadow bg-white ">
        <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead class="">
                <tr>
                    <th data-priority="1">Employee ID</th>
                    <th data-priority="2">Employee Name</th>
                    <th data-priority="3">Department</th>
                    <th data-priority="4">Position</th>
                    <th data-priority="5">Email</th>
                    <th data-priority="6">Action</th>
                </tr>
            </thead>
            <tbody id="suppliers">
                @foreach ($employee as $item)
                @if ($item->deleted == "false")
                <tr>
                    <td class="text-center">{{ $item->employee_id }}</td>
                    <td class="text-center">{{ $item->name }}</td>
                    <td class="text-center">{{ $item->department }}</td>
                    <td class="text-center">{{ $item->position }}</td>
                    <td class="text-center">{{ $item->email }}</td>
                    <td class="text-center items-center flex justify-center">
                        <button data-item-id="" onclick="openModal('{{ $item->employee_id }}')"
                            class="mr-1 btn btn-primary rounded-3xl text-ntccolor border border-ntccolor hover:bg-ntccolor hover:text-white font-medium text-sm p-1.5 text-center inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="edit" class="w-5"
                                fill="currentcolor">
                                <path
                                    d="M5,18H9.24a1,1,0,0,0,.71-.29l6.92-6.93h0L19.71,8a1,1,0,0,0,0-1.42L15.47,2.29a1,1,0,0,0-1.42,0L11.23,5.12h0L4.29,12.05a1,1,0,0,0-.29.71V17A1,1,0,0,0,5,18ZM14.76,4.41l2.83,2.83L16.17,8.66,13.34,5.83ZM6,13.17l5.93-5.93,2.83,2.83L8.83,16H6ZM21,20H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z">
                                </path>
                            </svg></button>
                        <a href="#" data-employee-id="{{ $item->employee_id }}"
                            class="employee-delete-link text-red-700 border border-red-700 hover:bg-red-700 hover:text-white font-medium rounded-full text-sm p-2   text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="w-4" fill="currentcolor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M 6.496094 1 C 5.675781 1 5 1.675781 5 2.496094 L 5 3 L 2 3 L 2 4 L 3 4 L 3 12.5 C 3 13.328125 3.671875 14 4.5 14 L 10.5 14 C 11.328125 14 12 13.328125 12 12.5 L 12 4 L 13 4 L 13 3 L 10 3 L 10 2.496094 C 10 1.675781 9.324219 1 8.503906 1 Z M 6.496094 2 L 8.503906 2 C 8.785156 2 9 2.214844 9 2.496094 L 9 3 L 6 3 L 6 2.496094 C 6 2.214844 6.214844 2 6.496094 2 Z M 5 5 L 6 5 L 6 12 L 5 12 Z M 7 5 L 8 5 L 8 12 L 7 12 Z M 9 5 L 10 5 L 10 12 L 9 12 Z">
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


    <div class="main-modal fixed w-full h-100  inset-0 z-50 flex justify-center items-center animated fadeIn faster"
        style="background: rgba(0,0,0,.7);">
        <div class="modal-container bg-white w-3/6 rounded-xl z-50">
            <div class="modal-content py-4 text-left px-6 max-h-screen overflow-y-auto">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-xl font-semibold text-gray-700 mb-2" name="title" id="title">Edit Employee</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" id="exitButton" xmlns="http://www.w3.org/2000/svg"
                            width="18" height="18" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>
                <!--Body-->
                <form id="employee-update-form" class="relative rounded-md bg-white" method="post">
                    @csrf
                    <!--  body -->
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">Employee
                                    Name:</label>
                                <input type="text" name="name" id="name1"
                                    class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                    placeholder="Employee Name" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="supplier-name"
                                    class="block mb-2 text-sm font-medium text-gray-900">Department:</label>
                                <input type="text" name="department" id="department1"
                                    class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                    placeholder="IT Department" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-3" hidden>
                                <label for="supplier-name"
                                    class="block mb-2 text-sm font-medium text-gray-900">Department:</label>
                                <input type="text" name="id" id="id1"
                                    class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                    placeholder="IT Department" required="">
                            </div>


                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-model"
                                    class="block mb-2 text-sm font-medium text-gray-900">Position:</label>
                                <input type="text" name="position" id="position1"
                                    class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                    placeholder="IT Staff" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-model"
                                    class="block mb-2 text-sm font-medium text-gray-900">Email:</label>
                                <input type="email" name="email" id="email1"
                                    class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                    placeholder="juan_delacruz@ntcm.com.ph" required="">
                            </div>

                        </div>
                        <div class="flex justify-end items-center mt-5 mr-2">
                            <button type="submit"
                                class="text-white bg-ntccolor hover:bg-teal-600 font-medium rounded-full px-5 h-10 mt-3 mb-3 text-sm text-center">Update</button>
                        </div>

                </form>
            </div>
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

        var table = $('#example').DataTable({
                responsive: true
            })
            .columns.adjust()
            .responsive.recalc();
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('employee-form');

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Serialize form data
            const formData = new FormData(form);

            fetch('/addEmployee', {
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
                });
        });
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('employee-update-form');

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Serialize form data
            const formData = new FormData(form);

            fetch('/updateEmployee', {
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
                });
        });
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
    const openModal = (employeeID) => {
        // Show the modal - no need to redefine 'modal' here
        modal.classList.remove('fadeOut');
        modal.classList.add('fadeIn');
        modal.style.display = 'flex';

        $.ajax({
            type: 'GET',
            url: `/getEmployeeDetail/${employeeID}`,
            success: function(response) {
                // Update the modal content with the data received from PHP
                document.getElementById('name1').value = response.name;
                document.getElementById('department1').value = response.department;
                document.getElementById('position1').value = response.position;
                document.getElementById('id1').value = response.employee_id;
                document.getElementById('email1').value = response.email;
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.employee-delete-link');

        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default click behavior
                const supplierId = this.getAttribute('data-employee-id');

                // Create a custom confirmation dialog
                const confirmation = confirm(
                    `Are you sure you want to delete this supplier?\n\nClick "OK" to delete or "Cancel" to cancel.`
                );

                if (confirmation) {
                    fetch(`/remove-employee/${supplierId}`, {
                            method: 'GET', // Change to 'POST' if necessary
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                            },
                        })
                        .then(response => {
                            if (response.ok) {
                                // Handle success (e.g., show a success message)
                                alert('Employee removed successfully.');
                                // You can also reload the page or update the UI as needed
                                location.reload();
                            } else {
                                // Handle errors (e.g., show an error message)
                                alert('Error: Unable to remove employee.');
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


</body>


</html>