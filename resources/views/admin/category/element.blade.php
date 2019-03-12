@include('flash_message.message')


<div class="form-group"><label class="col-lg-2 control-label">Name*</label>
    <div class="col-lg-10"><input value="{{ isset($category->name) ? $category->name:'' }}" required="required" name="name" type="text" class="form-control">
    </div>
</div>

<div class="form-group"><label class="col-lg-2 control-label">Description</label>
    <div class="col-lg-10"><textarea name="description" class="form-control" rows="5">{{ isset($category->description) ? $category->description:'' }}</textarea></div>
</div>

<div class="form-group"><label class="col-lg-2 control-label">Main Category</label>
    <div class="col-lg-5">
        <select class="form-control" name="parent_id">
            <option value="">primary</option>

            @foreach ($all_categories as $all_category)

                @if(isset($category->id))
                    @if($all_category->id != $category->id)
                        <option class="{{ $all_category->parent_id == null? "parent_category":'' }}"  {{ isset($category->parent_id)?(($all_category->id == $category->parent_id)?'selected':''):'' }} value="{{ $all_category->id }}">
                            {{ $all_category->name }}
                        </option>
                    @endif
                @else
                    <option {{ isset($category->parent_id)?(($all_category->id == $category->parent_id)?'selected':''):'' }} value="{{ $all_category->id }}">{{ $all_category->name }}</option>
                @endif

            @endforeach

        </select>
    </div>
    <div class="col-lg-5">
        <a data-toggle="modal" class="btn btn-primary" href="#modal-form">Form in simple modal box</a>
    </div>
</div>


<div class="form-group"><label class="col-lg-2 control-label">Image</label>
    <div class="col-lg-5">
        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
            <div class="form-control" data-trigger="fileinput">
                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                <span class="fileinput-filename"></span>
            </div>
            <span class="input-group-addon btn btn-default btn-file">
                <span class="fileinput-new">Select file</span>
                <span class="fileinput-exists">Change</span>
                <input onchange="showMyImage(this)" type="file" name="img"/>
            </span>
            <a onclick="removePreview()" href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
        </div>
    </div>
</div>


<div class="form-group"><label class="col-lg-2 control-label">Preview</label>
    <div class="col-sm-2">

        <?php
            if (isset($category->image)){
                $image_url = URL::to('admin/uploads/images/categories/'.$category->image);
            }else{
                $image_url = URL::to('admin/img/no-image.png');
            }
        ?>

        <img src="{{ $image_url }}" alt="Image" class="preview_image" id="img-preview">
    </div>
</div>

<div class="form-group"><label class="col-lg-2 control-label" for="status">Status</label>
    <div class="col-lg-10">
        <input {{ (isset($category->status) AND $category->status == 1) ? 'checked':'' }} name="status" value="1" type="checkbox" class="i-checks" id="status">
    </div>
</div>

<!-- The Modal -->
<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Select parent category</h5>

            </div>
            <div class="ibox-content">
                {{--Tree function--}}
                <?php
                function tree($main_category, $category_id){

                    if(count($main_category['childrens']) > 0 ){

                        echo "<li>".$main_category['name'].
                            "<ul>";
                        foreach($main_category['childrens'] as $main_category){
                            if ($main_category->id != $category_id){
                                tree($main_category, $category_id);
                            }
                        }
                        echo "</ul>
                                            </li>";

                    }else{
                        echo "<li data-jstree=\"'type':'html'}\">" .$main_category['name']."</li>";
                    }
                }
                ?>

                {{--Tree--}}
                <div id="jstree1">

                    @if (count($main_categories) > 0)
                        <ul>
                            @foreach ($main_categories as $main_category)
                                @if($main_category->id != $category->id)
                                    @php(tree($main_category, $category->id))
                                @endif
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    /*Show image preview*/
    function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var img=document.getElementById("img-preview");
            img.file = file;
            var reader = new FileReader();
            reader.onload = (function(aImg) {
                return function(e) {
                    aImg.src = e.target.result;
                };
            })(img);
            reader.readAsDataURL(file);
        }
    }

    /*Remove image preview*/
    function removePreview() {
        var img_preview = document.getElementById("img-preview");
        img_preview.src = "<?php echo $image_url ?>";
    }

</script>
