@include('flash_message.message')

<div class="form-group"><label class="col-lg-2 control-label">Name*</label>
    <div class="col-lg-10">
        <input value="{{ isset($brand->name) ? $brand->name:'' }}" required="required" name="name" type="text" class="form-control">
    </div>
</div>

<div class="form-group"><label class="col-lg-2 control-label">Description</label>
    <div class="col-lg-10">
        <textarea name="description" class="form-control" rows="5">{{ isset($brand->description) ? $brand->description:'' }}</textarea>
    </div>
</div>

<div class="form-group"><label class="col-lg-2 control-label" for="status">Status</label>
    <div class="col-lg-10">
        <input {{ (isset($brand->status) AND $brand->status == 1) ? 'checked':'' }} name="status" value="1" type="checkbox" class="i-checks" id="status">
    </div>
</div>

