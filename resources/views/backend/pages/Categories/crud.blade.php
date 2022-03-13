{{--start add Modal--}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form  id="AddEmployeeForm" method="post" enctype="multipart/form-data">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> اضافة الفئة </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="alert alert-warning d-none" id="save_errorList"></ul>
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم </label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">image</label>
                    <input type="file" class="form-control" id="realimage" name="image" onChange=""/>
                    {{--  add image realtime  --}}
                    <div class="card" style="width: 18rem;">
                        <img src="" id="mainThmb"  >
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                <button type="submit" class="btn btn-primary">حفظ البينات </button>
            </div>
        </div>
    </form>
    </div>
</div>
{{--end add Modal--}}

{{-- start Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form  id="UpdateEmployForm" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit & Update</h5>

                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>

                </div>

                <div class="modal-body">

                    <ul id="update_msgList"></ul>

                    <input type="hidden" id="stud_id" name="id"/>

                    <div class="form-group mb-3">
                        <label for="">Full Name</label>
                        <input type="text" id="name_s" name="name" required class="form-control"/>
                    </div>
                    <div class="form-group mb-3">


                        <input type="hidden" id="old_image" name="old_image">
                        <input type="file" id="" name="image" class="form-control">

                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="container"> IMAGE</h5>
                            </div>
                            <img src="" id="image_s" name="image" class="card-img-top" alt="...">


                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_student">Update</button>
                </div>

            </div>
        </form>
    </div>
</div>
{{-- end Edit Modal --}}

{{--start delete Modal--}}
<div class="modal fade" id="DeleteexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form  id="AddEmployeeForm" method="delete" enctype="multipart/form-data">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>هل تريد حذف الفئة؟</h4>
                <input type="hidden" id="deleteimg_emp_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
                <button type="button" class="delete_employee_btn btn btn-primary">حذف الفئة </button>
            </div>
        </div>
    </form>
    </div>
</div>
{{--end delete Modal--}}
