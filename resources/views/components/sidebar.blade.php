<style>
    .active {
        background-color: #F3F4F6;
        /* Change this to your desired active button background color */

        /* Add any other styles you want for the active button */
    }
</style>



<!--SIDEBAR-->
<aside class="fixed z-10 top-0 pb-3 px-6 w-full flex flex-col justify-between h-screen border-r bg-white transition duration-300 md:w-4/12 lg:ml-0 lg:w-64 xl:w-[20%] 2xl:w-[15%] ">
    <div class="mt-4 pr-1 overflow-y-auto rounded bg-white">
        <a href="" class="flex items-center mb-5">
            <img src="/assets/Logosidebar.png" class="h-full w-full pr-1" alt="NTC Logo" />
        </a>

        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 {{ Request::is('dashboard') ? 'active' : '' }}">
                    <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>


            <!--MAINTENANCE-->
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 {{ Request::is('new-item','suppliers', 'brands', 'updated-category') ? 'active' : '' }}" aria-controls="dropdown-maintenance" data-collapse-toggle="dropdown-maintenance">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Maintenance</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <ul id="dropdown-maintenance" class="hidden py-2 space-y-2">

                    <li>
                        <a href="{{ route('categories') }}" class="flex items-center w-full p-2 text-base font-normal text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100 pl-7">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" fill="currentColor" viewBox="0 0 24 24" class="">
                                <path d="M 0 3 L 0 21 L 20.53125 21 L 24 9 L 4 9 L 2 16 L 1.4375 15.3125 L 3.09375 8 L 21 8 L 21 6 L 9 6 L 7.21875 3 Z">
                                </path>
                            </svg>
                            <span class="text-gray-800 pl-2">Categories</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('brands') }}" class="flex items-center w-full p-2 text-base font-normal text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100 pl-7">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="19" height="19" xmlns="http://www.w3.org/2000/svg" class="">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M10.5021 1.40276C10.9577 1.14026 11.4742 1.00208 12 1.00208C12.5258 1.00208 13.0424 1.14027 13.4979 1.4028L13.5 1.404L20.5 5.40399C20.6632 5.49822 20.8165 5.60722 20.9581 5.72926L11.9999 10.8482L3.0418 5.72931C3.18347 5.60725 3.33678 5.49823 3.5 5.404L3.50386 5.40177L10.5021 1.40276Z" fill="currentColor"></path>
                                    <path d="M2.04843 7.46517C2.01651 7.64064 2.00018 7.81927 2 7.999V16.0011C2.00054 16.5271 2.13941 17.0438 2.40269 17.4993C2.66597 17.9548 3.04439 18.333 3.5 18.5961L3.50386 18.5983L10.5 22.5961L10.5019 22.5971C10.6612 22.689 10.828 22.7656 11 22.8264V12.5804L2.04843 7.46517Z" fill="currentColor"></path>
                                    <path d="M13 22.8264C13.1721 22.7656 13.3389 22.6889 13.4982 22.5971L13.5 22.5961L20.4961 18.5983L20.5 18.5961C20.9556 18.333 21.334 17.9548 21.5973 17.4993C21.8606 17.0438 21.9995 16.5271 22 16.0011V7.999C21.9998 7.81925 21.9835 7.64059 21.9516 7.4651L13 12.5803V22.8264Z" fill="currentColor"></path>
                                </g>
                            </svg>
                            <span class="text-gray-800 pl-2">Brands</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('suppliers') }}" class="flex items-center w-full p-2 text-base font-normal text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100 pl-7">
                            <svg fill="currentColor" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" width="20" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M2.84375 13C1.273438 13 0 14.277344 0 15.84375L0 42C0 43.566406 1.429688 45 3 45L7.09375 45C7.570313 47.835938 10.03125 50 13 50C15.96875 50 18.429688 47.835938 18.90625 45L28.15625 45C29.722656 45 31 43.722656 31 42.15625L31 15.90625C31 14.304688 29.738281 13 28.1875 13 Z M 33 20L33 45C33.480469 47.832031 36.03125 50 39 50C41.96875 50 44.429688 47.832031 44.90625 45L47 45C48.570313 45 50 43.570313 50 42L50 32.375C50 30.363281 48.550781 28.308594 48.375 28.0625L44.21875 22.5C43.265625 21.351563 41.769531 20 40 20 Z M 38 25L43.59375 25L46.78125 29.25C47.121094 29.730469 48 31.203125 48 32.375L48 33L38 33C37 33 36 32 36 31L36 27C36 25.894531 37 25 38 25 Z M 13 40C15.207031 40 17 41.792969 17 44C17 46.207031 15.207031 48 13 48C10.792969 48 9 46.207031 9 44C9 41.792969 10.792969 40 13 40 Z M 39 40C41.207031 40 43 41.792969 43 44C43 46.207031 41.207031 48 39 48C36.792969 48 35 46.207031 35 44C35 41.792969 36.792969 40 39 40Z">
                                    </path>
                                </g>
                            </svg>
                            <span class="text-gray-800 pl-2">Suppliers</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('employee') }}" class="flex items-center w-full p-2 text-base font-normal text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100 pl-7">
                            <svg width="16" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="currentColor">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <path class="st0" d="M159.131,169.721c5.635,58.338,43.367,96.867,96.871,96.867c53.502,0,91.23-38.53,96.867-96.867l7.988-63.029 C365.812,44.768,315.281,0,256.002,0c-59.281,0-109.812,44.768-104.86,106.692L159.131,169.721z">
                                        </path>
                                        <path class="st0" d="M463.213,422.569l-3.824-24.35c-3.203-20.417-16.035-38.042-34.475-47.361l-80.473-40.693 c-2.519-1.274-4.57-3.194-6.289-5.338c-23.297,24.632-51.6,39.12-82.15,39.12c-30.549,0-58.856-14.488-82.152-39.12 c-1.719,2.144-3.77,4.064-6.289,5.338l-80.472,40.693c-18.442,9.319-31.272,26.944-34.475,47.361l-3.826,24.35 c-1.363,8.692,0.436,21.448,8.222,27.825C67.42,458.907,105.875,512,256.002,512c150.125,0,188.578-53.093,198.988-61.606 C462.779,444.017,464.576,431.261,463.213,422.569z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <span class="text-gray-800 pl-2">Employee</span>
                        </a>
                    </li>


                </ul>
            </li>
            <!--END MAINTENANCE-->

            <!--TRANSACTIONAL-->
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 {{ Request::is('updated-equipment', 'updated-inventory') ? 'active' : '' }}" aria-controls="dropdown-transactional" data-collapse-toggle="dropdown-transactional">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-justify " viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" id="mainIconPathAttribute" stroke-width="0.6" stroke="#808080"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Transactional</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <ul id="dropdown-transactional" class="hidden py-2 space-y-2">


                    <li class="flex items-center">
                        <a href="{{ route('newitem') }}" class="flex items-center w-full p-2 text-base font-normal text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100 pl-8 {{ Request::is('newitem') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                            </svg>
                            <span class="text-gray-800 pl-2">Add Item</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('updated-inventory') }}" class="flex items-center w-full p-2 text-base font-normal text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100 pl-8">
                            <svg width="20px" height="20px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>device-multiple-solid</title>
                                    <g id="Layer_2" data-name="Layer 2">
                                        <g id="invisible_box" data-name="invisible box">
                                            <rect width="48" height="48" fill="none"></rect>
                                        </g>
                                        <g id="icons_Q2" data-name="icons Q2">
                                            <path d="M44,19H32a2,2,0,0,0-2,2V43a2,2,0,0,0,2,2H44a2,2,0,0,0,2-2V21a2,2,0,0,0-2-2Z">
                                            </path>
                                            <path d="M40,9a2,2,0,0,0-2-2H7A2,2,0,0,0,5,9V31a2,2,0,0,0,2,2H26V17a2,2,0,0,1,2-2H40Z">
                                            </path>
                                            <path d="M26,37v4H4a2,2,0,0,1,0-4Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <span class="text-gray-800 pl-2">IT Equipments</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('custodian2') }}" class="flex items-center w-full p-2 text-base font-normal text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100 pl-8">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="flex-shrink-0 w-6 h-6 text-gray-500 " viewBox="0 0 20 20">
                                <path d="M4.98 1a.5.5 0 0 0-.39.188L1.54 5H6a.5.5 0 0 1 .5.5 1.5 1.5 0 0 0 3 0A.5.5 0 0 1 10 5h4.46l-3.05-3.812A.5.5 0 0 0 11.02 1H4.98zM3.81.563A1.5 1.5 0 0 1 4.98 0h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625a.5.5 0 0 1 .106.374l-.39 3.124A1.5 1.5 0 0 1 14.117 10H1.883A1.5 1.5 0 0 1 .394 8.686l-.39-3.124a.5.5 0 0 1 .106-.374L3.81.563zM.125 11.17A.5.5 0 0 1 .5 11H6a.5.5 0 0 1 .5.5 1.5 1.5 0 0 0 3 0 .5.5 0 0 1 .5-.5h5.5a.5.5 0 0 1 .496.562l-.39 3.124A1.5 1.5 0 0 1 14.117 16H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .121-.393z" />
                            </svg>
                            <span class="flex-1 pl-1 whitespace-nowrap text-gray-800">Custodian</span>
                        </a>
                    </li>

                </ul>
            </li>
            <!--END TRANSACTIONAL-->

            <li>
                <a href="{{ route('updated-custodian') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg  hover:bg-gray-100 {{ Request::is('updated-custodian') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" class="text-gray-500" fill="currentColor" viewBox="0 0 30 30">
                        <path d="M24.707,8.793l-6.5-6.5C18.019,2.105,17.765,2,17.5,2H7C5.895,2,5,2.895,5,4v22c0,1.105,0.895,2,2,2h16c1.105,0,2-0.895,2-2 V9.5C25,9.235,24.895,8.981,24.707,8.793z M18,21h-8c-0.552,0-1-0.448-1-1c0-0.552,0.448-1,1-1h8c0.552,0,1,0.448,1,1 C19,20.552,18.552,21,18,21z M20,17H10c-0.552,0-1-0.448-1-1c0-0.552,0.448-1,1-1h10c0.552,0,1,0.448,1,1C21,16.552,20.552,17,20,17 z M18,10c-0.552,0-1-0.448-1-1V3.904L23.096,10H18z">
                        </path>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Archives</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logs') }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 {{ Request::is('logs') ? 'active' : '' }}">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                        </path>
                        <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                        </path>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Logs</span>
                </a>
            </li>


        </ul>
    </div>
    <ul class="mt-auto space-y-2">
        <li>
            <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg  hover:bg-gray-100" onclick='logOut()'>
                <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75  group-hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                </svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Log out</span>
            </a>
        </li>
    </ul>
</aside>
</aside>
<script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
</div>
</div>
<script>
    function logOut() {
        // Define and set the confirmation variable as needed.
        // For example, you might use window.confirm to show a confirmation dialog.
        var confirmation = window.confirm("Are you sure you want to log out?");

        if (confirmation) {
            fetch(`/log-out`, {
                    method: 'GET', // Change to 'POST' if necessary
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Make sure this is properly replaced with the CSRF token
                    },
                })
                .then(response => {
                    if (response.ok) {
                        // Handle success (e.g., show a success message)
                        alert('Log out successfully.');
                        location.reload();
                    } else {
                        // Handle errors (e.g., show an error message)
                        alert('Error: Unable to log out supplier.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }
</script>
</aside>



<!--END SIDEBAR-->