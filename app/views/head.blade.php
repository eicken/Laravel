<!DOCTYPE html>
<html>
<head>
	<title>Acrontum Ticket System</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ URL::to('/'); }}/app/css/style.css">
	        <link type="text/css" href="{{ URL::to('/'); }}/app/css/common.css" rel="stylesheet" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
        <link type="text/css" href="{{ URL::to('/'); }}/app/css/jquery.uix.multiselect.css" rel="stylesheet" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	<script type="text/javascript">
	var data = [
				{ value: "acrontum", label: "acrontum" },
			];

		$(function() {
			$("#autocomplete1").autocomplete({
				source: data
			});
		});
	</script>
        <script type="text/javascript" src="{{ URL::to('/'); }}/app/js/jquery.uix.multiselect.js"></script>
        <script type="text/javascript" src="{{ URL::to('/'); }}/app/js/locales/jquery.uix.multiselect_de.js"></script>
        <script type="text/javascript" src="{{ URL::to('/'); }}/app/js/combobox.js"></script>
        <script type="text/javascript" src="{{ URL::to('/'); }}/app/js/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="{{ URL::to('/'); }}/app/js/bootstrap/js/bootstrap.min.js"></script>
        
</head>

<body>