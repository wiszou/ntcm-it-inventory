<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<style>
.w-16 {
    width: 20px;
    /* Adjust the width as needed */
    height: 20px;
    /* Adjust the height as needed */
}
</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categories</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
                        Categories
                    </h2>
                </div>
            </div>
        </div>


        <!-- Categories -->
        <form id="category-form" class="flex-1 bg-white p-4 shadow rounded-lg mb-2">
            @csrf <h2 class="text-gray-700 text-md font-semibold pb-1 px-3">Add Category</h2>
            <div class="my-1"></div>
            <div class="bg-ntccolor h-px mb-6"></div>

            <div class="px-2 flex justify-center">
                <div class="w-1/2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Category
                        Name:</label>
                    <input type="text" name="name" id="name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5"
                        placeholder="Category Name" required>
                </div>
                <div class="w-1/2 px-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Stock Requirement:</label>
                    <input type="number" name="stock" id="name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5"
                        placeholder="Quantity" required>
                </div>

                <div class="w-24 pl-4">
                    <label for="specs" class="block mb-2 text-sm font-medium text-gray-900 ">Specs:</label>
                    <input type="checkbox" name="specs" id="specs" value="1" class="w-6 h-10 ml-2">
                </div>

                <div class="w-24">
                    <label for="specs" class="block mb-2 text-sm font-medium text-gray-900 ">Consumable:</label>
                    <input type="checkbox" name="consumable" id="consumable" value="1" class="w-6 h-10 ml-3">
                </div>
            </div>
            <div class="flex space-x-2">
                <div class=" w-full flex justify-end pt-4">
                    <button type="submit"
                        class="text-white bg-ntccolor hover:bg-teal-600 focus:ring-4 focus:outline-none font-medium rounded-full text-sm px-7 py-2.5 text-center">Add</button>
                </div>
            </div>
        </form>


        <!-- List of Categories -->
        <div class="flex-1 bg-white p-4 shadow rounded-lg w-full mt-1">

            <table id="example" class="stripe hover text-center"
                style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead class="">
                    <tr>
                        <th data-priority="1">
                            Category ID
                        </th>
                        <th data-priority="2">
                            Category Name
                        </th>
                        <th data-priority="3">
                            Stock Req
                        </th>
                        <th data-priority="4">
                            With Specs
                        </th>
                        <th data-priority="4">
                            Consumable
                        </th>
                        <th data-priority="5">
                            Action
                        </th>
                        <th data-priority="6">
                            Date Created
                        </th>
                        <th data-priority="7">
                            Date Updated
                        </th>
                    </tr>
                </thead>
                <tbody id="inventoryTableBody">
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        @foreach ($category as $item)
                        @if ($item->deleted == "false")
                        <td>{{ $item->category_id }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>{{ $item->stock_req }}</td>
                        <td class="px-6 py-3">
                            <input type="checkbox" name="specs" id="specs" value="1" class="w-16 mt-3"
                                {{ $item->specs == 1 ? 'checked' : '' }} disabled>
                        </td>
                        <td class="px-6 py-3">
                            <input type="checkbox" name="specs" id="specs" value="1" class="w-16 mt-3"
                                {{ $item->consumable == 1 ? 'checked' : '' }} disabled>
                        </td>
                        <td class="px-6 py-4 items-center flex justify-center">
                            <button data-item-id="" onclick="openModal('{{ $item->category_id }}')"
                                class="mr-1 btn btn-primary rounded-3xl text-ntccolor border border-ntccolor hover:bg-ntccolor hover:text-white font-medium text-sm p-1.5 text-center inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26" id="edit" width="23"
                                    fill="currentcolor">
                                    <path
                                        d="M5,18H9.24a1,1,0,0,0,.71-.29l6.92-6.93h0L19.71,8a1,1,0,0,0,0-1.42L15.47,2.29a1,1,0,0,0-1.42,0L11.23,5.12h0L4.29,12.05a1,1,0,0,0-.29.71V17A1,1,0,0,0,5,18ZM14.76,4.41l2.83,2.83L16.17,8.66,13.34,5.83ZM6,13.17l5.93-5.93,2.83,2.83L8.83,16H6ZM21,20H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z">
                                    </path>
                                </svg></button>
                            <a href="#"
                                class="category-delete-link text-red-700 border border-red-700 hover:bg-red-700 hover:text-white font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500"
                                data-category-id="{{ $item->category_id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="15" height="15"
                                    fill="currentcolor" viewBox="0 0 16 16">
                                    <path
                                        d="M 6.496094 1 C 5.675781 1 5 1.675781 5 2.496094 L 5 3 L 2 3 L 2 4 L 3 4 L 3 12.5 C 3 13.328125 3.671875 14 4.5 14 L 10.5 14 C 11.328125 14 12 13.328125 12 12.5 L 12 4 L 13 4 L 13 3 L 10 3 L 10 2.496094 C 10 1.675781 9.324219 1 8.503906 1 Z M 6.496094 2 L 8.503906 2 C 8.785156 2 9 2.214844 9 2.496094 L 9 3 L 6 3 L 6 2.496094 C 6 2.214844 6.214844 2 6.496094 2 Z M 5 5 L 6 5 L 6 12 L 5 12 Z M 7 5 L 8 5 L 8 12 L 7 12 Z M 9 5 L 10 5 L 10 12 L 9 12 Z">
                                    </path>
                                </svg>
                            </a>
                        </td>
                        <td>{{ $item->date_created }}</td>
                        <td>{{ $item->date_change }}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>

        </div>
        <!-- Tailwind Elements Script -->

        </table>
    </div>
    </div>
    <!--MODAL-->
    <div class="main-modal fixed w-full h-100  inset-0 z-50 flex justify-center items-center animated fadeIn faster"
        style="background: rgba(0,0,0,.7);">
        <div class="modal-container bg-white w-3/6 rounded-xl z-50">
            <div class="modal-content py-4 text-left px-6 max-h-screen overflow-y-auto">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-xl font-semibold text-gray-700 mb-2" name="title" id="title">Edit Category</p>
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
                <form id="category-update-form" class="relative rounded-md bg-white" method="post">
                    @csrf
                    <!--  body -->
                    <div class="p-6 w-full">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="item-serial" class="block mb-2 text-sm font-medium text-gray-900">Category
                                    Name:</label>
                                <input type="text" name="name" id="nameCategory"
                                    class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                    placeholder="Category Name" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <label for="supplier-name" class="block mb-2 text-sm font-medium text-gray-900">Stock
                                    Requirement:</label>
                                <input type="number" name="stock" id="stock"
                                    class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                    placeholder="10" required="">
                            </div>

                            <div class="col-span-6 sm:col-span-1">
                                <label for="item-model" class="block mb-2 text-sm font-medium text-gray-900">With
                                    Specs</label>
                                <input type="checkbox" name="specx" id="specx" value="1" class="w-16 mt-3">

                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="item-model" class="block mb-2 text-sm font-medium text-gray-900">Consumable</label>
                                <input type="checkbox" name="quantity" id="quantity" value="1" class="w-16 mt-3">

                            </div>
                            <div class="col-span-6 sm:col-span-1" hidden>
                                <input type="text" name="id" id="idxx"
                                    class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input">
                            </div>
                        </div>

                        <div class="w-full flex justify-end pr-2">
                            <button type="submit"
                                class="text-white bg-ntccolor hover:bg-teal-600 font-medium rounded-full px-5 h-10 mt-3 mb-3 text-sm text-center">Update</button>
                        </div>

                </form>
            </div>
        </div>
    </div>


</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('category-update-form');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        const formData = new FormData(form);

        fetch('/updateCategoryInfo', {
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
                    alert('Category updated successfully.');
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
    const form = document.getElementById('category-form');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        const formData = new FormData(form);

        fetch('/addCategory', {
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
                    alert('Category added successfully.');
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
    const links = document.querySelectorAll('.category-delete-link');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent the default click behavior
            const categoryId = this.getAttribute('data-category-id');

            // Create a custom confirmation dialog
            const confirmation = confirm(
                `Are you sure you want to delete this category?\n\nClick "OK" to delete or "Cancel" to cancel.`
            );

            if (confirmation) {
                fetch(`/remove-category/${categoryId}`, {
                        method: 'GET', // Change to 'POST' if necessary
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            // Handle success (e.g., show a success message)
                            alert('Category removed successfully.');
                            // You can also reload the page or update the UI as needed
                            location.reload();
                        } else {
                            // Handle errors (e.g., show an error message)
                            alert('Error: Unable to remove category.');
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

// Function to open the modal with AJAX request
const openModal = (categoryID) => {
    // Show the modal - no need to redefine 'modal' here
    modal.classList.remove('fadeOut');
    modal.classList.add('fadeIn');
    modal.style.display = 'flex';

    // Make an AJAX request to your PHP script
    $.ajax({
        type: 'GET', // Use GET to retrieve data
        url: `/CategoryInfo/${categoryID}`, // Use the correct URL
        success: function(response) {
            // Update the modal content with the data received from PHP
            document.getElementById('nameCategory').value = response.category_name;
            document.getElementById('stock').value = response.stock_req;
            document.getElementById('idxx').value = response.category_id;
            const value = response.specs;
            console.log(value);
            if (value === "1") { // Use triple equals (===) for strict equality comparison
                document.getElementById('specx').checked = true;

            }
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

<!--Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
<script>
$(document).ready(function() {

    var table = $('#example').DataTable({
            responsive: true
        })
        .columns.adjust()
        .responsive.recalc();
});
</script>



</html>