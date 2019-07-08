@extends('test-layout')
{{-- nhung file test js --}}
{{-- nhung dc day ra ngoai layout blade --}}
@push('scripts')
	<script type="text/javascript" src="{{ asset('js/test.js') }}"></script>
@endpush
@push('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/test.css') }}">
@endpush

@section('content')
<div class="row py-5 bg-white">
			<div class="col-lg-12 col-xg-12">
				<h3 >This is home</h3>
				{{-- <p>Name: {{ $name }}</p>
				<p>Phone: {{ $phone }}</p> --}}
				<table class="table my-3">					
					<thead>
						<tr>
							<th>#</th>
							<th>Msv</th>
							<th>Hoten</th>
							<th>tuoi</th>
							<th>dienthoai</th>
							<th>hoc bong</th>
							<th>gioi tinh</th>
							<th colspan="2" width="3%">Action</th>
						</tr>
					</thead>
					<tbody>
						@php
							//khai bao bien php
							$totalMoney = 0;

						@endphp

						@foreach($lstInfoStudent as $key => $items)
							@php
							//khai bao bien php
							$totalMoney += $items['money'];
							@endphp
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $items['msv'] }}</td>
							<td>{{ $items['name'] }}</td>
							<td>{{ $items['age'] }}</td>
							<td>{{ $items['phone'] }}</td>	
							<td>{{ number_format($items['money'])  }}</td>
							<td>{{ $items['gender'] == 0 ? 'Nu' :'Nam' }}</td>
							<td>
								<a href="" class="btn btn-primary">Sua</a>
							</td>
							<td>
								<a href="" class="btn btn-danger">Xoa</a>
							</td>

						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5">Hoc bong</td>
							<td colspan="4">{{ number_format($totalMoney) }}</td>
						</tr>
					</tfoot>
				</table>
			</div>

		</div>
@endsection