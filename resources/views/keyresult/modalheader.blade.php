<div class="row positionrelative">
    <div class="col-md-12">
        <h5 class="modal-title newmodaltittle marginleftthirty" id="create-epic">
            <img src="{{ url('public/assets/svg/keyresult.svg') }}">{{ $data->key_name }}
        </h5>
    </div>
    <div class="col-md-12 marginleftthirty newmodalsubtittle">
        <p>Organization/Business Unit/Value Stream/Portfolio</p>    
    </div>
    <div class="col-md-12 displayflex">
        <div class="btn-group epicheaderborderleft">
            <button type="button" class="btn btn-default statuschangebutton @if($data->key_status == 'To Do') todo-button-color @endif @if($data->key_status == 'In progress') inprogress-button-color @endif @if($data->key_status == 'Done') done-button-color @endif" id="showboardbutton">
                @if($data->key_status == 'To Do')
                    To Do
                @endif
                @if($data->key_status == 'In progress')
                    In Progress
                @endif
                @if($data->key_status == 'Done')
                    Done
                @endif
            </button>
            <button type="button" class="@if($data->key_status == 'To Do') todo-button-color @endif @if($data->key_status == 'In progress') inprogress-button-color @endif @if($data->key_status == 'Done') done-button-color @endif statuschangebuttonarrow btn btn-danger dropdown-toggle dropdown-toggle-split archivebeardcimbgbutton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if($data->key_status == 'To Do') 
                <img src="{{url('public/assets/images/icons/angle-down.svg')}}" width="20">
                @endif 
                @if($data->key_status == 'In progress') 
                <img src="{{url('public/assets/svg/arrow-down-white.svg')}}" width="20">
                @endif 
                @if($data->key_status == 'Done') 
                <img src="{{url('public/assets/svg/arrow-down-white.svg')}}" width="20">
                @endif          
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                @if($data->key_status == 'To Do')
                    <a class="dropdown-item" onclick="changeflagstatus('In progress',{{$data->id}})" href="javascript:void(0)">In Progress</a>
                    <a class="dropdown-item" onclick="changeflagstatus('Done',{{$data->id}})" href="javascript:void(0)">Done</a>
                @endif
                @if($data->key_status == 'In progress')
                    <a class="dropdown-item" onclick="changeflagstatus('To Do',{{$data->id}})" href="javascript:void(0)">To Do</a>
                    <a class="dropdown-item" onclick="changeflagstatus('Done',{{$data->id}})" href="javascript:void(0)">Done</a>
                @endif
                @if($data->key_status == 'Done')
                    <a class="dropdown-item" onclick="changeflagstatus('To Do',{{$data->id}})" href="javascript:void(0)">To Do</a>
                    <a class="dropdown-item" onclick="changeflagstatus('In progress',{{$data->id}})" href="javascript:void(0)">In Progress</a>
                @endif
            </div>
        </div>
        <div class="epic-header-buttons raise-flag-button">
            <a onclick="rasiseflag({{$data->id}})" href="javascript:void(0)"  id="showboardbutton">
                <img src="{{url('public/assets/svg/btnflagsvg.svg')}}" width="20"> Raise Flag @if(DB::table('flags')->where('epic_id'  ,$data->id)->count() > 0) ({{ DB::table('flags')->where('epic_id'  ,$data->id)->count() }}) @endif
            </a>
            <div class="raiseflag-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Raise Flag</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <img onclick="rasiseflag()" class="memberclose" src="{{url('public/assets/svg/memberclose.svg')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form class="needs-validation" action="#" method="POST" novalidate>
                            @csrf
                            <input type="hidden" value="{{ $data->id }}" id="flag_epic_id">
                            <input type="hidden" value="{{ $data->initiative_id }}" id="flag_ini_epic_id">
                            <input type="hidden" value="{{ $data->obj_id }}" id="flag_epic_obj">
                            <input type="hidden" value="{{ $data->key_id }}" id="flag_epic_key">
                            <input type="hidden" value="{{ $data->buisness_unit_id }}" id="buisness_unit_id">
                            <input type="hidden" value="{{ $data->epic_type }}" id="board_type">
                            <input type="hidden" value="{{ $data->epic_status }}" id="epic_status">
                            <div class="row">        
                                  <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group mb-0">
                                        <label for="small-description">Flag Type <small class="text-danger">*</small></label>
                                       <select class="form-control" id="flag_type" >
                                           <option value="">Select Flag Type</option>
                                           <option value="Risk">Risk</option>
                                           <option value="Impediment">Impediment</option>
                                           <option value="Blocker">Blocker</option>
                                           <option value="Action">Action</option>
                                       </select>
                                        
                                    </div>
                                </div>
                                 <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group mb-0">
                                        <label for="lead-manager">Flag Assignee <small class="text-danger">*</small></label>
                                        <select class="form-control" id="flag_assign">
                                            @foreach(DB::table('members')->where('org_user',Auth::id())->get() as $r)
                                              <option value="{{ $r->id }}">{{ $r->name }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div>
                                 <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group mb-0">
                                        <label for="small-description">Title <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control"  id="flag_title" >
                                        
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group mb-0">
                                        <label for="small-description">Description <small class="text-danger">*</small></label>
                                        <textarea id="flag_description" class="form-control"></textarea>
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button id="updateflagmodalbuton" class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3" onclick="updateepicflag();"  type="button">Add Flag</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       

        <div class="moverightside">
            <h1 class="epic-percentage">{{ $data->key_prog }} % Completed</h1>
            <div class="dashboard-card-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img  src="{{url('public/assets/svg/more.svg')}}" width="20">
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0)">Action One</a>
                    <a class="dropdown-item" href="javascript:void(0)">Action Two</a>
                    <a class="dropdown-item" href="javascript:void(0)">Action Three</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="rightside" >
    <span onclick="maximizemodal()">
        <img  src="{{url('public/assets/svg/maximize.svg')}}">
    </span>
    <img data-dismiss="modal" class="closeimage" aria-label="Close" src="{{url('public/assets/svg/cross.svg')}}">
</div>
<script type="text/javascript">
    function rasiseflag() {
        $('.raiseflag-box').slideToggle();
    }
    function maximizemodal() {
        $('#modaldialog').toggleClass('modalfullscreen')
        $('#edit-epic-modal-new').css('padding-right' , '0px')
    }
</script>