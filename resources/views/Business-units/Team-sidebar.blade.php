@php
if($organization->type == 'BU')
{
$team  = DB::table('business_units')->where('id',$organization->org_id)->first();  
}

if($organization->type == 'VS')
{
$team  = DB::table('value_stream')->where('id',$organization->org_id)->first();  
}

if($organization->type == 'org')
{
$team  = DB::table('organization')->where('id',$organization->id)->first();  
}

@endphp


<div class="aside">
    <div class="d-flex flex-column flex-shrink-0" style="width: 100%; height: 89vh;">
        <ul class="mb-auto text-center sidebar align-items-center mx-auto text-center" id="navbarSupportedContent">
            <li>
                <a href="{{url('/dashboard/organizations')}}" @if (url()->current() == url('dashboard/organizations')) class="active-link" @else class="nav-link"  @endif  aria-current="page" title="" data-toggle="tooltip" data-placement="right" data-original-title="Dashboard">
                    <span class="material-symbols-outlined">home</span>
                </a>
            </li>
            <li>
                <a href="{{url('dashboard/organization/Business-Units')}}"  @if (url()->current() == url('dashboard/organization/Business-Units')) class="active-link" @else class="nav-link"  @endif  data-toggle="tooltip" data-placement="right" data-original-title=" Business Units">
                    <span class="material-symbols-outlined">domain</span>
                </a>
            </li>
            <!-- <li>
                <a href="{{url('dashboard/organization/contacts')}}" @if (url()->current() == url('dashboard/organization/contacts')) class="active-link" @else class="nav-link"  @endif  title="" data-toggle="tooltip" data-placement="right" data-original-title="Contacts">
                    <span class="material-symbols-outlined">perm_contact_calendar</span>
                </a>
            </li> -->

            <li>
                <a href="#" @if (url()->current() == url('dashboard/organization/users')) class="active-link" @else class="nav-link"  @endif title="" data-toggle="tooltip" data-placement="right" data-original-title="OKR Mapper">
                    <span class="material-symbols-outlined">action_key</span>
                </a>
            </li>

            <li>
                <a href="{{url('dashboard/organization/users')}}" @if (url()->current() == url('dashboard/organization/users')) class="active-link" @else class="nav-link"  @endif title="" data-toggle="tooltip" data-placement="right" data-original-title="Users">
                    <span class="material-symbols-outlined">group</span>
                </a>
            </li>


        </ul>
        <div class="align-items-center mx-auto mb-3 text-center">
            <ul class="bottom-bar">
                <!-- <li>
                    <a href="#" data-toggle="tooltip" data-placement="right" data-original-title="Chat">
                        <span class="material-symbols-outlined">chat_bubble</span>
                    </a>
                </li> -->
                <li>
                    <a href="{{url('dashboard/organization/setting')}}" @if (url()->current() == url('dashboard/organization/setting')) class="active-link" @else class="nav-link"  @endif title="" data-toggle="tooltip" data-placement="right" data-original-title="Settings">
                        <span class="material-symbols-outlined">settings</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="#" class="icon" data-toggle="tooltip" data-placement="right" data-original-title="Chooe Theme">
                        <span class="material-symbols-outlined">brush</span>
                    </a>
                </li> -->
            </ul>

            <div class="mt-2 dropup">
                <img src="https://t4.ftcdn.net/jpg/02/14/74/61/360_F_214746128_31JkeaP6rU0NzzzdFC4khGkmqc8noe6h.jpg" class="dropdown-toggle fixbar-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <div class="dropdown-menu mb-5">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Security</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item bg-primary text-white" href="{{ route('logout') }}"  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
                  </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Include -->

    <div class="flex-shrink-0 p-3 bg-white sub-nav open" id="panel">

        <h6 class="title">Team</h6>


        <ul class="list-unstyled ps-0 expanded-navbar-options">


            @if($organization->type == 'BU')

            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/dashboard/BU')}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/dashboard/BU')) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif >
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">folder_supervised</span>
                    </div>
                    <div class="mr-2">
                        Dashboard
                    </div>
                </a>
            </li>

            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/BU')}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/portfolio/BU')) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif >
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">folder_supervised</span>
                    </div>
                    <div class="mr-2">
                        OKR Planner
                    </div>
                </a>
            </li>

            @endif
            @if($organization->type == 'org')
            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/org')}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/portfolio/org')) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif >
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">folder_supervised</span>
                    </div>
                    <div class="mr-2">
                        OKR Planner
                    </div>
                </a>
            </li>

            @endif
            @if($organization->type == 'VS')

            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/dashboard/VS')}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/dashboard/VS')) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif >
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">folder_supervised</span>
                    </div>
                    <div class="mr-2">
                        Dashboard
                    </div>
                </a>
            </li>

            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/VS')}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/portfolio/VS')) class="d-flex flex-row align-items-center nav-link" @else class="d-flex flex-row align-items-center"  @endif>
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">folder_supervised</span>
                    </div>
                    <div class="mr-2">
                        OKR Planner
                    </div>
                </a>
            </li>
            @endif

            @if($organization->type == 'orgT')
            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/dashboard/orgT')}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/dashboard/orgT')) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif >
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">folder_supervised</span>
                    </div>
                    <div class="mr-2">
                        Dashboard
                    </div>
                </a>
            </li>
            
            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/orgT')}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/portfolio/orgT')) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif >
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">folder_supervised</span>
                    </div>
                    <div class="mr-2">
                        OKR Planner
                    </div>
                </a>
            </li>

            @endif


            @if($organization->type == 'BU')
            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/BT-Backlog/BU')}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/BT-Backlog/BU')) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif >
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">key_visualizer</span>
                    </div>
                    <div class="mr-2">
                        Epic Backlog
                    </div>
                </a>
            </li>

            @endif
            @if($organization->type == 'VS')
            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/BT-Backlog/VS')}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/BT-Backlog/VS')) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif>
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">key_visualizer</span>
                    </div>
                    <div class="mr-2">
                        Epic Backlog
                    </div>
                </a>
            </li>
            @endif

            @if($organization->type == 'orgT')
       

            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/BT-Backlog/orgT')}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/BT-Backlog/orgT')) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif>
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">key_visualizer</span>
                    </div>
                    <div class="mr-2">
                        Epic Backlog
                    </div>
                </a>
            </li>
            @endif


            @if($organization->type == 'BU')
            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/performance-dashboard/'.$organization->type)}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/performance-dashboard/'.$organization->type)) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif >
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">team_dashboard</span>
                    </div>
                    <div class="mr-2">
                        Performance Dash.
                    </div>
                </a>
            </li>

            @endif

  
            @if($organization->type == 'VS')
            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/performance-dashboard/'.$organization->type)}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/performance-dashboard/'.$organization->type)) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif>
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">team_dashboard</span>
                    </div>
                    <div class="mr-2">
                        Performance Dash.
                    </div>
                </a>
            </li>
            @endif

            @if($organization->type == 'orgT')
            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/performance-dashboard/'.$organization->type)}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/performance-dashboard/'.$organization->type)) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif >
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">team_dashboard</span>
                    </div>
                    <div class="mr-2">
                        Performance Dash.
                    </div>
                </a>
            </li>

            @endif
            
            <li class="mb-1">
                <a href="{{url('dashboard/organization/'.$organization->slug.'/BU-Report/'.$organization->type)}}" @if (url()->current() == url('dashboard/organization/'.$organization->slug.'/BU-Report')) class="d-flex flex-row align-items-center nav-active" @else   @endif  class="d-flex flex-row align-items-center" >
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">summarize</span>
                    </div>
                    <div class="mr-2">
                        Reports
                    </div>
                </a>
            </li>

            @if($organization->type == 'VS')
            <li class="mb-1">
                <a href="{{url('dashboard/flags/'.$organization->slug.'/impediments/VS')}}" @if (url()->current() == url('dashboard/flags/'.$organization->slug.'/impediments/VS')) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif >
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">warning_off</span>
                    </div>
                    <div class="mr-2">
                        Impediments
                    </div>
                </a>
            </li>
            @endif
            @if($organization->type == 'BU')
            <li class="mb-1">
                <a href="{{url('dashboard/flags/'.$organization->slug.'/impediments/BU')}}" @if (url()->current() == url('dashboard/flags/'.$organization->slug.'/impediments/BU')) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif>
                    <div class="mr-2">
                         <span style="font-size:22px" class="material-symbols-outlined">warning_off</span>
                    </div>
                    <div class="mr-2">
                        Impediments
                    </div>
                </a>
            </li>
            @endif
            
        </ul>
    </div>

</div>
