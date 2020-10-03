<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<input type="text" name="search" id="search" placeholder="Search Here" class="form-control">
				<ul class="list-group"></ul>
		</div>
		<div class="col-md-3"></div>
	</div>	
</div>	
<br>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<label>Select Company:</label>
			<select class="form-control" id="company">
				<option selected="" disabled="">Select Company</option>
				@foreach ($companies as $company)
					<option value="{{$company->id}}">{{$company->company}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-6">
			<label>Select Product:</label>
			<select class="form-control" id="product">
				<option selected="" disabled="">Select Product</option>
			</select>
		</div>
	</div>
</div>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
	<script type="text/javascript">
		$(document).ready(function() {
			$(document).on('keyup', '#search', function(event) {
			// event.preventDefautl();
				var search = $('#search').val();
				// alert(search);
				$.ajax({
					url:"{{ url('/search') }}",
					method:'GET',
					data:{search:search},
					success:function(data)
					{
						response = $.parseJSON(data);
						if(response.company.length > 0)
							{
							var output="";
							$.each(response.company, function(index, val) {
					 		output += "<li class='list-group-item'>"+"<a href=/company/"+val.id+">"+val.company+"</a>"+"</li>";
								 /* iterate through array or object */ 
								// console.log(val.company);
							});
							$('.list-group').html(output);
							}
						else
							{
								$('.list-group').html('<li class="list-group-item">Record Not Found</li>');
							}
					}
				});
			});

			$(document).on('change', '#company', function(event) {
				var company = $('#company').val();
				$.ajax({
            		url:'{{ url('/companies') }}',
            		method:'get',
            		data:{company:company},
            		success:function(data)
            		{
            			response = $.parseJSON(data);
            			var output='';
            			$.each(response.product, function(index, val) {
            				output += '<option value='+val.id+'>'+val.product+'</option>';
            				$('#product').html(output);
            				 // console.log(val.product);
            			});
            			// console.log(response.product);
            		}
				});
			});
		});
	</script>
</body>
</html>