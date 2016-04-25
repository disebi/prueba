  <div class="panel panel-success">
                                      <div class="panel-heading">Emision</div>
                                         <div class="panel-body">
                                                <p><b>Fecha</b> {{date('d/m/y')}}</p>
                                                <p><b>Hora</b> {{date('H:m:s')}}</p>

                                                @if($stamping)
                                                <div class="form-group">
                                                   <div class="control-group">
                                                    {!! Form:: label ('stamping','Timbrado:')!!}
                                                <div class="controls">
                                                {!! Form:: text ('stamping',null,['placeholder'=>'123456', 'class'=>'input-medium', 'required'=>'','class'=>'form-control'])!!}
                                                 <p class="help-block">Timbrado de la compra</p>
                                                  </div>
                                                </div>
                                                 </div>
                                                @endif

                                          </div>
                                  </div>