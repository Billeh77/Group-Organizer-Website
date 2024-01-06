@extends('layouts.dash')

@section('content')


                <div class="container-fluid row" style="visibility:hidden; height:170px;">
                </div>
            <div class="container-fluid row">
                <div class="col-3 bg-success">
                    
                                <div class="row bg-black">
                                  <h2 style="font-size:200%; margin-top:25px; margin-left:20px; margin-bottom:20px; color:white;">Notifications</h2>
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
                                  <li><a class="rounded-pill" href="#urgent" role="button" style="font-weight: bolder; font-size:140%; margin-left:20px; margin-top:20px;">Urgent Tasks</a><li>
                                  <li><a class="rounded-pill" href="#invites" role="button" style="font-weight: bolder; font-size:140%; margin-left:20px">Invites</a><li>
                                  <li><a class="rounded-pill" href="#messages" role="button" style="font-weight: bolder; font-size:140%; margin-left:20px">Messages</a><li>
                                  <li><a class="rounded-pill" href="#calendar" role="button" style="font-weight: bolder; font-size:140%; margin-left:20px">Weekly Calendar</a><li>
                                    </ul>
                                </div>
                                
                </div>
                <div class="col-9">
                    <div style="height:700px; overflow-x: scroll; margin-left:25px;">
                    <div id="urgent">
                    <h1 style="font-family: Arial, Helvetica, sans-serif; margin-top: 30px; margin-bottom:30px;">Urgent Tasks</h1>
                    @if($urgentTasks->isEmpty())
                    <div class="alert alert-success alert-dismissible show">
            <div class="task-content">
                <p>
                    You have no urgent tasks!
                </p>
            </div>
        </div>
                    @endif
                    @foreach($urgentTasks as $task)
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
            <p style="font-weight:bold; font-size:13px; margin-bottom:0;">From personal tasks<br> Deadline: {{$task->deadline}}
                      @if ($task->inProgress)
                      <br> In progress . . .
                      @endif
            </p>
        </div>
                    @endforeach
                    @foreach($urgentGroupTasks as $task)
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
                    <form method="get" action="{{ route('inProgressGroup', ['id' => $task ]) }}">
                        @csrf 
                        @method('GET')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/inProgress.webp') }}" alt="In Progress" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                    <form method="post" action="{{ route('editGroupTask') }}">
                        @csrf 
                        @method('POST')
                        <button type="button" class="btn rounded-circle" data-bs-toggle="modal" data-bs-target="#staticBackdropug{{$task->id}}"><img src="{{ asset('images/edit.png') }}" alt="Edit" style="width: 26px;" class="rounded-circle"></button>

                        <div class="modal fade" id="staticBackdropug{{$task->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelug{{$task->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabelug{{$task->id}}">Edit</h1>
                                
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
            <p style="font-weight:bold; font-size:13px; margin-bottom:0;">
    From group tasks
    <br> Deadline: {{$task->deadline}}
                      @if ($task->inProgress)
                      <br> In progress by {{ $task->userName }}
                      @endif
            </p>
        </div>
                    @endforeach
                    </div>
                    <div id="invites">
                    <h1 style="font-family: Arial, Helvetica, sans-serif; margin-top: 30px; margin-bottom:30px;">Invites</h1>
                    @if($invites->isEmpty())
                    <div class="alert alert-light alert-dismissible show">
            <div class="task-content">
                <p>
                    You have no new invites :(
                </p>
            </div>
        </div>
                    @endif
                    @foreach($invites as $invite)
                    <div class="alert alert-light alert-dismissible show">
            <div class="task-content">
                <p>
                    {{ $invite->note }}
                </p>
                <div class="task-buttons">
                    <form method="get" action="{{ route('acceptInvite', ['id' => $invite]) }}">
                        @csrf 
                        @method('GET')
                        <button type="submit" class="btn rounded-circle"><img src="{{ asset('images/complete.jpeg') }}" alt="Accept" style="width: 25px;" class="rounded-circle"></button>
                    </form>
                </div>
            </div>
        </div>
                    @endforeach
                    </div>
                    <div id="messages">
                    <h1 style="font-family: Arial, Helvetica, sans-serif; margin-top: 30px; margin-bottom:30px;">Messages</h1>
                    <p style="text-indent:40px;">
                            A home page is the default or front page of a site. 
                        It is the first page that visitors see when they load a URL.
                        Web managers can control the home page as a way of directing 
                        the user experience.
                    </p>
                    <p style="text-indent:40px;">
                            Home pages are located in the root directory of the website. 
                        Many home pages act as a virtual directory for a site — they 
                        provide top-level menus where visitors can go deeper into various 
                        areas of the site. For instance, a typical website has a homepage 
                        with menu items like “about,” “contact,” “products,” “services,” 
                        “press” or “news.”
                    </p>
                    <p style="text-indent:40px;">
                            In addition, the home page often serves to orient visitors by 
                        providing titles, headlines and images and visuals that show what 
                        the website is about, and in some cases, who owns it and maintains 
                        it. One of the best examples is the average business website, 
                        which has the business name in a prominent place, and often features 
                        the logo, while also showing pictures related to that business, for 
                        instance, who works there, what the business produces, or what it 
                        does in a community.
                    </p>
                    </div>
                    <div id="calendar">
                    <h1 style="font-family: Arial, Helvetica, sans-serif; margin-top: 30px; margin-bottom:30px;">Weekly Calendar</h1>
                    <p style="text-indent:40px;">
                            A home page is the default or front page of a site. 
                        It is the first page that visitors see when they load a URL.
                        Web managers can control the home page as a way of directing 
                        the user experience.
                    </p>
                    <p style="text-indent:40px;">
                            Home pages are located in the root directory of the website. 
                        Many home pages act as a virtual directory for a site — they 
                        provide top-level menus where visitors can go deeper into various 
                        areas of the site. For instance, a typical website has a homepage 
                        with menu items like “about,” “contact,” “products,” “services,” 
                        “press” or “news.”
                    </p>
                    <p style="text-indent:40px;">
                            In addition, the home page often serves to orient visitors by 
                        providing titles, headlines and images and visuals that show what 
                        the website is about, and in some cases, who owns it and maintains 
                        it. One of the best examples is the average business website, 
                        which has the business name in a prominent place, and often features 
                        the logo, while also showing pictures related to that business, for 
                        instance, who works there, what the business produces, or what it 
                        does in a community.
                    </p>
                    </div>
                    </div>
                </div>
            </div>

@endsection