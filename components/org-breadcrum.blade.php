<!-- begin breadcrums -->
@php
$organization  = DB::table('organization')->where('user_id',Auth::id())->first();
@endphp
                <div class="subheader subheader-solid breadcrums" id="kt_subheader">
                    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <!--begin::Info-->
                        <div class="d-flex align-items-start flex-column flex-wrap mr-2">
                            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                               @if($organization) 
                               {{$organization->organization_name.'-'.$organization->code}}
                               @else
                               organization
                               @endif

                               
                            </h5>
                            <!-- Breadcrum Items -->
                            <div class="d-flex flex-row page-sub-titles">
                                <div class="mr-2">
                                    <a href="{{route('home')}}">Dashboard</a>
                                </div>
                                
                            </div>
                            <!--End Breadcrum Items -->
                        </div>
                        <!--end::Info-->
                        <!--begin::Toolbar-->
                        {{-- <div class="d-flex align-items-center toolbar">
                            <div>
                                <button class="button" data-toggle="modal" data-target="#create-org">Add Organization</button>
                            </div>
                        </div> --}}
                        <!--end::Toolbar-->
                    </div>
                </div>
                <!-- end breadcrums -->