<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;
use View;

class InventoryController extends Controller
{
    public function addItem(Request $request)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $serialNum = $request->input('item-serial');
        $supplier_name = $request->input('supplier-name');
        $item_category = $request->input('category');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $price = $request->input('price');
        $cpu = $request->input('item-cpu');
        $gpu = $request->input('item-gpu');
        $ram = $request->input('item-ram');
        $storage = $request->input('item-storage');
        $acquired = $request->input('item-acquired');
        $expire = $request->input('item-expired');
        $item_status = $request->input('item-status');
        $remarks = $request->input('remarks');
        $multiple = $request->input('quantityCheck');
        $multipleStatus = 0;
        $itemName = $this->itemName($model, $brand);


        if ($brand === "none" || $supplier_name === "none" || $item_category === "none") {
            // At least one of the variables is equal to "none"
            // Do something here, like setting default values or performing an action
            if ($brand === "none") {
                return response()->json(['success' => false, 'message' => 'Please select an option in brand.']);
            }
            if ($supplier_name === "none") {
                return response()->json(['success' => false, 'message' => 'Please select an option in supplier.']);
            }
            if ($item_category === "none") {
                return response()->json(['success' => false, 'message' => 'Please select an option in category.']);
            }
        }

        if ($acquired == null) {
            $currentYear = date('Y-m-d');
            $acquired = $currentYear;
        }

        if ($multiple == null) {
            $multiple = 1;
        }


        $categoryStatus = DB::table('m_category')
            ->where('category_id', $item_category)->first();

        if ($categoryStatus->consumable === "1" || $serialNum == null) {
            $serialNum = "N/A";
            $multipleStatus = 1;
        } else {
            $existingRecord = DB::table('t_itemdetails')
                ->where('serial_num', $serialNum)
                ->where('deleted', "false")
                ->first();

            if ($existingRecord) {
                return response()->json(['success' => false, 'message' => 'A similar item or serial number already exists.']);
            }
        }



        if ($item_status === null) {
            $item_status = "Spare";
        }

        try {
            if ($multipleStatus === 1) {

                for ($i = 1; $i <= $multiple; $i++) {
                    $uniqueID = $this->generateItemCode();

                    $inventoryData = array(
                        'item_id' => $uniqueID,
                        'supplier_id' => $supplier_name,
                        'category_id' =>  $item_category,
                        'brand_id' => $brand,
                        'deleted' => "false",
                        'item_status' => $item_status,
                        'user_created' => $user,
                        'date_created' => $currentDate,
                    );

                    $detailsData = array(
                        'item_id' => $uniqueID,
                        'name' => $itemName,
                        'model' => $model,
                        'price' => $price,
                        'serial_num' => $serialNum,
                        'cpu' => $cpu,
                        'gpu' => $gpu,
                        'ram' => $ram,
                        'storage' => $storage,
                        'remarks' => $remarks,
                        'deleted' => "false",
                        'date_acquired' => $acquired,
                        'date_end' => $expire,
                        'user_created' => $user,
                        'date_created' => $currentDate,
                    );
                    DB::table('t_itemdetails')->insert($detailsData);
                    DB::table('t_inventory')->insert($inventoryData);
                    $this->addQuantity($item_category);
                    $logController = new LogController();
                    $logController->sendLog("Item " . $uniqueID . " Succesfully added");
                }
            } else {
                $uniqueID = $this->generateItemCode();
                $itemName = $this->itemName($model, $brand);

                $inventoryData = array(
                    'item_id' => $uniqueID,
                    'supplier_id' => $supplier_name,
                    'category_id' =>  $item_category,
                    'brand_id' => $brand,
                    'deleted' => "false",
                    'item_status' => $item_status,
                    'user_created' => $user,
                    'date_created' => $currentDate,
                );

                $detailsData = array(
                    'item_id' => $uniqueID,
                    'name' => $itemName,
                    'model' => $model,
                    'price' => $price,
                    'serial_num' => $serialNum,
                    'cpu' => $cpu,
                    'gpu' => $gpu,
                    'ram' => $ram,
                    'storage' => $storage,
                    'remarks' => $remarks,
                    'deleted' => "false",
                    'date_acquired' => $acquired,
                    'date_end' => $expire,
                    'user_created' => $user,
                    'date_created' => $currentDate,
                );
                DB::table('t_itemdetails')->insert($detailsData);
                DB::table('t_inventory')->insert($inventoryData);
                $this->addQuantity($item_category);
                $logController = new LogController();
                $logController->sendLog("Item " . $uniqueID . " Succesfully added");
            }
            return response()->json(['success' => true, 'message' => 'Item added successfully.']);
        } catch (\Exception $e) {
            // Log or report the actual error message
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while adding the item.']);
        }
    }

    public function itemName($model, $brandID)
    {
        $brandData = DB::table('m_brand')->where('brand_id', $brandID)->first();

        $brandName = "";
        if ($brandData) {
            $brandName = $brandData->name;
            // Access the 'name' column
        } else {
            // Handle the case where no record is found
            $brandName = null; // Or any other default value or error handling
        }

        $itemName = $brandName . " " . $model;
        return $itemName;
    }

    public function generateItemCode()
    {
        $currentYear = date('Y');
        $rowCount = DB::table('t_inventory')->count();
        $rowCount++;

        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);

        $id = "IT-" . $currentYear . "-" . $formattedRowCount;
        $existingItem = DB::table('t_inventory')->where('item_id', $id)->first();

        while ($existingItem) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $id = "IT-" . $currentYear . "-" . $formattedRowCount;
            $existingItem = DB::table('t_inventory')->where('item_id', $id)->first();
        }

        return $id;
    }

    public function getUpdatedInventory()
    {
        $category = DB::table('m_category')->get();
        return view('inventory', ['categories' => $category]);
    }

    public function getDashboard()
    {
        $currentDate = date('d-F-Y');
        $category = DB::table('m_category')->get();
        $inventory = DB::table('t_inventory')->get();
        $itemDetail = DB::table('t_itemdetails')->where("deleted", "false")->get();

        // Define an array to store items that meet the condition
        $filteredItemDetail = [];

        foreach ($itemDetail as $item) {
            $status = DB::table('t_inventory')->where('item_id', $item->item_id)->value("item_status");

            // Check if the status is neither "Missing" nor "Defective"
            if ($status !== "Missing" && $status !== "Defective") {
                $filteredItemDetail[] = $item;
            }
        }

        $logs = DB::table('m_logs')
            ->orderBy('date_added', 'desc')
            ->take(8)
            ->get();

        return view('dashboard', [
            'categories' => $category,
            'logs' => $logs,
            'inventory' => $inventory,
            'details' => $filteredItemDetail, // Use the filtered array
        ]);
    }

    public function getUpdatedEquipment()
    {
        $category = DB::table('m_category')->get();
        return view('equipment', ['categories' => $category]);
    }


    public function editItem($itemID)
    {
        $itemData = DB::table('t_inventory')->where("item_id", $itemID)->first();
        $itemSpecs = DB::table('t_itemdetails')->where("item_id", $itemID)->first();
        $brand = DB::table('m_brand')->get();
        $category = DB::table('m_category')->get();
        $supplier = DB::table('m_supplier')->get();
        return view('edititem', ['dataitem' => $itemData, 'suppliers' => $supplier, 'categories' => $category, 'brands' => $brand, 'specs' => $itemSpecs]);
    }
    public function getItemDetails($brandID, $categoryID)
    {

        try {
            // Fetch item details based on the $itemId and $category_id using the DB facade
            $items = DB::table('t_inventory')
                ->where('brand_id', $brandID)
                ->where('category_id', $categoryID)
                ->where('deleted', 'false')
                ->get(); // Get all matching items

            if ($items->isEmpty()) {
                // No items found, return a JSON response with an error message
                return response()->json(['success' => false, 'message' => 'Items not found'], 404);
            }


            foreach ($items as $item) {
                $item_id = $item->item_id;

                $data = DB::table('t_itemdetails')
                    ->where('item_id', $item_id)
                    ->first();

                if ($data) {
                    $item->serial_num = $data->serial_num;
                    $item->model = $data->model;
                }
            }

            // Return the item details as JSON response
            return response()->json(['success' => true, 'items' => $items]);
        } catch (\Exception $e) {
            // Handle exceptions and return an error JSON response
            return response()->json(['success' => false, 'message' => 'Error fetching item details'], 500);
        }
    }

    public function getItemSpecs($itemID)
    {
        $items = DB::table('t_itemdetails')
            ->where('item_id', $itemID)
            ->first(); // Get all matching items

        return response()->json(['success' => true, 'specs' => $items]);
    }



    public function updateTab(request $request)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $serialNum = $request->input('item-serial');
        $id = $request->input('id');
        $supplier_name = $request->input('supplier-name');
        $item_category = $request->input('item-category');
        $brand = $request->input('item-brand');
        $model = $request->input('item-model');
        $price = $request->input('item-price');
        $item_status = $request->input('item-status');
        $cpu = $request->input('item-cpu');
        $gpu = $request->input('item-gpu');
        $ram = $request->input('item-ram');
        $storage = $request->input('item-storage');
        $acquired = $request->input('item-acquired');
        $expire = $request->input('item-expired');
        $itemName = $this->itemName($model, $brand);


        if ($serialNum != "N/A") {


            $existingRecord = DB::table('t_itemdetails')
                ->where('serial_num', $serialNum)
                ->where('deleted', 'false')
                ->where('item_id', '!=', $id)
                ->first();

            if ($existingRecord) {
                return response()->json(['success' => false, 'message' => 'A similar item or serial number already exists.']);
            }
        }

        $inventoryData = array(
            'item_id' => $id,
            'supplier_id' => $supplier_name,
            'category_id' =>  $item_category,
            'brand_id' => $brand,
            'user_created' => $user,
            'item_status' => $item_status,
            'user_change' => $user,
            'date_change' => $currentDate,
        );

        $detailsData = array(
            'model' => $model,
            'name' => $itemName,
            'price' => $price,
            'serial_num' => $serialNum,
            'date_acquired' => $acquired,
            'date_end' => $expire,
            'cpu' => $cpu,
            'gpu' => $gpu,
            'ram' => $ram,
            'storage' => $storage,
            'user_change' => $user,
            'date_change' => $currentDate,
        );


        $success = DB::table('t_inventory')
            ->where('item_id', $id)
            ->limit(1)
            ->update($inventoryData);

        $success = DB::table('t_itemdetails')
            ->where('item_id', $id)
            ->limit(1)
            ->update($detailsData);

        if ($success) {
            $logController = new LogController();
            $logController->sendLog("Item " . $id . " Succesfully updated");
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    private function addQuantity($category)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $existingQuantity = DB::table('m_category')->where('category_id', $category)->value('quantity');
        $quantity = 1;
        $quantity = $quantity += $existingQuantity;

        $dataToUpdate = array(
            'quantity' => $quantity,
            'user_change' => $user,
            'date_change' => $currentDate,
        );

        DB::table('m_category')->where('category_id', $category)->update($dataToUpdate);
    }

    public function removeItem($removeID)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $category = DB::table('t_inventory')->where('item_id', $removeID)->value('category_id');
        $existingQuantity = DB::table('m_category')->where('category_id', $category)->value('quantity');
        $quantity = 1; // Initial quantity
        $quantity = $existingQuantity -= $quantity; // Update quantity based on subtraction

        $dataToUpdate = array(
            'quantity' => $quantity,
            'user_change' => $user,
            'date_change' => $currentDate,
        );

        $itemRemove = DB::table('t_inventory')->where('item_id', $removeID)->delete();

        if ($itemRemove) {
            DB::table('m_category')->where('category_id', $category)->update($dataToUpdate);
            DB::table('t_itemdetails')->where('item_id', $removeID)->delete();
            $logController = new LogController();
            $logController->sendLog("Item " . $removeID . " Succesfully removed");
            return response()->json(['success' => true, 'message' => 'Item removed successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Item addition failed.']);
        }
    }
}
