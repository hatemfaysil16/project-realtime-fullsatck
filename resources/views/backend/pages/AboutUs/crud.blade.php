{{--start add Modal--}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form  id="AddEmployeeForm" method="post" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{__('backend/aboutUs.Add_aboutUs') }} </h5>
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
                    <label for="exampleInputEmail1">وصف </label>
                    <textarea placeholder="ادخال وصف باللغة العربيه" class="form-control" id="exampleFormControlTextarea1" rows="15" name="description_ar"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">description </label>
                    <textarea placeholder="Enter a description in English" class="form-control" id="exampleFormControlTextarea2" rows="15" name="description_en"></textarea>
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">وصف كامل</label>
                    <textarea placeholder="ادخال وصف كامل باللغة العربيه" class="form-control" id="exampleFormControlTextarea1" rows="15" name="fullDescription_ar"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">fullDescription </label>
                    <textarea placeholder="Enter a fullDescription in English" class="form-control" id="exampleFormControlTextarea2" rows="15" name="fullDescription_en"></textarea>
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
        <form  id="UpdateEmployForm" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{__('backend/aboutUs.Add_aboutUs') }}</h5>

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
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('backend/public.description') }} </label>
                        <textarea placeholder="{{__('backend/public.placeholder') }}" class="form-control" id="description_s" rows="15" name="description"></textarea>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('backend/public.description') }} </label>
                        <textarea placeholder="{{__('backend/public.placeholder') }}" class="form-control" id="fullDescription_s" rows="15" name="fullDescription"></textarea>
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
    <form  id="AddEmployeeForm" method="delete" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('backend/public.Delete') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <input type="hidden" id="deleteimg_emp_id">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>{{__('backend/aboutUs.question_delete') }}</h4>
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
