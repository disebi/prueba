@extends('app2')


@section('content')
  <section class="content-header">
  <h2>Dashboard</h2>
  </section>
  <section class="content">
  <div class="row">
  <div class="col-md-12">

    <div class="panel panel-success">
    				<div class="panel-heading">Seleccione Vendedor</div>
    				<div class="panel-body">
                    <ul class="users-list clearfix">
                                        <li>
                                          <img src="/img/user.png"  height="90px" width="90px" alt="User Image">
                                          <a class="users-list-name" href="#">Alexander Pierce</a>
                                          <span class="users-list-date">Today</span>
                                        </li>
                                        <li>
                                          <img src="/img/user.png"  height="90px" width="90px" alt="User Image">
                                          <a class="users-list-name" href="#">Norman</a>
                                          <span class="users-list-date">Yesterday</span>
                                        </li>
                                        <li>
                                          <img src="/img/user.png"  height="90px" width="90px" alt="User Image">
                                          <a class="users-list-name" href="#">Jane</a>
                                          <span class="users-list-date">12 Jan</span>
                                        </li>
                                        <li>
                                          <img src="/img/user.png"  height="90px" width="90px" alt="User Image">
                                          <a class="users-list-name" href="#">John</a>
                                          <span class="users-list-date">12 Jan</span>
                                        </li>
                                        <li>
                                           <img src="/img/user.png"  height="90px" width="90px" alt="User Image">
                                          <a class="users-list-name" href="#">Alexander</a>
                                          <span class="users-list-date">13 Jan</span>
                                        </li>
                                        <li>
                                           <img src="/img/user.png"  height="90px" width="90px" alt="User Image">
                                          <a class="users-list-name" href="#">Sarah</a>
                                          <span class="users-list-date">14 Jan</span>
                                        </li>
                                        <li>
                                           <img src="/img/user.png"  height="90px" width="90px" alt="User Image">
                                          <a class="users-list-name" href="#">Nora</a>
                                          <span class="users-list-date">15 Jan</span>
                                        </li>
                                        <li>
                                           <img src="/img/user.png"  height="90px" width="90px" alt="User Image">
                                          <a class="users-list-name" href="#">Nadia</a>
                                          <span class="users-list-date">15 Jan</span>
                                        </li>
                                      </ul>
    				</div>
    			</div>


           <div class="col-lg-3 col-xs-6">
             <!-- small box -->
             <div class="small-box bg-aqua">
               <div class="inner">
                 <h3>150</h3>

                 <p>New Orders</p>
               </div>
               <div class="icon">
                 <i class="ion ion-bag"></i>
               </div>
               <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
             </div>
           </div>
           <!-- ./col -->
           <div class="col-lg-3 col-xs-6">
             <!-- small box -->
             <div class="small-box bg-green">
               <div class="inner">
                 <h3>53<sup style="font-size: 20px">%</sup></h3>

                 <p>Bounce Rate</p>
               </div>
               <div class="icon">
                 <i class="ion ion-stats-bars"></i>
               </div>
               <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
             </div>
           </div>
           <!-- ./col -->
           <div class="col-lg-3 col-xs-6">
             <!-- small box -->
             <div class="small-box bg-yellow">
               <div class="inner">
                 <h3>44</h3>

                 <p>User Registrations</p>
               </div>
               <div class="icon">
                 <i class="ion ion-person-add"></i>
               </div>
               <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
             </div>
           </div>
           <!-- ./col -->
           <div class="col-lg-3 col-xs-6">
             <!-- small box -->

           </div>

           <div class="col-lg-3 col-xs-6">
                                 <!-- small box -->
                                 <div class="small-box bg-red">
                                   <div class="inner">
                                     <h3>65</h3>

                                     <p>Unique Visitors</p>
                                   </div>
                                   <div class="icon">
                                     <i class="ion ion-pie-graph"></i>
                                   </div>
                                   <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                 </div>
                               </div>


           <!-- ./col -->

  </div>


  </div>
  </div>

  </section>

@stop