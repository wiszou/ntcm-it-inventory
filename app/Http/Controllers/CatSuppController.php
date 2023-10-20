<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CatSuppController extends Controller
{
    public function addSupplier(Request $request)
    {
        $name = $request->input('supplier-name');
        $contact = $request->input('contact');
        $address = $request->input('address');
        // Check if a supplier with the same name already exists
        $existingSupplier = DB::table('m_supplier')
            ->where('name', $name)
            // ->where('deleted', false)
            ->first();

        if ($existingSupplier) {
            // A supplier with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'A similar Name already exists.']);
        }

        $id =  $this->generatesupplierID();
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());
        try {

            DB::table('m_supplier')->insert([
                'supplier_id' => $id,
                'name' => $name,
                'contact' => $contact,
                'address' => $address,
                'deleted' => "false",
                'user_created' => $user,
                'date_created' => $date,
            ]);

            $logController = new LogController();
            $logController->sendLog("Supplier " . $id . " Successfully added");
            return response()->json(['success' => true, 'message' => 'Supplier added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Can\'t add supplier']);
        }
    }


    public function generatesupplierID()
    {
        $rowCount = DB::table('m_supplier')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "ID-Supplier-" . $formattedRowCount;

        $existingSuppllier = DB::table('m_supplier')->where('supplier_id', $candidateId)->first();

        while ($existingSuppllier) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "ID-Supplier-" . $formattedRowCount;
            $existingSuppllier = DB::table('m_supplier')->where('supplier_id', $candidateId)->first();
        }

        return $candidateId;
    }

    public function addCategory(Request $request)
    {
        $name = $request->input('name');
        $stock = $request->input('stock');
        $consumable = $request->input('consumable');
        $specs = $request->input('specs');

        if ($specs == null) {
            $specs = "0";
        }

        if ($consumable == null) {
            $consumable = "0";
        }
        // Check if a category with the same name already exists
        $existingCategory = DB::table('m_category')
            ->where('category_name', $name)
            // ->where('deleted', false)
            ->first();

        if ($existingCategory) {
            // A category with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'Category name already exist.']);
        }

        $id =  $this->generateInventoryID($name);
        $categId = $this->generateCategoryID($name);
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());

        $categoryData = array(
            'inventory_id' => $id,
            'category_id' => $categId,
            'stock_req' => $stock,
            'quantity' => 0,
            'specs' => $specs,
            'consumable' => $consumable,
            'deleted' => "false",
            'category_name' => $name,
            'user_created' => $user,
            'date_created' => $date,
        );

        $categoryAddedSuccessfully = DB::table('m_category')->insert($categoryData);
        if ($categoryAddedSuccessfully) {
            $logController = new LogController();
            $logController->sendLog("Category " . $categId . " Succesfully added");
            return response()->json(['success' => true, 'message' => 'Category added successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Category addition failed.']);
        }
    }

    public function addBrand(Request $request)
    {
        $name = $request->input('name');
        // Check if a category with the same name already exists //d q
        $existingCategory = DB::table('m_brand')
            ->where('name', $name)
            // ->where('deleted', false)
            ->first();

        if ($existingCategory) {
            // A category with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'Similar brand name already exist']);
        }

        $brand_id = $this->generateBrandID($name);
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $date = $dateTimeController->getDateTime(new Request());

        $categoryData = array(
            'brand_id' => $brand_id,
            'name' => $name,
            'deleted' => "false",
            'user_created' => $user,
            'date_created' => $date,
        );

        try {
            DB::table('m_brand')->insert($categoryData);
            $logController = new LogController();
            $logController->sendLog("Brand " . $brand_id . " Succesfully added");
            return response()->json(['success' => true, 'message' => 'Brand added succesfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cant add brand']);
        }
    }

    public function generateInventoryID($name)
    {
        $rowCount = DB::table('m_category')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "IT-" . $name . "-" . $formattedRowCount;

        $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "IT-" . $name . "-" . $formattedRowCount;
            $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();
        }

        return $candidateId;
    }

    public function generateCategoryID($name)
    {
        $rowCount = DB::table('m_category')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "ID-Category-" . $formattedRowCount;

        $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "ID-Category-" . $formattedRowCount;
            $existingCategory = DB::table('m_category')->where('inventory_id', $candidateId)->first();
        }

        return $candidateId;
    }

    public function generateBrandID($name)
    {
        $rowCount = DB::table('m_category')->count();

        $rowCount++;
        $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
        $candidateId = "ID-Brand-" . $formattedRowCount;

        $existingCategory = DB::table('m_brand')->where('brand_id', $candidateId)->first();

        while ($existingCategory) {
            $rowCount++;
            $formattedRowCount = str_pad($rowCount, 4, '0', STR_PAD_LEFT);
            $candidateId = "ID-Brand-" . $formattedRowCount;
            $existingCategory = DB::table('m_brand')->where('brand_id', $candidateId)->first();
        }

        return $candidateId;
    }



    public function updateTable1()
    {

        $brands = DB::table('m_brand')->get();
        $categories = DB::table('m_category')->get();

        return view('brands', ['brands' => $brands, 'categories' => $categories]);
    }

    public function updateTable2()
    {

        $supplier = DB::table('m_supplier')->get();
        $category = DB::table('m_category')->get();

        return view('suppliers', ['suppliers' => $supplier, 'categories' => $category]);
    }

    public function updateCateg()
    {
        $category = DB::table('m_category')->get();

        return view('categories', ['category' => $category]);
    }

    public function updateCategoryDetail(Request $request)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $name =  $request->input('name');
        $stock =  $request->input('stock');
        $specs = $request->input('specx');
        $consumable = $request->input("quantity");
        $id = $request->input("id");
        if ($specs == null) {
            $specs = "0";
        }


        $existingSupplier = DB::table('m_category')
            ->where('category_name', $name)
            ->where('deleted', false)
            ->where('category_id', '!=', $id)
            ->first();

        if ($existingSupplier) {
            // A supplier with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'A similar Name already exists.']);
        }


        $data = array(
            'category_name' => $name,
            'stock_req' => $stock,
            'specs' => $specs,
            'consumable' => $consumable,
            'user_change' => $user,
            'date_change' => $currentDate,
        );

        try {
            DB::table('m_category')->where('category_id', $id)->update($data);
            $logController = new LogController();
            $logController->sendLog("Category " . $id . " Succesfully updated");
            return response()->json(['success' => true, 'message' => 'Category updated succesfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cant update category']);
        }
    }

    public function updateBrandDetail(Request $request)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $name = $request->input('nameBrand');
        $categories = $request->input('category');
        $id = $request->input('idValue');

        $existingSupplier = DB::table('m_brand')
            ->where('name', $name)
            ->where('deleted', false)
            ->where('brand_id', '!=', $id)
            ->first();

        if ($existingSupplier) {
            // A supplier with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'A similar Name already exists.']);
        }
        $data = array(
            'name' => $name,
            'category_list' => json_encode(array_values($categories)),
            'user_change' => $user,
            'date_change' => $currentDate,
        );

        try {
            DB::table('m_brand')->where('brand_id', $id)->update($data);
            $logController = new LogController();
            $logController->sendLog("Brand " . $id . " Succesfully updated");
            return response()->json(['success' => true, 'message' => 'Brand updated succesfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cant update brand']);
        }
    }



    public function updateAdd()
    {
        $supplier = DB::table('m_supplier')->get();
        $category = DB::table('m_category')->get();
        $brand = DB::table('m_brand')->get();

        return view('newitem', ['categories' => $category, 'suppliers' => $supplier, 'brand' => $brand]);
    }


    public function removeCategory($itemCode)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        try {
            $data = array(
                'deleted' => "true",
                'user_change' => $user,
                'date_change' => $currentDate,
            );
            DB::table('m_category')->where('category_id', $itemCode)->update($data);
            $logController = new LogController();
            $logController->sendLog("Category " . $itemCode . " Succesfully Deleted");
            return response()->json(['success' => true, 'message' => 'Category removed succesfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cant remove item']);
        }
    }

    public function removeSupplier($itemCode)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        try {
            $data = array(
                'deleted' => "true",
                'user_change' => $user,
                'date_change' => $currentDate,
            );
            DB::table('m_supplier')->where('supplier_id', $itemCode)->update($data);
            $logController = new LogController();
            $logController->sendLog("Supplier " . $itemCode . " Succesfully Deleted");
            return response()->json(['success' => true, 'message' => 'Item removed succesfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cant remove item']);
        }
    }

    public function removeEmployee($id)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        try {
            $data = array(
                'deleted' => "true",
                'user_change' => $user,
                'date_change' => $currentDate,
            );
            DB::table('m_employee')->where('employee_id', $id)->update($data);
            $logController = new LogController();
            $logController->sendLog("Employee " . $id . " Succesfully Deleted");
            return response()->json(['success' => true, 'message' => 'Employee removed succesfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cant remove Employee']);
        }
    }

    public function removeBrand($itemCode)
    {
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        try {
            $data = array(
                'deleted' => "true",
                'user_change' => $user,
                'date_change' => $currentDate,
            );
            DB::table('m_brand')->where('brand_id', $itemCode)->update($data);
            $logController = new LogController();
            $logController->sendLog("Brand " . $itemCode . " Succesfully Deleted");
            return response()->json(['success' => true, 'message' => 'Item removed succesfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cant remove item']);
        }
    }


    public function checkBrand($categoryID)
    {

        $brandIds = DB::table('t_inventory')
            ->where('category_id', $categoryID)
            ->pluck('brand_id');

        $brands = DB::table('m_brand')
            ->whereIn('brand_id', $brandIds)
            ->get();

        return view('itemheader', ['brands' => $brands, 'category_id' => $categoryID]);
    }


    public function supplierToCategory(Request $request)
    {
        $supplier = $request->input('supplier');
        $categories = $request->input('categories');
        $categoryArray = array();
        $firstIteration = true;
        $supplierName = $request->input('name');
        $contact = $request->input('contact');
        $address = $request->input('address');
        $user = session()->get('user_name');
        $dateTimeController = new DateTimeController();
        $currentDate = $dateTimeController->getDateTime(new Request());
        $existingSupplier = DB::table('m_supplier')
            ->where('name', $supplierName)
            ->where('deleted', false)
            ->where('supplier_id', '!=', $supplier)
            ->first();

        if ($existingSupplier) {
            // A supplier with the same name already exists, handle accordingly (e.g., show an error message).
            return response()->json(['success' => false, 'message' => 'A similar Name already exists.']);
        }


        $data = array(
            'name' => $supplierName,
            'contact' => $contact,
            'address' => $address,
            'user_change' => $user,
            'date_change' => $currentDate,

        );
        DB::table('m_supplier')->where('supplier_id', $supplier)->update($data);
        try {
            // Fetch all categories from the database
            $allCategories = DB::table('m_category')->get();

            foreach ($allCategories as $category) {
                $categoryId = $category->category_id;

                if (!in_array($categoryId, $categories)) {
                    // Category is not in the $categories array, so we remove the supplier
                    $supplierList = json_decode($category->supplier_list, true) ?? [];

                    if (in_array($supplier, $supplierList)) {
                        // Supplier exists in the list, so remove it
                        $supplierList = array_diff($supplierList, [$supplier]);

                        // Update the category's supplier_list
                        DB::table('m_category')->where('category_id', $categoryId)
                            ->update(['supplier_list' => json_encode(array_values($supplierList))]);

                        $categoryArray[] = ['category_id' => $categoryId];
                    }
                }
            }

            foreach ($categories as $categoryId) {
                if (!$firstIteration) {
                    // Fetch the category details for the current categoryId
                    $category = DB::table('m_category')->where('category_id', $categoryId)->first();

                    if (!$category) {
                        return response()->json(['success' => false, 'message' => 'Category not found.']);
                    }

                    // Decode the supplier_list and check for duplicates
                    $supplierList = json_decode($category->supplier_list, true) ?? [];

                    if (!in_array($supplier, $supplierList)) {
                        // Supplier is not already in the list, so add it
                        $supplierList[] = $supplier;

                        // Update the category's supplier_list
                        DB::table('m_category')->where('category_id', $categoryId)
                            ->update(['supplier_list' => json_encode($supplierList)]);

                        $categoryArray[] = ['category_id' => $categoryId];
                    }
                } else {
                    $firstIteration = false;
                }
            }

            $logController = new LogController();
            $logController->sendLog("Brand " . $supplier . " Succesfully updated");

            return response()->json(['success' => true, 'message' => 'Supplier removed successfully', 'categoryArray' => $categoryArray]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again later.']);
        }
    }
    public function categoryToBrand(Request $request)
    {
        $supplier = $request->input('category');
        $brands = $request->input('brands');
        $brandArray = array();
        $firstIteration = true;

        try {
            // Fetch all brands from the database
            $allBrands = DB::table('m_brand')->get();

            if (!empty($brands)) {
                foreach ($allBrands as $brand) {
                    $brandId = $brand->brand_id;

                    if (!in_array($brandId, $brands)) {
                        // Brand is not in the $brands array, so we remove the supplier
                        $brandList = json_decode($brand->category_list, true) ?? [];

                        if (in_array($supplier, $brandList)) {
                            // Supplier exists in the list, so remove it
                            $brandList = array_diff($brandList, [$supplier]);

                            // Update the brand's brand_list
                            DB::table('m_brand')->where('brand_id', $brandId)
                                ->update(['category_list' => json_encode(array_values($brandList))]);

                            $brandArray[] = ['brand_id' => $brandId];
                        }
                    }
                }
            }

            if (!empty($brands)) {
                foreach ($brands as $brandId) {
                    if (!$firstIteration) {
                        // Fetch the brand details for the current brandId
                        $brand = DB::table('m_brand')->where('brand_id', $brandId)->first();

                        if (!$brand) {
                            return response()->json(['success' => false, 'message' => 'Brand not found.']);
                        }

                        // Decode the brand_list and check for duplicates
                        $brandList = json_decode($brand->category_list, true) ?? [];

                        if (!in_array($supplier, $brandList)) {
                            // Supplier is not already in the list, so add it
                            $brandList[] = $supplier;

                            // Update the brand's brand_list
                            DB::table('m_brand')->where('brand_id', $brandId)
                                ->update(['category_list' => json_encode($brandList)]);

                            $brandArray[] = ['brand_id' => $brandId];
                        }
                    } else {
                        $firstIteration = false;
                    }
                }
            }

            return response()->json(['success' => true, 'message' => 'Supplier removed/added successfully', 'brandArray' => $brandArray]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again later.']);
        }
    }


    public function getBrandDetail($id)
    {
        $data = DB::table('m_brand')->where('brand_id', $id)->first();

        // Check if the data was found
        if ($data) {
            // Return the entire data object as JSON
            return response()->json($data);
        } else {
            // If the data was not found, return an error response or handle it as needed
            return response()->json(['error' => 'Brand not found'], 404);
        }
    }

    public function getCategoryDetail($id)
    {
        $data = DB::table('m_category')->where('category_id', $id)->first();

        // Check if the data was found
        if ($data) {
            // Return the entire data object as JSON
            return response()->json($data);
        } else {
            // If the data was not found, return an error response or handle it as needed
            return response()->json(['error' => 'Category not found'], 404);
        }
    }

    public function getSupplierDetail($id)
    {
        $data = DB::table('m_supplier')->where('supplier_id', $id)->first();

        // Check if the data was found
        if ($data) {
            // Return the entire data object as JSON
            return response()->json($data);
        } else {
            // If the data was not found, return an error response or handle it as needed
            return response()->json(['error' => 'Supplier not found'], 404);
        }
    }

    public function employeePage()
    {
        $data = DB::table('m_employee')->get();

        return view('employee', ['employee' => $data]);
    }
}
