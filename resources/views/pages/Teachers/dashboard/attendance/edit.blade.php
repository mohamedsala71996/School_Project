{{-- <!-- Deleted inFormation Student -->
<div class="modal fade" id="edit_attendance{{$student->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">تعديل حضور
                   وغياب الطالب : {{$student->Name}}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form action="{{route('storeAttendance')}}" method="post">
                   @csrf
                   <input type="hidden" name='edit' value="edit">
                   <input type="hidden" name="id" value="{{$student->id}}">
                   <div  class="col">
                    <input type="radio" id="attendance" name="status" value="1" {{($student->Attendance()->first()->attendence_status==1)? "checked":""}}>
                    <label for="attendance"><span class="text-success">حضور</span></label>
                </div>
                <div  class="col">
                    <input type="radio" id="absence" name="status" value="0" {{($student->Attendance()->first()->attendence_status==0)? "checked":""}}>
                    <label for="absence"><span class="text-danger">غياب</span></label>
                </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary"
                               data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                       <button class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
</div> --}}