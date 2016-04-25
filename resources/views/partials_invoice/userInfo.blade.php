  <div class="panel panel-success">
                                      <div class="panel-heading">Usuario</div>

                                         <div class="panel-body">
                                            @if(isset($model))
                                                <p><b>Nombre:</b> {{$model->staff->name}} {{$model->staff->last_name}}</p>
                                                <p><b>Sucursal:</b> {{$model->staff->branch->description}}</p>
                                                <p><b>Cargo:</b> {{$model->staff->position->description}}</p>
                                             @else
                                                <p><b>Nombre:</b> {{\Auth::user()->staff->name}}</p>
                                                <p><b>Sucursal:</b> {{\Auth::user()->staff->branch->description}}</p>
                                                <p><b>Cargo:</b> {{\Auth::user()->staff->position->description}}</p>
                                             @endif
                                          </div>
                                  </div>