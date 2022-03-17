{{--start add Modal--}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form  id="AddEmployeeForm" method="post" enctype="multipart/form-data">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{__('backend/category.Add_category') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="alert alert-warning d-none" id="save_errorList"></ul>



                <div class="form-group">
                    <label for="exampleInputEmail1">اسم </label>
                    <input type="text" placeholder="ادخال الاسم باللغة العربيه" class="form-control" id="name_ar" name="name_ar">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">name </label>
                    <input type="text" class="form-control" placeholder="Enter the name in English" id="name_en" name="name_en">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">تاريخ </label>
                    <input type="text" placeholder="ادخال التاريخ باللغة العربيه" class="form-control" id="data_ar" name="data_ar">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">data </label>
                    <input type="text" class="form-control" placeholder="Enter the data in English" id="data_en" name="data_en">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">عملة </label>
                    <input type="text" placeholder="ادخال العملة باللغة العربيه" class="form-control" id="currency_ar" name="currency_ar">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">currency </label>
                    <input type="text" class="form-control" placeholder="Enter the currency in English" id="currency_en" name="currency_en">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">نوع  </label>
                    <input type="text" placeholder="ادخال النوع  باللغة العربيه" class="form-control" id="type_ar" name="type_ar">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">type </label>
                    <input type="text" class="form-control" placeholder="Enter the type in English" id="type_en" name="type_en">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">مقال  </label>
                    <input type="text" placeholder="ادخال المقال  باللغة العربيه" class="form-control" id="description_ar" name="description_ar">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">description </label>
                    <input type="text" class="form-control" placeholder="Enter the description in English" id="description_en" name="description_en">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">price </label>
                    <input type="text" class="form-control" placeholder="Enter the price in English" id="price_en" name="price_en">
                </div>




                <div class="row">
                    <div class="col-3">
                        <label>active</label>
                        <label class="switch">
                            <input type="checkbox" name="active" >
                            <span class="slider round"></span>
                        </label>

                    </div>
                </div>


            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary" id="open">{{__('backend/public.save') }} </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('backend/public.close') }}</button>
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
                    <h5 class="modal-title" id="editModalLabel">{{__('backend/category.title_name') }}</h5>

                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>

                </div>

                <div class="modal-body">

                    <ul id="update_msgList"></ul>

                    <input type="hidden" id="stud_id" name="id"/>

                    <div class="form-group mb-3">
                        <label for="">{{__('backend/public.Name_field') }}</label>
                        <input type="text" id="name_s" name="name" required class="form-control"/>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">fontAwesome</label>
                        <input type="text" id="fontAwesome_s" name="fontAwesome" required class="form-control"/>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <label>active</label>
                        <label class="switch">
                            <input type="checkbox"  id="active_s" name="active_ss" >
                            <span class="slider round"></span>
                        </label>

                    </div>
                </div>

                <div class="modal-footer">

                    @if(LaravelLocalization::getCurrentLocale()=='en')
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('backend/public.close') }}</button>
                        <button type="submit" class="btn btn-primary update_student">{{__('backend/public.save') }}</button>
                       @elseif (LaravelLocalization::getCurrentLocale()=='ar')
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('backend/public.close') }}</button>
                       <button type="submit" class="btn btn-primary update_student">{{__('backend/public.save') }}</button>
                    @endif
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
                <h5 class="modal-title" id="exampleModalLabel">{{__('backend/public.Delete') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>{{__('backend/category.question_delete') }}</h4>
                <input type="hidden" id="deleteimg_emp_id">
            </div>
            <div class="modal-footer">
                @if(LaravelLocalization::getCurrentLocale()=='en')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('backend/public.close') }}</button>
                <button type="button" class="delete_employee_btn btn btn-primary">{{__('backend/public.yes') }} </button>
                   @elseif (LaravelLocalization::getCurrentLocale()=='ar')
                   <button type="button" class="delete_employee_btn btn btn-primary">{{__('backend/public.yes') }} </button>
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('backend/public.close') }}</button>

                @endif

            </div>
        </div>
    </form>
    </div>
</div>
{{--end delete Modal--}}
