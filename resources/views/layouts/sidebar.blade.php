	<!-- Left Sidebar -->
	<div class="left main-sidebar">
	
		<div class="sidebar-inner leftscroll"  position="fixed">

			<div id="sidebar-menu">
        
			<ul>

					<li class="submenu">
						<a class="active" href="{{ url('home') }}"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                    </li>	
                    <!-------------------------------------------------------------->
                    <li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-th"></i> <span> Drugs Management </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                               <li><a href="{{route('dif_dia.en_tree')}}" target="_blank">test2</a></li>
                              <li><a href="{{route('get_all_parents_for_node',['id'=> 65321 ])}}" target="_blank">test</a></li>


                                <li><a href="{{route('disease.draw_en_tree')}}" target="_blank">Diseases</a></li>
                                <li><a href="{{route('dif_dia.draw_en_tree')}}" target="_blank">Differential Diagnoses</a></li>

                                <li><a href="{{ url('drug-administration/tag') }}">Tags</a></li>


                                <li><a href="{{ url('drug-administration/company') }}">Companies</a></li>
                                <li><a href="{{ url('drug-administration/composition') }}"       >Compositions</a></li>
                                <li><a href="{{ url('drug-administration/drug') }}">Drugs</a></li>
                                <li><a href="{{ url('drug-administration/leaflet') }}">Leaflets</a></li>
                                <li><a href="{{route('classification.draw_tree3_ar')}}" target="_blank">Classifications</a></ li>
                                <li><a href="{{ url('drug-administration/form') }}">Forms</a></li>
                                <li><a href="{{ url('drug-administration/unit') }}">Units</a></li>
                                <li><a href="{{ url('drug-administration/giving') }}">Givings</a></li>
                                

                                <li><a href="#">Reports</a></li>
                            </ul>
                    </li>


                    <!-------------------------------------------------------------->
					
					
            </ul>

            <div class="clearfix"></div>

			</div>
        
			<div class="clearfix"></div>

		</div>

	</div>
	<!-- End Sidebar -->