@php
$var_objective = 'linking';
@endphp
@extends('linking.includes.layout')
@section('metta_tittle')
<title>Linking </title>
@endsection
@section('content')
@php
    $business_units = DB::table('business_units')->where('user_id',Auth::id())->orderby('id' , 'asc')->limit(5)->get();
@endphp

<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div class="content d-flex flex-column flex-column-fluid">
            <!-- begin page Content -->
            <div class="container-fluid">
                <script src="https://cdn.jsdelivr.net/gh/jerosoler/Drawflow/dist/drawflow.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
                  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/drawflow/drawflow.css') }}" />
                  <link rel="stylesheet" type="text/css" href="{{ url('public/assets/drawflow/beautiful.css') }}" />
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
                  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
                  <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
                  <div class="wrapper">
                      <div id="drawflow" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <div class="btn-lock">
                          <i id="lock" class="fas fa-lock" onclick="editor.editor_mode='fixed'; changeMode('lock');"></i>
                          <i id="unlock" class="fas fa-lock-open" onclick="editor.editor_mode='edit'; changeMode('unlock');" style="display:none;"></i>
                        </div>
                        <div class="bar-zoom">
                          <i class="fas fa-search-minus" onclick="editor.zoom_out()"></i>
                          <i class="fas fa-search" onclick="editor.zoom_reset()"></i>
                          <i class="fas fa-search-plus" onclick="editor.zoom_in()"></i>
                        </div>
                      </div>
                  </div>

                  <script>

                    var id = document.getElementById("drawflow");
                    const editor = new Drawflow(id);
                    editor.reroute = true;
                    editor.reroute_fix_curvature = true;
                    editor.force_first_input = false;
                    editor.zoom = 1;
                    editor.editor_mode = 'edit';



                    // editor.createCurvature = function(start_pos_x, start_pos_y, end_pos_x, end_pos_y, curvature_value, type) {
                    //   var center_x = ((end_pos_x - start_pos_x)/2)+start_pos_x;
                    //   return ' M ' + start_pos_x + ' ' + start_pos_y + ' L '+ center_x +' ' +  start_pos_y  + ' L ' + center_x + ' ' +  end_pos_y  + ' L ' + end_pos_x + ' ' + end_pos_y;
                    // }



                   @include('linking.includes.scripts') 

                    editor.start();
                    editor.import(dataToImport);

                    // Events!
                    editor.on('nodeCreated', function(id) {
                      console.log("Node created " + id);
                    })

                    editor.on('nodeRemoved', function(id) {
                      console.log("Node removed " + id);
                    })

                    editor.on('nodeSelected', function(id) {
                      console.log("Node selected " + id);
                    })

                    editor.on('moduleCreated', function(name) {
                      console.log("Module Created " + name);
                    })

                    editor.on('moduleChanged', function(name) {
                      console.log("Module Changed " + name);
                    })

                    editor.on('connectionCreated', function(connection) {
                      console.log('Connection created');
                      console.log(connection);
                    })

                    editor.on('connectionRemoved', function(connection) {
                      console.log('Connection removed');
                      console.log(connection);
                    })
                /*
                    editor.on('mouseMove', function(position) {
                      console.log('Position mouse x:' + position.x + ' y:'+ position.y);
                    })
                */
                    editor.on('nodeMoved', function(id) {
                      console.log("Node moved " + id);
                    })

                    editor.on('zoom', function(zoom) {
                      console.log('Zoom level ' + zoom);
                    })

                    editor.on('translate', function(position) {
                      console.log('Translate x:' + position.x + ' y:'+ position.y);
                    })

                    editor.on('addReroute', function(id) {
                      console.log("Reroute added " + id);
                    })

                    editor.on('removeReroute', function(id) {
                      console.log("Reroute removed " + id);
                    })
                    /* DRAG EVENT */

                    /* Mouse and Touch Actions */

                    var elements = document.getElementsByClassName('drag-drawflow');
                    for (var i = 0; i < elements.length; i++) {
                      elements[i].addEventListener('touchend', drop, false);
                      elements[i].addEventListener('touchmove', positionMobile, false);
                      elements[i].addEventListener('touchstart', drag, false );
                    }

                    var mobile_item_selec = '';
                    var mobile_last_move = null;
                   function positionMobile(ev) {
                     mobile_last_move = ev;
                   }

                   function allowDrop(ev) {
                      ev.preventDefault();
                    }

                    function drag(ev) {
                      if (ev.type === "touchstart") {
                        mobile_item_selec = ev.target.closest(".drag-drawflow").getAttribute('data-node');
                      } else {
                      ev.dataTransfer.setData("node", ev.target.getAttribute('data-node'));
                      }
                    }

                    function drop(ev) {
                      if (ev.type === "touchend") {
                        var parentdrawflow = document.elementFromPoint( mobile_last_move.touches[0].clientX, mobile_last_move.touches[0].clientY).closest("#drawflow");
                        if(parentdrawflow != null) {
                          addNodeToDrawFlow(mobile_item_selec, mobile_last_move.touches[0].clientX, mobile_last_move.touches[0].clientY);
                        }
                        mobile_item_selec = '';
                      } else {
                        ev.preventDefault();
                        var data = ev.dataTransfer.getData("node");
                        addNodeToDrawFlow(data, ev.clientX, ev.clientY);
                      }

                    }

                    

                  var transform = '';
                  function showpopup(e) {
                    e.target.closest(".drawflow-node").style.zIndex = "9999";
                    e.target.children[0].style.display = "block";
                    //document.getElementById("modalfix").style.display = "block";

                    //e.target.children[0].style.transform = 'translate('+translate.x+'px, '+translate.y+'px)';
                    transform = editor.precanvas.style.transform;
                    editor.precanvas.style.transform = '';
                    editor.precanvas.style.left = editor.canvas_x +'px';
                    editor.precanvas.style.top = editor.canvas_y +'px';
                    console.log(transform);

                    //e.target.children[0].style.top  =  -editor.canvas_y - editor.container.offsetTop +'px';
                    //e.target.children[0].style.left  =  -editor.canvas_x  - editor.container.offsetLeft +'px';
                    editor.editor_mode = "fixed";

                  }

                   function closemodal(e) {
                     e.target.closest(".drawflow-node").style.zIndex = "2";
                     e.target.parentElement.parentElement.style.display  ="none";
                     //document.getElementById("modalfix").style.display = "none";
                     editor.precanvas.style.transform = transform;
                       editor.precanvas.style.left = '0px';
                       editor.precanvas.style.top = '0px';
                      editor.editor_mode = "edit";
                   }

                    function changeModule(event) {
                      var all = document.querySelectorAll(".menu ul li");
                        for (var i = 0; i < all.length; i++) {
                          all[i].classList.remove('selected');
                        }
                      event.target.classList.add('selected');
                    }

                    function changeMode(option) {

                    //console.log(lock.id);
                      if(option == 'lock') {
                        lock.style.display = 'none';
                        unlock.style.display = 'block';
                      } else {
                        lock.style.display = 'block';
                        unlock.style.display = 'none';
                      }

                    }

                  </script>
            </div>
        </div>
    </div>
</div>

     

@endsection