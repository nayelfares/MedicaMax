	<!-- Left Sidebar -->
	<div class="left main-sidebar">
	
		<div class="sidebar-inner leftscroll"  position="fixed">

			<div id="sidebar-menu">
        
			<ul>

					<li class="submenu">
						<a class="active" href="{{ asset('index.html') }}"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                    </li>

					<li class="submenu">
                        <a href="{{ asset('charts.html') }}"><i class="fa fa-fw fa-area-chart"></i><span> Charts </span> </a>
                    </li>
					
					<li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="{{ asset('tables-basic.html') }}">Basic Tables</a></li>
								<li><a href="{{ asset('tables-datatable.html') }}">Data Tables</a></li>
							</ul>
                    </li>
										
                    <li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-tv"></i> <span> User Interface </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ asset('ui-alerts.html') }}">Alerts</a></li>
                                <li><a href="{{ asset('ui-buttons.html') }}">Buttons</a></li>
                                <li><a href="{{ asset('ui-cards.html') }}">Cards</a></li>
                                <li><a href="{{ asset('ui-carousel.html') }}">Carousel</a></li>
                                <li><a href="{{ asset('ui-collapse.html') }}">Collapse</a></li>
                                <li><a href="{{ asset('ui-icons.html') }}">Icons</a></li>
                                <li><a href="{{ asset('ui-modals.html') }}">Modals</a></li>
                                <li><a href="{{ asset('ui-tooltips.html') }}">Tooltips and Popovers</a></li>
                            </ul>
                    </li>

					<li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-file-text-o"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ asset('forms-general.html') }}">General Elements</a></li>
								<li><a href="{{ asset('forms-select2.html') }}">Select2</a></li>
                                <li><a href="{{ asset('forms-validation.html') }}">Form Validation</a></li>
                                <li><a href="{{ asset('forms-text-editor.html') }}">Text Editors</a></li>
								<li><a href="{{ asset('forms-upload.html') }}">Multiple File Upload</a></li>
								<li><a href="{{ asset('forms-datetime-picker.html') }}">Date and Time Picker</a></li>
								<li><a href="{{ asset('forms-color-picker.html') }}">Color Picker</a></li>
                            </ul>
                    </li>
					
                    <li class="submenu">
						<a href="#"><i class="fa fa-fw fa-th"></i> <span> Plugins </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ asset('star-rating.html') }}">Star Rating</a></li>
								<li><a href="{{ asset('range-sliders.html') }}">Range Sliders</a></li>
								<li><a href="{{ asset('tree-view.html') }}">Tree View</a></li>
								<li><a href="{{ asset('sweetalert.html') }}">SweetAlert</a></li>
								<li><a href="{{ asset('calendar.html') }}">Calendar</a></li>
								<li><a href="{{ asset('gmaps.html') }}">GMaps</a></li>
								<li><a href="{{ asset('counter-up.html') }}">Counter-Up</a></li>
                            </ul>
                    </li>
                    <!-------------------------------------------------------------->
                    <li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-th"></i> <span> Plugins </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('drug-administration/composition') }}">Compositions</a></li>
                                <li><a href="{{ url('drug-administration/drug') }}">Drugs</a></li>
                                <li><a href="{{ url('drug-administration/leaflet') }}">Leaflets</a></li>
                                <li><a href="{{ url('drug-administration/classification') }}">Classifications</a></ li>
                                <li><a href="{{ url('drug-administration/form') }}">Forms</a></li>
                                <li><a href="{{ url('drug-administration/unit') }}">Units</a></li>
                                <li><a href="{{ url('drug-administration/giving') }}">Givings</a></li>
                                <li><a href="{{ url('drug-administration/company') }}">Companies</a></li>
                                <li><a href="#">Reports</a></li>
                            </ul>
                    </li>


                    <!-------------------------------------------------------------->
					<li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-image"></i> <span> Images and Galleries </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="{{ asset('media-fancybox.html') }}"><span class="label radius-circle bg-danger float-right">cool</span> Fancybox </a></li>								
								<li><a href="{{ asset('media-masonry.html') }}">Masonry</a></li>
								<li><a href="{{ asset('media-lightbox.html') }}">Lightbox</a></li>
								<li><a href="{{ asset('media-owl-carousel.html') }}">Owl Carousel</a></li>
								<li><a href="{{ asset('media-image-magnifier.html') }}">Image Magnifier</a></li>
								
							</ul>
                    </li>
					
                    <li class="submenu">
                        <a href="#"><span class="label radius-circle bg-danger float-right">20</span><i class="fa fa-fw fa-copy"></i><span> Example Pages </span></a>
                            <ul class="list-unstyled">								
                                <li><a href="{{ asset('page-pricing-tables.html') }}">Pricing Tables</a></li>
                                <li><a target="_blank" href="{{ asset('page-coming-soon.html') }}">Countdown</a></li>								
                                <li><a href="{{ asset('page-invoice.html') }}">Invoice</a></li>                        
								<li><a href="{{ asset('page-login.html') }}">Login / Register</a></li>								
								<li><a href="{{ asset('page-blank.html') }}">Blank Page</a></li>
                            </ul>
                    </li>

					<li class="submenu">
                        <a href="#"><span class="label radius-circle bg-primary float-right">9</span><i class="fa fa-fw fa-indent"></i><span> Menu Levels </span></a>
                            <ul>
								<li>
                                    <a href="#"><span>Second Level</span></a>
                                </li>
                                <li class="submenu">
                                    <a href="#"><span>Third Level</span> <span class="menu-arrow"></span> </a>
                                        <ul style="">
                                            <li><a href="#"><span>Third Level Item</span></a></li>
                                            <li><a href="#"><span>Third Level Item</span></a></li>
                                        </ul>
                                </li>                                
                            </ul>
                    </li>

					<li class="submenu">
                        <a class="pro" href="#"><i class="fa fa-fw fa-star"></i><span> Pike Admin PRO </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">								
                                <li><a target="_blank" href="https://www.pikeadmin.com/pike-admin-pro">Admin PRO features</a></li>
								<li><a href="{{ asset('pro-settings.html') }}">Settings</a></li>
								<li><a href="{{ asset('pro-profile.html') }}">My Profile</a></li>
                                <li><a href="{{ asset('pro-users.html') }}">Users</a></li>
                                <li><a href="{{ asset('pro-articles.html') }}">Articles</a></li>
                                <li><a href="{{ asset('pro-categories.html') }}">Categories</a></li>
								<li><a href="{{ asset('pro-pages.html') }}">Pages</a></li>								
                                <li><a href="{{ asset('pro-contact-messages.html') }}">Contact Messages</a></li>
								<li><a href="{{ asset('pro-slider.html') }}">Slider</a></li>
                            </ul>
                    </li>
					
            </ul>

            <div class="clearfix"></div>

			</div>
        
			<div class="clearfix"></div>

		</div>

	</div>
	<!-- End Sidebar -->