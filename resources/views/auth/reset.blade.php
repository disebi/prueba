@extends('app2')

@section('content')
 <section class="content-header">
          <h1>
            Mi Perfil
          </h1>




          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Perfil</a></li>


          </ol>
 </section>
<section class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-success">
				<div class="panel-heading">Reset Password</div>
				<div class="panel-body">
                    <div class=" image" style="text-align: center; padding-bottom: 30px">
                      <img src="http://2a.admin/img/user.png" class="img-circle" alt="User Image" height="70px" width="70px">
                    </div>
                    {!! Form:: model($user, ['action'=>['UserController@update',$user->id],'class'=>'form-horizontal', 'method'=>'PATCH'])!!}
    				 <input type="hidden" name="id" value="{{ $user->id }}">
                    	<div class="form-group">
                        <label class="col-md-4 control-label">Nick</label>
                            <div class="col-md-6">
                               <input type="text" value="{{isset($user->name) ? $user->name : null}}" class="form-control" name="name">
                            </div>
                        </div>

                       <div class="form-group">
                         <label class="col-md-4 control-label">Email</label>
                         <div class="col-md-6">
                             <input type="text" value="{{isset($user->email) ? $user->email : null}}" class="form-control" name="email">
                         </div>
                       </div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input placeholder="clave" type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirmar Password</label>
							<div class="col-md-6">
								<input placeholder="volver a ingresar la clave" type="password" class="form-control" name="password2">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Editar Clave
								</button>
							</div>
						</div>
					 </form>
				</div>
			</div>
		</div>
	</div>
</section>
 @include('partials.functionMsj')
@endsection
