<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Custodian Form</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <!--Replace with your tailwind.css once created-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->


    <script>
        function printBothDivs(divIds) {
            var printContents = '';

            for (var i = 0; i < divIds.length; i++) {
                var divId = divIds[i];
                var divContent = document.getElementById(divId).innerHTML;

                // Create a new page with the div's content
                var page = '<html><head><title>Print</title></head><body>' + divContent + '</body></html>';

                printContents += page;

                // Add a page break if it's not the last div
                if (i < divIds.length - 1) {
                    printContents += '<div style="page-break-before: always;"></div>';
                }
            }

            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;

            window.print();

            // Restore the original contents
            document.body.innerHTML = originalContents;
        }
    </script>

</head>


<body class="h-screen w-full bg-gray-100 text-black">

    <div class="w-full mb-5 sticky top-0 z-10">

        <div class="py-5 px-10 lg:mt-0 rounded shadow bg-white flex flex-row justify-between">
            <h2 class="text-2xl font-bold text-ntccolor">
                Print Custodian Form
            </h2>
            <input type="button" onclick="printBothDivs(['printableArea1', 'printableArea2'])" value="Print" class="bg-ntccolor rounded-3xl text-white font-medium px-7 hover:bg-[#014F62] cursor-pointer " />
        </div>
    </div>




    <div class="w-full flex flex-col items-center">


        <div class="w-1/2 bg-white pt-8 px-2 mb-8 pb-16 flex">
            <!-- PAPER 1 -->

            <!--PRINTABLE AREA 1 -->
            <div class="w-full" id="printableArea1">
                @if ($custodian->status == 1)
                <div class="absolute mt-96 ml-20">
                    <img src="/assets/returned.png" class="h-full w-full" alt="returned" />
                    <h5 class="w- full text-4xl text-red-600 font-bold flex justify-center">DATE: {{ $custodian->end_date}}
                    </h5>
                </div>
                @endif
                <div class="mx-auto w-full bg-white px-8">
                    <div class="flex justify-between">
                        <div>
                            <img src="/assets/Logosidebar.png" class="h-20" />
                        </div>

                        <div class="pt-6">
                            <p class="text-right text-xl font-medium">CUSTODIAN FORM</p>
                            <p class="text-right text-lg">IT Equipment</p>
                            <p class="text-right text-sm">{{ $custodian->custodian_id}}</p>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm underline underline-offset-4 pb-4 pt-4">{{ $custodian->start_date}}</p>

                            <table class="table-auto mt-3">
                                <tbody>
                                    <tr>
                                        <td class="text-sm font-medium">Equipment Custodian:</td>
                                        <td class="text-sm pl-3 underline underline-offset-4">{{ $employee->name }}</td>

                                    </tr>
                                    <tr>
                                        <td class="text-sm font-medium">Position / Function:</td>
                                        <td class="pl-3 text-sm underline underline-offset-4">{{ $employee->position }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-medium">Department:</td>
                                        <td class="pl-3 text-sm underline underline-offset-4">
                                            {{ $employee->department }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-8 pr-4">
                        <p class="text-justify text-sm text-black font-medium">I agree & accept the following NMFPI
                            guidelines
                            governing the issuance of Information Technology equipment to me:</p>

                        <p class="mt-3 pl-5 text-justify text-sm text-black">1. The said equipment(s) as detailed and
                            defined by
                            Attachment A is not an employee benefit but a “tool of the trade” which means that because
                            of
                            the
                            current function, NMFPI Management recognizes the need for this kind of equipment to carry
                            out
                            the
                            job efficiently.</p>

                        <p class="mt-3 pl-5 text-justify text-sm text-black">2. It is NMFPI Management’s sole
                            prerogative,
                            through an authorized representative to replace, upgrade or in some instances, require the
                            return of
                            the said equipment as it deems necessary in relation to the function.</p>

                        <p class="mt-3 pl-5 text-justify text-sm text-black">3. The employee commits to take care of the
                            item(s)
                            at all times and keep it safe to avoid damage or loss including but not limited to physical
                            state
                            and/or software content</p>

                        <p class="mt-3 pl-5 text-justify text-sm text-black">4. When the item(s) become defective for
                            some
                            reason or another, the employee is obliged to report the said problem to the Information
                            Technology
                            Team thru the CS Supervisor for IT or Corporate Services Manager. It is under the discretion
                            of
                            the
                            Corporate Services Manager to decide the course of action to take regarding the repair of
                            the
                            equipment. In the event that parts are needed for replacement, charging of such replacement
                            will
                            be
                            under the discretion of the Finance and Corporate Services Manager.</p>

                        <p class="mt-3 pl-5 text-justify text-sm text-black">5. In case of loss, it is the employee’s
                            responsibility to reimburse NMFPI the full acquisition cost (including but not limited to
                            the
                            hardware, software and/or peripherals installed or attached) or replace the equipment with a
                            fully
                            functional one subject to the approval of the Corporate Services Manager.</p>

                        <p class="mt-3 pl-5 text-justify text-sm text-black">6. In case of separation or sea service
                            leave,
                            the
                            employee undertakes to surrender voluntarily to the Information Technology Team all of the
                            listed
                            items in good working condition for clearance purposes.</p>
                    </div>

                    <div class="mt-16 pr-4">
                        <table class="w-full table-fixed text-sm">
                            <thead>
                                <tr class="text-center border-black">
                                    <th class=" border-black w-56 pl-1">Accepted/Received By:</th>
                                    <th class=" border-black pl-1">Issued By:</th>
                                    <th class="pl-1 border-black">Noted By:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr">
                                    <td class=" border-black pt-8"></td>
                                    <td class="  border-black pt-8"></td>
                                    <td class=" pt-8 border-black"></td>
                                    </tr>
                                    <tr class="">
                                        <td class="border-black text-center">
                                            <span class="flex pl-1.5 mx-3 border-b border-black justify-center">{{ $employee->name}}</span>(Signature
                                            Over Printed Name)
                                        </td>
                                        <td class="border-black text-center">
                                            <span class="flex pl-1.5 mx-3 border-b border-black justify-center">{{ $issued->name}}</span>{{ $issued->position}}
                                        </td>
                                        <td class="border-black text-center">
                                            <span class="flex pl-1.5 mx-3 border-b border-black justify-center">{{ $noted->name}}</span>{{ $noted->position}}
                                        </td>
                                    </tr>
                                    <tr class=" text-xs text-center border-black">
                                        <td class=" border-black pl-1">{{ $custodian->start_date}}</td>
                                        <td class=" border-black pl-1">{{ $custodian->start_date}}</td>
                                        <td class=" border-black pl-1">{{ $custodian->start_date}}</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END PRINTABLE AREA 1-->
        </div> <!-- END PAPER 1 -->



        <div class="w-1/2 bg-white pt-8 px-2 mb-8 pb-96 flex ">
            <!-- PAPER 2 -->

            <!--PRINTABLE AREA 2 -->
            <div class="w-full px-6" id="printableArea2">
                @if ($custodian->status == 1)
                <div class="absolute mt-72 ml-16">
                    <img src="/assets/returned.png" class="h-full w-full" alt="returned" />
                    <h5 class="w- full text-4xl text-red-600 font-bold flex justify-center">DATE: {{ $custodian->end_date}}
                    </h5>
                </div>
                @endif
                <div class="mx-auto w-full bg-white px-8">
                    <div class="flex justify-between">
                        <div>
                            <img src="/assets/Logosidebar.png" class="h-20" />
                        </div>

                        <div class="pt-6">
                            <p class="text-right text-xl font-medium">CUSTODIAN FORM</p>
                            <p class="text-right text-lg">IT Equipment</p>
                            <p class="text-right text-sm">IT-CSF-0001</p>
                        </div>
                    </div>


                    <div class="mt-9">
                        <p class="font-medium text-center">IT EQUIPMENT - ATTACHMENT A</p>
                    </div>

                    <div class="mt-9 pr-3">
                        <p class="font-bold text-left text-sm mb-3">Purpose:<span class="font-normal text-sm pl-1">{{ $custodian->description}}</span></p>
                        <table class="w-full table-auto border text-sm">
                            <thead>
                                <tr class="border border-black text-center text-sm">
                                    <th class="border border-black px-1 w-10">No.</th>
                                    <th class="border border-black px-1 w-24">Item Code:</th>
                                    <th class="border px-1 border-black w-24">Item:</th>
                                    <th class="border px-1 border-black w-28">Serial Number:</th>
                                    <th class="border px-1 border-black w-32">Remarks:</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item_id)
                                <tr class="border border-black text-center text-sm">
                                    <td class="border border-black"></td>
                                    <td class="border border-black">{{ $item_id }}</td>
                                    <td class="border border-black">
                                        @foreach ($details as $detail)
                                        @if ($detail->item_id == $item_id)
                                        {{ $detail->model }}
                                        <!-- Display the detail -->
                                        @endif
                                        @endforeach
                                    </td>

                                    <td class="border border-black">
                                        @foreach ($details as $detail)
                                        @if ($detail->item_id == $item_id)
                                        {{ $detail->serial_num }}
                                        <!-- Display the detail -->
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="border border-black"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="mt-16 pr-4">
                        <table class="w-full table-fixed text-sm">
                            <thead>
                                <tr class="text-center border-black">
                                    <th class=" border-black w-56 pl-1">Accepted/Received By:</th>
                                    <th class=" border-black pl-1">Issued By:</th>
                                    <th class="pl-1 border-black">Noted By:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr">
                                    <td class=" border-black pt-8"></td>
                                    <td class="  border-black pt-8"></td>
                                    <td class=" pt-8 border-black"></td>
                                    </tr>
                                    <tr class="">
                                        <td class="border-black text-center">
                                            <span class="flex pl-1.5 mx-3 border-b border-black justify-center">{{ $employee->name}}</span>(Signature
                                            Over Printed Name)
                                        </td>
                                        <td class="border-black text-center">
                                            <span class="flex pl-1.5 mx-3 border-b border-black justify-center">{{ $issued->name}}</span>{{ $issued->position}}
                                        </td>
                                        <td class="border-black text-center">
                                            <span class="flex pl-1.5 mx-3 border-b border-black justify-center">{{ $noted->name}}</span>{{ $noted->position}}
                                        </td>
                                        </td>
                                    </tr>
                                    <tr class=" text-xs text-center border-black">
                                        <td class=" border-black pl-1">{{ $custodian->start_date}}</td>
                                        <td class=" border-black pl-1">{{ $custodian->start_date}}</td>
                                        <td class=" border-black pl-1">{{ $custodian->start_date}}</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!-- END PRINTABLE AREA 2 -->
        </div> <!-- END PAPER 2 -->

    </div>
</body>

</html>