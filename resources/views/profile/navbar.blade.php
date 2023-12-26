         

            @php
            $organization = DB::table('organization')->where('user_id',Auth::id())->where('trash',NULL)->first();    
            @endphp
            <div class="flex-shrink-0 p-3 bg-white sub-nav open" id="panel">
                {{-- <button id="closeBtn" class="close-button">
                    <img src="https://dev.agileprolific.com/public/assets/images/icons/collaps.svg">
                </button> --}}
                <h6 class="title">Organization</h6>
              

            
                
                <ul class="list-unstyled ps-0 expanded-navbar-options">
                   
                    <li class="mb-1">
                        <a href="{{url('dashboard/organizations')}}" @if (url()->current() == url('dashboard/organizations')) class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center"  @endif>
                            <div class="mr-2">
                                <span style="font-size:22px" class="material-symbols-outlined">auto_stories</span>
                            </div>
                            <div class="mr-2">
                               Dashboard
                            </div>
                        </a>
                    </li>
              

                    <li class="mb-1">
                        <a href="{{url('profile-setting')}}" @if (url()->current() == url('profile-setting'))  class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center" @endif>
                            <div class="mr-2">
                                 <span style="font-size:22px" class="material-symbols-outlined">groups</span>
                            </div>
                            <div class="mr-2">
                                Profile
                            </div>
                        </a>
                    </li>

                    <li class="mb-1">
                            <a href="{{url('change-password')}}" @if (url()->current() == url('change-password'))  class="d-flex flex-row align-items-center nav-active" @else class="d-flex flex-row align-items-center" @endif>

                            <div class="mr-2">
                                 <span style="font-size:22px" class="material-symbols-outlined">groups</span>
                            </div>
                            <div class="mr-2">
                                Change Password
                            </div>
                        </a>
                    </li>

                    <!-- <li class="mb-1">
                        <a href="#" class="d-flex flex-row align-items-center">
                            <div class="mr-2">
                                 <span style="font-size:22px" class="material-symbols-outlined">sprint</span>
                            </div>
                            <div class="mr-2">
                                Leadership Actions
                            </div>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="d-flex flex-row align-items-center">
                            <div class="mr-2">
                                <span style="font-size:22px" class="material-symbols-outlined">dangerous</span>
                            </div>
                            <div class="mr-2">
                                Blockers
                            </div>
                            <div>
                                <span class="badge btn-circle-xs badge-warning text-sm">10+</span>
                            </div>
                        </a>
                    </li> -->
                </ul>
            </div>