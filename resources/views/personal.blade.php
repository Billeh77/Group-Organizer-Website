@extends('layouts.dash')

@section('content')

<div class="tab-pane container active" id="todolist" style="height:100%;">
                <div class="container-fluid row" style="visibility:hidden; height:150px;">
                </div>
                <h1 style="font-family: Arial, Helvetica, sans-serif; margin-top: 30px; margin-bottom: 25px;">Personal To Do List
                <span class="badge bg-danger">
                  {{ \Auth::user()->personalTasks->count() }}
              </span>
            </h1>
            
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
              
                <form method="post" action="{{ route('addTask') }}">
                  @method('POST')
                  @csrf
                <div class="input-group" style="margin-bottom: 25px;">
                    
                <button type="button" class="btn bg-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <span class="input-group-text bg-white" id="addtask">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            ::before
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                        </svg>
                    </span>
                    </button>
                    <input type="text" class="form-control" placeholder="Add Task" aria-label="Add Task" area-describedby="task" name="task">

                    <!-- Button trigger modal -->
                

                            <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Deadline</h1>
                                
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
                
<div id="taskContainer" style="height:520px; overflow-y:scroll;">
    @foreach (\Auth::user()->personaltasks as $task) 
        @if ($task->urgent)
        <div class="alert alert-danger alert-dismissible show">
            <div class="task-content">
                <p>
                    {{ $task->task }}
                </p>
                <div class="task-buttons">
                    <form method="post" action="{{ route('completeTask',[ 'id' => $task ]) }}">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/complete.jpeg') }}" alt="Complete" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="get" action="{{ route('inProgress', ['id' => $task ]) }}">
                        @csrf 
                        @method('GET')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/inProgress.webp') }}" alt="In Progress" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="post" action="{{ route('editTask') }}">
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
                      <br> In progress . . .
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
                    <form method="post" action="{{ route('completeTask',[ 'id' => $task ]) }}">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/complete.jpeg') }}" alt="Complete" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="get" action="{{ route('inProgress', ['id' => $task ]) }}">
                        @csrf 
                        @method('GET')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/inProgress.webp') }}" alt="In Progress" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="post" action="{{ route('editTask') }}">
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
                    In progress . . .
            </p>
        </div>
        @else
        <div class="alert alert-success alert-dismissible show">
            <div class="task-content">
                <p>
                    {{ $task->task }}
                </p>
                <div class="task-buttons">
                    <form method="post" action="{{ route('completeTask',[ 'id' => $task ]) }}">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/complete.jpeg') }}" alt="Complete" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="get" action="{{ route('inProgress', ['id' => $task ]) }}">
                        @csrf 
                        @method('GET')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/inProgress.webp') }}" alt="In Progress" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="post" action="{{ route('editTask') }}">
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

@endsection