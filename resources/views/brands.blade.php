<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brands</title>

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
                        Brands
                    </h2>
                </div>
            </div>
        </div>

        <div class="flex flex-row">
            <!-- BRANDS -->

            <div class="w-full mr-1">
                <form id="brand-form" class="flex-1 h-56 bg-white p-4 shadow rounded-lg mb-2">
                    @csrf <h2 class="text-gray-700 text-md font-semibold pb-1 px-3">Add New Brand</h2>
                    <div class="my-1"></div>
                    <div class="bg-ntccolor h-px mb-6"></div>

                    <div class="px-2 flex justify-center">
                        <div class="w-1/2 ">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Brand
                                Name:</label>
                            <input type="text" name="name" id="name"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5"
                                placeholder="Brand Name">
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <div class=" w-full flex justify-end pt-4">
                            <button type="submit" id="submit-brand"
                                class="text-white bg-ntccolor hover:bg-teal-600 focus:ring-4 focus:outline-none  font-medium rounded-full text-sm px-7 py-2.5 text-center">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--Card-->
        <div id='suppliers' class="p-8 lg:mt-0 rounded-lg shadow bg-white">
            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead class="">
                    <tr>
                        <th data-priority="1">Brand Code</th>
                        <th data-priority="2">Brand Name</th>
                        <th data-priority="3">Categories</th>
                        <th data-priority="4">Action</th>
                    </tr>
                </thead>
                <tbody id="suppliers">
                    @foreach ($brands as $item)
                    @if ($item->deleted == "false")
                    <tr>
                        <td class="text-center">{{ $item->brand_id }}</td>
                        <td class="text-center">{{ $item->name }}</td>
                        <td class="text-center">
                            @php
                            $categoryNames = [];
                            $categoryIdsArray = json_decode($item->category_list);
                            @endphp

                            @if (!is_null($categoryIdsArray))
                            @foreach ($categoryIdsArray as $categoryId)
                            @foreach ($categories as $category)
                            @if ($category->deleted == "false")
                            @if ($categoryId == $category->category_id)
                            @php
                            $categoryNames[] = $category->category_name;
                            @endphp
                            @endif
                            @endif
                            @endforeach
                            @endforeach
                            @endif

                            {{ implode(', ', $categoryNames) }}
                        </td>
                        <td class="text-center items-center flex justify-center">
                            <label data-brand-id="{{ $item->brand_id }}"
                                class="text-ntccolor border border-ntccolor hover:bg-ntccolor hover:text-white font-medium rounded-full text-sm p-1 mr-1 text-center inline-flex items-center cursor-pointer"
                                onclick="openModal('{{ $item->brand_id }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="edit" width="23"
                                    fill="currentcolor">
                                    <path
                                        d="M5,18H9.24a1,1,0,0,0,.71-.29l6.92-6.93h0L19.71,8a1,1,0,0,0,0-1.42L15.47,2.29a1,1,0,0,0-1.42,0L11.23,5.12h0L4.29,12.05a1,1,0,0,0-.29.71V17A1,1,0,0,0,5,18ZM14.76,4.41l2.83,2.83L16.17,8.66,13.34,5.83ZM6,13.17l5.93-5.93,2.83,2.83L8.83,16H6ZM21,20H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z">
                                    </path>
                                </svg>
                            </label>
                            <a href="#" data-brand-id="{{ $item->brand_id }}"
                                class="brand-delete-link text-red-700 border border-red-700 hover:bg-red-700 hover:text-white font-medium rounded-full text-sm p-2   text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="15" height="15"
                                    fill="currentcolor" viewBox="0 0 16 16">
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


    </div>


    <div class="main-modal fixed w-full h-100  inset-0 z-50 flex justify-center items-center animated fadeIn faster"
        style="background: rgba(0,0,0,.7);">
        <div class="modal-container bg-white w-3/6 rounded-xl z-50">
            <div class="modal-content py-4 text-left px-6 max-h-screen overflow-y-auto">
                <!--Title-->
                <div class="flex justify-between items-center">
                    <p class="text-xl font-semibold text-gray-700 mb-2" name="title" id="title">Edit Brand:</p>
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
                <!--  body -->
                <form id="brand-update-form" action="/updateBrandInfox" method="post">
                    @csrf
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="nameBrand" class="block mb-2 text-sm font-medium text-gray-900">Brand
                                    Name:
                                </label>
                                <input type="text" name="nameBrand" id="nameBrand"
                                    class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input"
                                    placeholder="brandName-display" required="">
                            </div>
                            <div hidden>
                                <input name="idValue" id="idValue"
                                    class="shadow-sm  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 editable-input">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <label for="last-name"
                                    class="block mb-2 text-sm font-medium text-gray-900">Categories:</label>
                                <select data-te-select-init data-te-select-filter="true" name="category[]"
                                    id="category[]"
                                    class="shadow-sm bg-red-500 bg-custom-color block w-full p-2.5 editable-input"
                                    multiple>
                                    @foreach ($categories as $item)
                                    @if ($item->deleted == "false")
                                    <option value="{{ $item->category_id }}">{{ $item->category_name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="flex justify-end mt-6 mr-2">
                            <button type="submit"
                                class="text-white bg-ntccolor hovers:bg-teal-800 focus:ring-4 focus:outline-none font-medium rounded-full text-sm px-7 py-2 text-center ml-3">Update</button>
                        </div>
                    </div>
                </form>
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
    const links = document.querySelectorAll('.brand-delete-link');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent the default click behavior
            const supplierId = this.getAttribute('data-brand-id');

            // Create a custom confirmation dialog
            const confirmation = confirm(
                `Are you sure you want to delete this supplier?\n\nClick "OK" to delete or "Cancel" to cancel.`
            );

            if (confirmation) {
                fetch(`/remove-brand/${supplierId}`, {
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
document.addEventListener("DOMContentLoaded", function() {
    const supplierSelect = document.getElementById("category");
    const brandSelect = document.querySelector("select[name='brands[]']");

    supplierSelect.addEventListener("change", function() {
        const selectedSupplierId = supplierSelect.value;

        for (const option of brandSelect.options) {
            const supplierList = option.getAttribute("compare");
            console.log("Category List:", supplierList);
            console.log("Selected Category Id:", selectedSupplierId);

            if (supplierList && supplierList.includes(selectedSupplierId)) {
                option.setAttribute("selected", "selected");
                console.log("Selected");
            } else {
                option.removeAttribute("selected");
                console.log("Not Selected");
            }
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('brand-category');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        const formData = new FormData(form);

        fetch('/CategoryBrand', {
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
                    alert('Brand added successfully.');
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
    const form = document.getElementById('brand-form');
    const submitButton = document.getElementById('submit-brand');

    submitButton.addEventListener('click', function() {
        // Serialize form data
        const formData = new FormData(form);

        fetch('/addBrand', {
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
                    alert('Brand added successfully.');
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
// Define the modal and closeButton variables
const modal = document.querySelector('.main-modal');
const closeButton = document.querySelectorAll('.modal-close');

// Function to close the modal
const modalClose = () => {
    modal.classList.remove('fadeIn');
    modal.classList.add('fadeOut');
    restartSelect();
    setTimeout(() => {
        modal.style.display = 'none';
    }, 10); // Adjust the delay as needed
};

// Function to open the modal with AJAX request
const openModal = (brandId) => {
    // Show the modal - no need to redefine 'modal' here
    modal.classList.remove('fadeOut');
    modal.classList.add('fadeIn');
    modal.style.display = 'flex';

    // Make an AJAX request to your PHP script
    $.ajax({
        type: 'GET',
        url: `/BrandInfo/${brandId}`,
        success: function(response) {
            // Update the modal content with the data received from PHP
            document.getElementById('nameBrand').value = response.name;
            document.getElementById('idValue').value = response.brand_id;
            var selectElement = document.querySelector('select[name="category[]"]');
            var catList = JSON.parse(response.category_list)
            if (selectElement && Array.isArray(catList)) {
                // Iterate through the <option> elements in the select
                var options = selectElement.querySelectorAll('option');

                options.forEach(function(option) {
                    console.log(option.value);
                    if (catList.includes(option.value)) {
                        option.setAttribute("selected", "selected");
                    }
                });
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
    restartSelect();

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
        restartSelect();
        modalClose();
    }
};

function restartSelect() {
    var selectElement = document.querySelector('select[name="category[]"]');
    var options = selectElement.querySelectorAll('option');

    options.forEach(function(option) {
        option.removeAttribute("selected");
        selectElement.selectedIndex = -1; // Clear the selected property
    });
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('brand-update-form');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        const formData = new FormData(form);

        fetch('/updateBrandInfox', {
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
                    alert('Brand updated successfully.');
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



</html>