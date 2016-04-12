  <div class="panel panel-success">
                                      <div class="panel-heading">Usuario</div>

                                         <div class="panel-body">
                                            @if(isset($model))
                                                <p><b>Nombre:</b> {{\App\Staff::find($model->staff_id)->name}}</p>
                                                <p><b>Sucursal:</b> {{\App\Staff::find($model->staff_id)->last_name}}</p>
                                                <p><b>Cargo:</b> {{\App\Staff::find($model->staff_id)->position->description}}</p>
                                             @else
                                                <p><b>Nombre:</b> {{\Auth::user()->getFullName(\Auth::user()->id)}}</p>
                                                <p><b>Sucursal:</b> {{\Auth::user()->getBranch(\Auth::user()->id)}}</p>
                                                <p><b>Cargo:</b> {{\Auth::user()->getPosition(\Auth::user()->id)}}</p>
                                             @endif
                                          </div>
                                  </div>