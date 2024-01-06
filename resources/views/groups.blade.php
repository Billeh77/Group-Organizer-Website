@extends('layouts.dash')

@section('content')


                <div class="container-fluid row" style="visibility:hidden; height:170px;">
                </div>
            <div class="container-fluid row">
                <div class="col-3 bg-success" style="height:700px; overflow-y: scroll;">
                
                <div class="row bg-black" style="margin-bottom:20px">
                                  <h2 style="font-size:200%; margin-top:25px; margin-left:20px; margin-bottom:20px; color:white;">Groups</h2>
                                </div>
<style>
.vertical-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.vertical-list li {
    float: left;
    clear: left; /* Clear the float to start a new row */
    margin-right: 20px; /* Adjust the margin as needed */
}
</style>

                                <div class="row">
                                  <ul class="vertical-list">
                                    @foreach($groups as $group) 
                                    <li><a class="rounded-pill" href="#g{{$group->id}}" role="button" style="font-weight: bolder; font-size:22px; margin-left:20px;" onclick="openGroup('g{{$group->id}}')">{{ $group->name }}</a><li>
                                    @endforeach
                                    <li><a class="rounded-pill" href="#g" role="button" style="font-weight: bolder; font-size:22px; margin-left:20px; margin-bottom:50px;"></a><li>
                                  <!--
                                  <li><a class="rounded-pill" href="#g" role="button" style="font-weight: bolder; font-size:22px; margin-left:20px; margin-top:20px;">Urgent Tasks</a><li>
                                  <li><a class="rounded-pill" href="#g" role="button" style="font-weight: bolder; font-size:22px; margin-left:20px; margin-bottom:50px;">Weekly Calendar</a><li>
                                    -->
                                    </ul>
                                </div>
                                
                </div>
                <div class="col-9">
                
                <div style="height:670px; margin-left:25px;">
                <div id="g2" style="display:block;" >
                    <h1 style="font-family: Arial, Helvetica, sans-serif; margin-top: 30px; margin-bottom:30px;">Pick a group to view</h1>
                    
                    </div>
                @foreach($groups as $group)

                
                    <div id="g{{ $group->id }}" style="display:none;">

                    @if(session()->has('messageDelete'))
              <section class="popup">
                <div class="popup-inner">
                  <div class="popup-content">
                    <div class="content text-center">
                      <p class="text-success">{{ session('messageDelete') }}</p>
                    </div>
                  </div>
                </div>
              </section>
            @endif

            @if(session()->has('messageAdd'))
              <section class="popup">
                <div class="popup-inner">
                  <div class="popup-content">
                    <div class="content text-center">
                      <p class="text-success">{{ session('messageAdd') }}</p>
                    </div>
                  </div>
                </div>
              </section>
            @endif
              
                    
                    @if($group->user_id == \Auth::user()->id)
                    <div style="float:right; margin-right:15px;">
                    <form method="post" action="{{ route('editGroupTask') }}">
                        @csrf 
                        @method('POST')
                        <button type="button" class="btn rounded-circle" data-bs-toggle="modal" data-bs-target="#staticBackdropge{{$group->id}}"><img src="{{ asset('images/edit.png') }}" alt="Edit" style="width: 26px;" class="rounded-circle"></button>

                        <div class="modal fade" id="staticBackdropge{{$group->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelge{{$group->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabelge{{$group->id}}">Edit Group</h1>
                                
                            </div>
                        <div class="modal-body">
                            <br>

                            <input type="text" name="personalTaskId" value="{{$group->id}}" style="display:none;">
                            <h5>Modify Task:</h5>
                                <input type="text" name="edittask" class="form-control me-3 ms-1" value="{{$group->name}}">
                                <br>
                                <br>
                            <h5>Modify Deadline</h5>
                                
                                    <label for="dateInput">Select a Date:</label>
                                    <input type="date" id="dateInput" name="dateInput">
    
                                
                                    <label for="timeInput">Select a Time:</label>
                                    <input type="time" id="timeInput" name="timeInput">
                                    <br>
                                    <br>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                    </div>
                </div>

                    </form>
</div>
@endif
<div style="float:right; margin-right:15px;">
                    <form method="post" action="{{ route('editGroupTask') }}">
                        @csrf 
                        @method('POST')
                        <button type="button" class="btn rounded-circle" data-bs-toggle="modal" data-bs-target="#staticBackdropgv{{$group->id}}"><img src="{{ asset('images/view.png') }}" alt="Edit" style="width: 40px; transform: scale(1.9);" class="rounded-circle"></button>

                        <div class="modal fade" id="staticBackdropgv{{$group->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelgv{{$group->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabelgv{{$group->id}}">View Group</h1>
                                
                            </div>
                        <div class="modal-body">
                            <br>

                            <input type="text" name="personalTaskId" value="{{$group->id}}" style="display:none;">
                            <h5>Modify Task:</h5>
                                <input type="text" name="edittask" class="form-control me-3 ms-1" value="{{$group->name}}">
                                <br>
                                <br>
                            <h5>Modify Deadline</h5>
                                
                                    <label for="dateInput">Select a Date:</label>
                                    <input type="date" id="dateInput" name="dateInput">
    
                                
                                    <label for="timeInput">Select a Time:</label>
                                    <input type="time" id="timeInput" name="timeInput">
                                    <br>
                                    <br>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                    </div>
                </div>

                    </form>
</div>
<h1 style="font-family: Arial, Helvetica, sans-serif; margin-top: 30px;">{{ $group->name }}</h1>
                    <h4 style="font-family: Arial, Helvetica, sans-serif; margin-bottom:30px;">{{ $group->description }}</h4>
                    <form method="post" action="{{ route('addGroupTask') }}">
                  @method('POST')
                  @csrf
                <div class="input-group" style="margin-bottom: 25px;">
                    
                <button type="button" class="btn bg-success" data-bs-toggle="modal" data-bs-target="#staticBackdropg{{$group->id}}">
                    <span class="input-group-text bg-white" id="addtask">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            ::before
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                        </svg>
                    </span>
                    </button>
                    <input type="text" class="form-control rounded" placeholder="Add Task" aria-label="Add Task" area-describedby="task" name="task">
                    <input type="text" class="form-control rounded" name="groupId" value="{{ $group->id }}" style="display:none;">

                    <!-- Button trigger modal -->
                

                            <!-- Modal -->
                <div class="modal fade" id="staticBackdropg{{$group->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelg{{$group->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabelg{{$group->id}}">Add Deadline</h1>
                                
                            </div>
                        <div class="modal-body">
                                
                                    <p class="text-success">Tasks are more likely to be completed if you have a deadline!</p>
                                
                                    <label for="dateInput">Select a Date:</label>
                                    <input type="date" id="dateInput" name="dateInput">
    
                                
                                    <label for="timeInput">Select a Time:</label>
                                    <input type="time" id="timeInput" name="timeInput">
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </div>
                    </div>
                </div>

                </div>
                </form>

<div id="taskContainer" style="height:470px; overflow-y:scroll;">
    @foreach ($group->grouptasks as $task) 
        @if ($task->urgent)
        <div class="alert alert-danger alert-dismissible show">
            <div class="task-content">
                <p>
                    {{ $task->task }}
                </p>
                <div class="task-buttons">
                    <form method="post" action="{{ route('completeGroupTask',[ 'id' => $task ]) }}">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/complete.jpeg') }}" alt="Complete" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="get" action="{{ route('inProgressGroup', ['id' => $task]) }}">
                        @csrf 
                        @method('GET')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/inProgress.webp') }}" alt="In Progress" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="post" action="{{ route('editGroupTask') }}">
                        @csrf 
                        @method('POST')
                        <button type="button" class="btn rounded-circle" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$task->id}}"><img src="{{ asset('images/edit.png') }}" alt="Edit" style="width: 26px;" class="rounded-circle"></button>

                        <div class="modal fade" id="staticBackdrop{{$task->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{$task->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel{{$task->id}}">Edit</h1>
                                
                            </div>
                        <div class="modal-body">
                            <br>

                            <input type="text" name="personalTaskId" value="{{$task->id}}" style="display:none;">
                            <h5>Modify Task:</h5>
                                <input type="text" name="edittask" class="form-control me-3 ms-1" value="{{$task->task}}">
                                <br>
                                <br>
                            <h5>Modify Deadline</h5>
                                
                                    <label for="dateInput">Select a Date:</label>
                                    <input type="date" id="dateInput" name="dateInput">
    
                                
                                    <label for="timeInput">Select a Time:</label>
                                    <input type="time" id="timeInput" name="timeInput">
                                    <br>
                                    <br>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                    </div>
                </div>

                    </form>
                </div>
            </div>
            <p style="font-weight:bold; font-size:13px; margin-bottom:0;">Deadline: {{$task->deadline}}
                      @if ($task->inProgress)
                      <br> In progress by {{$task->userName}}
                      @endif
            </p>
        </div>
        @elseif ($task->inProgress)
        <div class="alert alert-warning alert-dismissible show">
            <div class="task-content">
                <p>
                    {{ $task->task }}
                </p>
                <div class="task-buttons">
                    <form method="post" action="{{ route('completeGroupTask',[ 'id' => $task ]) }}">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/complete.jpeg') }}" alt="Complete" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="get" action="{{ route('inProgressGroup', ['id' => $task ]) }}">
                        @csrf 
                        @method('GET')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/inProgress.webp') }}" alt="In Progress" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="post" action="{{ route('editGroupTask') }}">
                        @csrf 
                        @method('POST')
                        <button type="button" class="btn rounded-circle" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$task->id}}"><img src="{{ asset('images/edit.png') }}" alt="Edit" style="width: 26px;" class="rounded-circle"></button>

                        <div class="modal fade" id="staticBackdrop{{$task->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{$task->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel{{$task->id}}">Edit</h1>
                                
                            </div>
                        <div class="modal-body">
                            <br>

                            <input type="text" name="personalTaskId" value="{{$task->id}}" style="display:none;">
                            <h5>Modify Task:</h5>
                                <input type="text" name="edittask" class="form-control me-3 ms-1" value="{{$task->task}}">
                                <br>
                                <br>
                            <h5>Modify Deadline</h5>
                                
                                    <label for="dateInput">Select a Date:</label>
                                    <input type="date" id="dateInput" name="dateInput">
    
                                
                                    <label for="timeInput">Select a Time:</label>
                                    <input type="time" id="timeInput" name="timeInput">
                                    <br>
                                    <br>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                    </div>
                </div>

                    </form>
                </div>
            </div>
            <p style="font-weight:bold; font-size:13px; margin-bottom:0;">@if ($task->deadline) Deadline: {{$task->deadline}} <br> @endif
                    In progress by {{ $task->userName }}
            </p>
        </div>
        @else
        <div class="alert alert-success alert-dismissible show">
            <div class="task-content">
                <p>
                    {{ $task->task }}
                </p>
                <div class="task-buttons">
                    <form method="post" action="{{ route('completeGroupTask',[ 'id' => $task ]) }}">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/complete.jpeg') }}" alt="Complete" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="get" action="{{ route('inProgressGroup', ['id' => $task ]) }}">
                        @csrf 
                        @method('GET')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/inProgress.webp') }}" alt="In Progress" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="post" action="{{ route('editGroupTask') }}">
                        @csrf 
                        @method('POST')
                        <button type="button" class="btn rounded-circle" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$task->id}}"><img src="{{ asset('images/edit.png') }}" alt="Edit" style="width: 26px;" class="rounded-circle"></button>

                        <div class="modal fade" id="staticBackdrop{{$task->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{$task->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel{{$task->id}}">Edit</h1>
                                
                            </div>
                        <div class="modal-body">
                            <br>

                            <input type="text" name="personalTaskId" value="{{$task->id}}" style="display:none;">
                            <h5>Modify Task:</h5>
                                <input type="text" name="edittask" class="form-control me-3 ms-1" value="{{$task->task}}">
                                <br>
                                <br>
                            <h5>Modify Deadline</h5>
                                
                                    <label for="dateInput">Select a Date:</label>
                                    <input type="date" id="dateInput" name="dateInput">
    
                                
                                    <label for="timeInput">Select a Time:</label>
                                    <input type="time" id="timeInput" name="timeInput">
                                    <br>
                                    <br>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                    </div>
                </div>

                    </form>
                </div>
            </div>
            <p style="font-weight:bold; font-size:13px; margin-bottom:0;">@if ($task->deadline) Deadline: {{$task->deadline}}@endif
            </p>
        </div>
        @endif
    @endforeach
</div>
                    </div>
                @endforeach
                    </div>

                </div>
        </div>



@endsection