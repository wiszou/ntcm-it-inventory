<!-- select.blade.php -->
<select data-te-select-init data-te-select-filter="true" name="item{{ $counter }}" id="item{{ $counter }}" class="shadow-sm w-full p-2.5 editable-input" required="">
    <option value="none" selected hidden>Select Item</option>
    @foreach ($details as $item)
        <option value="{{ $item->item_id }}"> {{ $item->serial_num }} - {{ $item->item_id }} - {{ $item->model }}</option>
    @endforeach
</select>