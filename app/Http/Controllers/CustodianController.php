<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OutlookEmail;
use App\Mail\ReturnCustodian;

class CustodianController extends Controller
{
    public function getUpdatedCustodian()
    {
        $inventory = DB::table('t_inventory')->get();
        $supplier = DB::table('m_supplier')->get();
        $category = DB::table('m_category')->get();
        return view('custodian', ['inventory' => $inventory, 'categories' => $category, 'suppliers' => $supplier]);
    }

    public function getUpdatedCustodian1()
    {
        $inventory = DB::table('t_inventory')->get();
        $itemdetails = DB::table('t_itemdetails')->get();

        foreach ($itemdetails as $item) {
            $id = $item->item_id;
            $data1 = DB::table('t_inventory')->where('item_id', $id)->first();
            if ($data1) {
                $item->item_status = $data1->item_status;
            }
        }

        $supplier = DB::table('m_supplier')->get();
        $category = DB::table('m_category')->get();
        $custodian = DB::table('t_custodian')->where("status", 0)->get();
        $employee = DB::table('m_employee')->get();
        return view('custodianCreate', ['inventory' => $inventory, 'categories' => $category, 'suppliers' => $supplier, 'details' => $itemdetails, 'custodian' => $custodian, 'employees' => $employee]);
    }

    public function getUpdatedCustodian2()
    {
        $inventory = DB::table('t_inventory')->get();
        $itemdetails = DB::table('t_itemdetails')->get();

        foreach ($itemdetails as $item) {
            $id = $item->item_id;
            $data1 = DB::table('t_inventory')->where('item_id', $id)->first();
            if ($data1) {
                $item->item_status = $data1->item_status;
            }
        }

        $supplier = DB::table('m_supplier')->get();
        $category = DB::table('m_category')->get();
        $custodian = DB::table('t_custodian')->where("status", 1)->get();
        $employee = DB::table('m_employee')->get();
        return view('custodian', ['inventory' => $inventory, 'categories' => $category, 'suppliers' => $supplier, 'details' => $itemdetails, 'custodian' => $custodian, 'employees' => $employee]);
    }

    public function generateID()
    {
        $rowCount = DB::table('t_custodian')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "IT-" . "CSF" . "-" . $formattedRowCount;

        $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "IT-" . "CSF" . "-" . $formattedRowCount;
            $existingCategory = DB::table('t_custodian')->where('custodian_id', $candidateId)->first();
        }

        return $candidateId;
    }

    public function createCustodian(Request $request)
    {

        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());

        $currentDate = date('d-F-Y');
        $custodianID = $this->generateID();
        $handlerName = $request->input('handlerName');
        $description = $request->input('remarks');
        $type = $request->input('type');
        $noted = $request->input('noted');
        $issued = $request->input('issued');
        $items = $request->input('itemArray');


        $filterArray = json_decode($items, true); // Ensure that the JSON is decoded into an associative array
        $length = count($filterArray);

        $statusArray = array();

        for ($i = 0; $i < $length; $i++) {


            if ($type == "Deploy") {
                $typeItem = "Deployed";  // Use = instead of ==
            }

            if ($type == "Borrow") {
                $typeItem = "Borrowed";  // Use = instead of ==
            }


            $statusArray[] = $typeItem;
        }
        $itemStatuses = json_encode($statusArray, true);


        foreach ($filterArray as $key => $value) {
            if ($value === 'none') {
                unset($filterArray[$key]);
            }
        }

        $filterArray = array_unique($filterArray);
        // If you want to re-index the array after removing elements, you can use array_values function
        $filterArray = array_values($filterArray);

        $items = json_encode($filterArray, true);



        if ($type == "none") {
            return response()->json(['success' => false, 'message' => 'Please select proper custodian type']);
        };

        if ($items == "none") {
            return response()->json(['success' => false, 'message' => 'Please select an item']);
        };
        if ($noted == "none") {
            return response()->json(['success' => false, 'message' => 'Please select an item']);
        };
        if ($issued == "none") {
            return response()->json(['success' => false, 'message' => 'Please select an item']);
        };
        if ($handlerName == "none") {
            return response()->json(['success' => false, 'message' => 'Please select an item']);
        };


        $custodianData = array(
            'custodian_id' => $custodianID,
            'name' => $handlerName,
            'noted' => $noted,
            'issued' => $issued,
            'description' => $description,
            'start_date' => $currentDate,
            'status' => 0,
            'deleted' => "false",
            'type' => $type,
            'items' => $items,
            'itemStatus' => $itemStatuses,
            'user_created' => $user,
            'date_created' => $date,
        );


        try {
            $this->updateItem($items, $type, $custodianID);
            DB::table('t_custodian')->insert($custodianData);
            $email = $this->fetchEmployeeEmail($handlerName);
            $this->sendEmail($custodianID, $email);
            $logController = new LogController();
            $logController->sendLog("Custodian Form " . $custodianID . " Succesfully added");
            $this->toPrint($custodianID);
            return response()->json(['success' => true, 'message' => 'Item added successfully.']);
        } catch (\Exception $e) {
            error_log(json_encode($items));
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while adding the item.']);
        }
    }

    function fetchEmployeeEmail($id)
    {
        $data = DB::table('m_employee')->where('employee_id', $id)->first();

        if ($data) {
            $email = $data->email;
            return $email;
        }
    }

    function updateItem($items, $type, $id)
    {

        if ($type == "Deploy") {
            $type = "Deployed";  // Use = instead of ==
        }

        if ($type == "Borrow") {
            $type = "Borrowed";  // Use = instead of ==
        }

        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());

        $itemsArray = json_decode($items);
        foreach ($itemsArray as $item) {

            $itemData = array(
                'item_status' => $type,
                'user_change' => $user,
                'date_change' => $date,
                'custodian_id' => $id
            );

            DB::table('t_inventory')->where('item_id', $item)->update($itemData);
            $result = DB::table('t_inventory')->where('item_id', $item)->first();
            if ($result) {
                $category_id = $result->category_id;
                $category = array(
                    'user_change' => $user,
                    'date_change' => $date,
                );
                DB::table('m_category')->where('category_id', $category_id)->update($category);
            } else {
                return response()->json(['success' => false, 'message' => 'array aasd']);
            }
        }
    }

    public function generateIDEmployee()
    {
        $rowCount = DB::table('m_employee')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "Employee" . "-" . $formattedRowCount;

        $existingCategory = DB::table('m_employee')->where('employee_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "Employee" . "-" . $formattedRowCount;
            $existingCategory = DB::table('m_employee')->where('employee_id', $candidateId)->first();
        }

        return $candidateId;
    }

    public function addEmployee(Request $request)
    {
        $name = $request->input('name');
        $position = $request->input('position');
        $department = $request->input('department');
        $email = $request->input('email');
        $id = $this->generateIDEmployee();

        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());

        $existingSupplier = DB::table('m_employee')
            ->where('name', $name)
            ->where('deleted', false)
            ->where('employee_id', '!=', $id)
            ->first();

        $existingSupplier1 = DB::table('m_employee')
            ->where('email', $email)
            ->where('deleted', false)
            ->where('employee_id', '!=', $id)
            ->first();

        if ($existingSupplier) {
            // A supplier with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'A similar Name/Email already exists.']);
        }

        if ($existingSupplier1) {
            // A supplier with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'A similar Name/Email already exists.']);
        }
        $data = array(
            'name' => $name,
            'email' => $email,
            'position' => $position,
            'department' => $department,
            "employee_id" => $id,
            "deleted" => "false",
            'user_created' => $user,
            'date_created' => $currentDate,
        );

        try {
            DB::table('m_employee')->insert($data);
            $logController = new LogController();
            $logController->sendLog("Employee " . $id . " Succesfully added");
            return response()->json(['success' => true, 'message' => 'Employee added successfully.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while adding the item.']);
        }
    }

    public function updateEmployee(Request $request)
    {
        $name = $request->input('name');
        $position = $request->input('position');
        $department = $request->input('department');
        $id = $request->input('id');
        $email = $request->input('email');

        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());

        $data = array(
            'name' => $name,
            'position' => $position,
            'email' => $email,
            'department' => $department,
            'user_change' => $user,
            'date_change' => $currentDate,
        );


        $existingSupplier = DB::table('m_employee')
            ->where('name', $name)
            ->where('deleted', false)
            ->where('employee_id', '!=', $id)
            ->first();

            $existingSupplier1 = DB::table('m_employee')
            ->where('email', $email)
            ->where('deleted', false)
            ->where('employee_id', '!=', $id)
            ->first();

        if ($existingSupplier) {
            // A supplier with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'A similar Name already exists.']);
        }

        
        if ($existingSupplier1) {
            // A supplier with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'A similar Name already exists.']);
        }

        try {
            DB::table('m_employee')->where('employee_id', $id)->update($data);
            $logController = new LogController();
            $logController->sendLog("Employee " . $id . " Succesfully updated");
            return response()->json(['success' => true, 'message' => 'Employee updated successfully.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while updated the information.']);
        }
    }

    public function toPrint($custodianID)
    {
        $custodian = DB::table('t_custodian')->where('custodian_id', $custodianID)->first();
        $inventory = DB::table('t_inventory')->get();

        $notedid = "";
        $issuedid = "";
        $employeeid = "";
        $employee2id = "";

        if ($custodian) {
            $notedid = $custodian->noted;
            $issuedid = $custodian->issued;
            $employeeid = $custodian->name;
            $employee2id = $custodian->name2;
        } else {
            // Handle the case where no record is found
            $brandName = null; // Or any other default value or error handling
        }

        $noted = DB::table('m_employee')->where('employee_id', $notedid)->first();
        $issued = DB::table('m_employee')->where('employee_id', $issuedid)->first();
        $employee = DB::table('m_employee')->where('employee_id', $employeeid)->first();
        $employee2 = DB::table('m_employee')->where('employee_id', $employee2id)->first();

        $itemArray = json_decode($custodian->items);
        $items = [];
        foreach ($itemArray as $item) {
            // Check if 'items' key exists and 'item_id' key exists within it
            if (isset($item['items']['item_id'])) {
                $item_id = $item['items']['item_id'];

                // Append the item_id to the $items array
                $items[] = $item_id;
            }
        }


        $detail1 = DB::table('t_itemdetails')->get();
        $brand1 = DB::table('m_brand')->get();

        return view('form', [
            'details' => $detail1,
            'inventory' => $inventory,
            'items' => $itemArray,
            'brands' =>  $brand1,
            'custodian' => $custodian,
            'noted' => $noted,
            'issued' => $issued,
            'employee' => $employee,
            'employee2' => $employee2,
        ]);
    }

    public function getEmployeeDetails($id)
    {
        $data = DB::table('m_employee')->where('employee_id', $id)->first();

        // Check if the data was found
        if ($data) {
            // Return the entire data object as JSON
            return response()->json($data);
        } else {
            // If the data was not found, return an error response or handle it as needed
            return response()->json(['error' => 'Brand not found'], 404);
        }
    }

    public function getCustodian($custodianID)
    {
        $data = DB::table('t_custodian')->where('custodian_id', $custodianID)->first();
        $itemsdata = [];

        if ($data) {
            $itemsArray = json_decode($data->items, true);

            foreach ($itemsArray as $item) {
                $result = DB::table('t_itemdetails')->where('item_id', $item)->first();
                $result2 = DB::table('t_inventory')->where('item_id', $item)->first();

                if ($result) {
                    // Add the 'item_status' from $result2 to $result
                    if ($result2) {
                        $result->item_status = $result2->item_status;
                        $result->custodian_id = $result2->custodian_id;
                        $result->current_custodianID = $data->custodian_id; // Fixed the typo


                        if ($data->type == "Deploy") {
                            $type = "Deployed";  // Use = instead of ==
                        }

                        if ($data->type == "Borrow") {
                            $type = "Borrowed";  // Use = instead of ==
                        }
                        $result->item_currentStatus = $type;
                    } else {
                        // If $result2 is not found, set a default value for 'item_status'
                        $result->item_status = 'Not found'; // or any other appropriate default value
                    }
                    $itemsdata[] = $result;
                } else {
                    // Handle the case when item details are not found for a particular item
                    // You might log an error or take appropriate action
                }
            }

            return response()->json($itemsdata);
        } else {
            // If the custodian data is not found, return an error response
            return response()->json(['error' => 'Custodian not found'], 404);
        }
    }



    public function returnItems($itemID, $status)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());

        try {

            if ($status == 'Defect' || $status == 'Missing') {
                $data1 = array(
                    'item_status' => $status,
                    'user_change' => $user,
                    'date_change' => $currentDate,
                );

                // Assuming you've imported the DB facade
                DB::table('t_inventory')->where('item_id', $itemID)->update($data1);
            }

            if ($status == 'Spare') {
                $data1 = array(
                    'item_status' => $status,
                    'user_change' => $user,
                    'custodian_id' => ' ',
                    'date_change' => $currentDate,
                );

                // Assuming you've imported the DB facade
                DB::table('t_inventory')->where('item_id', $itemID)->update($data1);
            }



            $logController = new LogController();
            $logController->sendLog("Item " . $itemID . " Succesfully marked as " . $status);
            return response()->json(['success' => true, 'message' => 'Custodian form updated successfully.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the item.']);
        }
    }

    public function markCustodian($custodianID)
    {
        $update = DB::table('t_custodian')->where('custodian_id', $custodianID)->first();
        $handlerName = "";
        if ($update) {
            $handlerName = $update->name;
        }

        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $end = date('d-F-Y');
        if ($update) {
            $data = array(
                'status' => 1,
                'end_date' => $end,
                'user_change' => $user,
                'date_change' => $currentDate,
            );
            DB::table('t_custodian')->where('custodian_id', $custodianID)->update($data);
            $email = $this->fetchEmployeeEmail($handlerName);
            $this->sendEmail2($custodianID, $email);
            $logController = new LogController();
            $logController->sendLog("Custodian Form " . $custodianID . " Succesfully marked as done");
            return response()->json(['success' => true, 'message' => 'Custodian form updated successfully.']);
        }
    }

    public function sendEmail($id, $email)
    {
        $dataFromDatabase = DB::table('t_custodian')->where('custodian_id', $id)->first();
        $itemArray = array();
        if ($dataFromDatabase) {
            $items = $dataFromDatabase->items;
            $items = json_decode($items, true);
            foreach ($items as $item) {

                $itemInfo = DB::table('t_itemdetails')->where('item_id', $item)->first();
                // Check if $itemInfo is not null before pushing it into $itemArray
                if ($itemInfo) {
                    $itemArray[] = $itemInfo;
                }
            }
        }
        // Create an instance of the OutlookEmail Mailable class
        $outlookEmail = new OutlookEmail($dataFromDatabase, $itemArray);

        // Send the email using the Mailable class
        Mail::to($email)->send($outlookEmail);
    }

    public function sendEmail2($id, $email)
    {
        $dataFromDatabase = DB::table('t_custodian')->where('custodian_id', $id)->first();
        $itemArray = array();
        if ($dataFromDatabase) {
            $items = $dataFromDatabase->items;
            $items = json_decode($items, true);
            foreach ($items as $item) {

                $itemInfo = DB::table('t_itemdetails')->where('item_id', $item)->first();
                // Check if $itemInfo is not null before pushing it into $itemArray
                if ($itemInfo) {
                    $itemArray[] = $itemInfo;
                }
            }
        }
        // Create an instance of the OutlookEmail Mailable class
        $outlookEmail = new ReturnCustodian($dataFromDatabase, $itemArray);

        // Send the email using the Mailable class
        Mail::to($email)->send($outlookEmail);
    }
}
