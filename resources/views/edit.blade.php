@extends('welcome')
@section('content')
<div class="container">
<div class="row">
 <div class="col-md-12">

 <form>
  <div class="mb-3">
    <label for="departmentName" class="form-label">Department Name</label>
    <input type="text" value="{{$data->DepartmentName}}" class="form-control" id="departmentName">
  </div>
  <select class="form-select mb-3" id="departmentStatus" aria-label="Default select example">
  <option  disabled>Department Status</option>
  <option value="active" <?php $data->DepartmentStatus=='active'?'selected':''?>>Active</option>
  <option value="Inactive" <?php $data->DepartmentStatus=='active'?'selected':''?>>Inactive</option>
</select>
  <input type="button" onclick="updateDepartment(this)" id="{{$data->id}}" value="Update" class="btn btn-primary">
</form>

 </div>
</div>
</div>



<script>
const updateDepartment = (_this) => {
     let name=$('#departmentName').val();
     let status=$('#departmentStatus').val();
     let id=$(_this).attr('id');
     $.ajax({
        url: "{{url('updatedepartment','id')}}".replace('id',id),
        type: "POST",
        data: {_token:"{{ csrf_token()}}",DepartmentName :name ,DepartmentStatus:status},
        dataType: "JSON",
        success: function(response){
           window.location="/departments"
        }
    });
}
</script>
@endsection