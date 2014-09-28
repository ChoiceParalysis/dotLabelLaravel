

<div class="overflow-fix">
			<h2 class="section-title hosts">Allowed Hosts</h2>

			<input type="text" id="search" class="form-control" placeholder="Filter hosts" ng-model="search">
		</div><!-- end overflow-fix -->
		
		<ul class="list-group">
			<li  class="list-group-item link" ng-repeat="host in hosts | filter:search" data-enabled="{{ host.enabled }}">
				{{ host.ipaddress }} / {{ host.subnet }}

				<ul class="options">
					<li class="options-item">
						<a class="link" ng-click="updateStatus(host)">
							<span ng-if="host.enabled">Disable</span>
							<span ng-if="! host.enabled">Enable</span>
						</a>
					</li><!-- end options-item -->

					<li class="options-item">
						<a class="link" ng-click="showEditForm(host)">Edit</a>
					</li><!-- end options-item -->

					<li class="options-item">
						<a class="link" ng-click="deleteHost(host)">Delete</a>
					</li><!-- end options-item -->
				</ul><!-- end options -->

				<div class="description">
					{{ host.description }}
				</div><!-- end description -->
			</li><!-- end list-group-item -->
		</ul><!-- end list-group -->

		<ul class="pagination">
			<li><a class="link" ng-click="prevPage()">&laquo;</a></li>

			<li ng-repeat="n in range(data.last_page) track by $index">
				<a class="link"  ng-click="loadPage($index + 1)">{{ $index + 1 }}</a>
			</li>

			<li><a class="link" ng-click="nextPage()">&raquo;</a></li>
		</ul>