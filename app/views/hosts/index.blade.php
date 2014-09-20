@extends('layouts.master')

@section('content')

	<div class="col-md-6">

		<h2 class="section-title">List of allowed hosts</h2>

		<ul class="list-group">
			@foreach($hosts as $host)
				<li class="list-group-item">
					{{ $host->ipaddress }}

					@if ($host->subnet)
						/ {{ $host->subnet }}
					@endif

					<div class="options">
						<ul class="options-menu">
							<li class="options-items">{{ link_to('disable', 'Disable') }}</li>
							<li class="options-items">{{ link_to('edit', 'Edit') }}</li>
							<li class="options-items">{{ link_to('delete', 'Delete') }}</li>
						</ul><!-- end options-menu -->
					</div><!-- end edit -->
				</li>
			@endforeach
		</ul>

	</div><!-- end col-md-6 -->


	<div class="col-md-6">
		@include('partials._form')
	</div>
@stop