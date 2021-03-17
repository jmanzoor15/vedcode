@extends('welcome')
@section('content')
<div class="container">
<div class="row">
 <div class="col-md-12">

 <form>
  <div class="mb-3">
    <label for="userName" class="form-label">User Name</label>
    <input type="text" class="form-control" id="userName">
  </div>
  <select class="form-select mb-3" id="userDepartment" aria-label="Default select example">
  <option selected disabled>User Department</option>
  <option value="active">Active</option>
  <option value="Inactive">Inactive</option>
</select>
  <button type="button" onclick="saveUser()" class="btn btn-primary">Save User</button>
</form>

 </div>
</div>

<div class="row">
    <div class="col-md-12">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">User Name</th>
      <th scope="col">User Department</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="tbody">
    
                                    
  </tbody>
</table>
    
    </div>
</div>



</div>
<script>
    window.onload = function(){
        const getUsers = () => {
        $.ajax({
        url: "{{url('getdepartment')}}",
        type: "get",
        dataType: "JSON",
        success: function(response){
            let data=response.data;
            let body="";
            // data.each(function(item){
                for(i=0;i<data.length;i++){
                body+=`<tr><td>${data[i].DepartmentName}</td>
                <td>${data[i].DepartmentStatus}</td>
                <td>
                    <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item"  href="{{url('department/edit/${data[i].id}')}}">Edit</a></li>
                        <li><a class="dropdown-item" id="{{'${data[i].id}'}}" onclick="deleteDepartment(this)">Delete</a></li>
                    </ul>
                    </div>
                        
                </td></tr>
                `
                }
                $("#tbody").append(body);
               
            // })
        }
    });
        }
        getUsers();
    }; 

    
    
    

    

 const saveUser = () => {
     let name=$('#departmentName').val();
     let status=$('#departmentStatus').val();
     $.ajax({
        url: "{{url('adddepartment')}}",
        type: "POST",
        data: {_token:"{{ csrf_token()}}",DepartmentName :name ,DepartmentStatus:status},
        dataType: "JSON",
        success: function(response){
            let data=response.data;
            let body="";
            for(i=0;i<data.length;i++){
                body+=`<tr><td>${data[i].DepartmentName}</td>
                <td>${data[i].DepartmentStatus}</td>
                <td>
                    <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{url('department/edit/${data[i].id}')}}">Edit</a></li>
                        <li><a class="dropdown-item" id="{{'${data[i].id}'}}" onclick="deleteDepartment(this)">Delete</a></li>
                    </ul>
                    </div>
                        
                </td></tr>
                `
                }
                $("#tbody").append(body);
        }
    });
 }


 const deleteUser = (_this) => {
     let id=$(_this).attr('id');
     $.ajax({
        url: "{{url('deletedepartment','id')}}".replace('id',id),
        type: "delete",
        data: {_token:"{{ csrf_token()}}"},
        dataType: "JSON",
        success: function(response){
            $(_this).closest('tr').remove();
        }
    });
 }

</script>
@endsection