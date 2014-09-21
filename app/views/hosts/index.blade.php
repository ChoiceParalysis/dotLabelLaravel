@extends('layouts.master')

@section('content')

	<div class="col-md-6">

		<h2 class="section-title">List of allowed hosts</h2>

		<ul class="list-group">
			@foreach($hosts as $host)
				<li class="list-group-item" data-status="{{ $host->enabled }}">
					{{ $host->ipaddress }}

					@if ($host->subnet)
						/ {{ $host->subnet }}
					@endif

					<div class="options">
						<ul class="options-menu">
							<li class="options-items" data-hostid="{{ $host->id }}">
								@if ($host->enabled)
									{{ link_to('disable', 'Disable', ['class' => 'post-link']) }}
								@else
									{{ link_to('enable', 'Enable') }}
								@endif
							</li>
							<li class="options-items">{{ link_to('edit', 'Edit') }}</li>
							<li class="options-items">{{ link_to_route('hosts.destroy', 'Delete') }}</li>	
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